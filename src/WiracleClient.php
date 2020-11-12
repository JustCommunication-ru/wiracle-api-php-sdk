<?php

namespace JustCommunication\WiracleSDK;

use GuzzleHttp\Psr7\Response;
use JustCommunication\WiracleSDK\API\RequestInterface;
use JustCommunication\WiracleSDK\API\ResponseInterface;
use JustCommunication\WiracleSDK\API\TokenRequest;
use JustCommunication\WiracleSDK\API\TokenResponse;
use JustCommunication\WiracleSDK\API\WiracleAPIException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;

/**
 * Class WiracleClient
 *
 * @package WiracleSDK
 *
 * @method API\AccountResponse sendAccountRequest(API\AccountRequest $request)
 * @method API\MessageCreateResponse sendMessageCreateRequest(API\MessageCreateRequest $request)
 * @method API\ChannelsResponse sendChannelsRequest(API\ChannelsRequest $request)
 * @method API\ChannelsAvailableResponse sendChannelsAvailableRequest(API\ChannelsAvailableRequest $request)
 */
class WiracleClient implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    const API_ENDPOINT = 'https://wiracle.ru/';

    const DEFAULT_OPTIONS = [
        'connect_timeout' => 4,
        'timeout' => 10
    ];

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * WiracleClient constructor.
     *
     * @param string $username
     * @param string $token
     * @param array $httpClientOptions
     */
    public function __construct($username, $token, array $httpClientOptions = self::DEFAULT_OPTIONS)
    {
        $this->username = $username;
        $this->token = $token;

        $this->httpClient = self::createHttpClient($httpClientOptions);

        $this->logger = new NullLogger();
    }

    /**
     * @param array $httpClientOptions
     * @return \GuzzleHttp\Client
     */
    protected static function createHttpClient(array $httpClientOptions = self::DEFAULT_OPTIONS)
    {
        return new \GuzzleHttp\Client($httpClientOptions);
    }

    /**
     * Get token
     *
     * @param string $username
     * @param string $password
     * @param array $httpClientOptions
     * @return TokenResponse
     *
     * @throws WiracleAPIException
     */
    public static function sendTokenRequest($username, $password, array $httpClientOptions = self::DEFAULT_OPTIONS)
    {
        $httpClient = self::createHttpClient($httpClientOptions);

        try {
            $request = new TokenRequest($username, $password);
            $httpResponse = $httpClient->request($request->getHttpMethod(), $request->getUri(), $request->createHttpClientParams());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            self::handleErrorResponse($e->getResponse());

            throw new WiracleAPIException('Wiracle API request error: ' . $e->getMessage());
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            throw new WiracleAPIException('Wiracle API error: ' . $e->getMessage());
        }

        /** @var TokenResponse $response */
        $response = self::createAPIResponse($httpResponse, $request->getResponseClass());

        return $response;
    }

    /**
     * @param \GuzzleHttp\Client $httpClient
     */
    public function setHttpClient(\GuzzleHttp\Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param $username
     * @param $password
     * @param array $httpClientOptions
     * @return string
     *
     * @throws WiracleAPIException
     */
    public static function getToken($username, $password, array $httpClientOptions = self::DEFAULT_OPTIONS)
    {
        $response = self::sendTokenRequest($username, $password, $httpClientOptions);
        return $response->getToken();
    }

    /**
     * @return Model\Account
     */
    public function getAccount()
    {
        $response = $this->sendAccountRequest(new \JustCommunication\WiracleSDK\API\AccountRequest());
        return $response->getAccount();
    }

    public function __call($name, array $arguments)
    {
        if (0 === \strpos($name, 'send')) {
            return call_user_func_array([$this, 'sendRequest'], $arguments);
        }

        throw new \BadMethodCallException(\sprintf('Method [%s] not found in [%s].', $name, __CLASS__));
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     *
     * @throws WiracleAPIException
     */
    public function sendRequest(RequestInterface $request)
    {
        try {
            /** @var Response $response */
            $response = $this->createAPIRequestPromise($request)->wait();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            self::handleErrorResponse($e->getResponse(), $this->logger);

            throw new WiracleAPIException('Wiracle API Request error: ' . $e->getMessage());
        }

        return self::createAPIResponse($response, $request->getResponseClass());
    }

    public function createAPIRequestPromise(RequestInterface $request)
    {
        $request_params = $request->createHttpClientParams();

        $this->logger->debug('Wiracle API request {method} {uri}', [
            'method' => $request->getHttpMethod(),
            'uri' => $request->getUri(),
            'request_params' => $request_params
        ]);

        $request_params = array_merge_recursive($request_params, [
            'headers' => [
                'X-WSSE' => $this->generateWsseHeader()
            ]
        ]);

        if (!isset($request_params['base_uri'])) {
            $request_params['base_uri'] = self::API_ENDPOINT;
        }

        /*
        $stack = HandlerStack::create();
        $stack->push(
            Middleware::log(
                $this->logger,
                new MessageFormatter(MessageFormatter::DEBUG)
            )
        );

        $params['handler'] = $stack;
        */

        return $this->httpClient->requestAsync($request->getHttpMethod(), $request->getUri(), $request_params);
    }

    protected function generateWsseHeader()
    {
        $nonce = hash('sha512', uniqid(true));
        $created = date('c');
        $digest = base64_encode(sha1(base64_decode($nonce) . $created . $this->token, true));

        return sprintf('UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"',
            $this->username,
            $digest,
            $nonce,
            $created
        );
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string $apiResponseClass
     *
     * @return ResponseInterface
     *
     * @throws WiracleAPIException
     */
    protected static function createAPIResponse(\Psr\Http\Message\ResponseInterface $response, $apiResponseClass)
    {
        $response_string = (string)$response->getBody();
        $response_data = json_decode($response_string, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new WiracleAPIException('Invalid response data');
        }

        if (isset($response_data['code'], $response_data['message'])) {
            throw new WiracleAPIException('Wiracle API Error: ' . $response_data['message'], $response_data['code']);
        }

        /** @var ResponseInterface $response */
        $response = new $apiResponseClass;
        if (!$response instanceof ResponseInterface) {
            throw new WiracleAPIException('Invalid response class');
        }

        $response->setResponseData($response_data);

        return $response;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     * @throws WiracleAPIException
     */
    protected static function handleErrorResponse(\Psr\Http\Message\ResponseInterface $response = null, \Psr\Log\LoggerInterface $logger = null)
    {
        if (!$response) {
            return;
        }

        $response_string = (string)$response->getBody();
        $response_data = json_decode($response_string, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new WiracleAPIException('Unable to decode error response data. Error: ' . json_last_error_msg());
        }

        if (isset($response_data['code'], $response_data['message'])) {
            throw new WiracleAPIException('Wiracle API Error: ' . $response_data['message'], $response_data['code']);
        }
    }
}
