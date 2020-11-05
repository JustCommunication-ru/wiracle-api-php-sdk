<?php
namespace JustCommunication\WiracleSDK;

use GuzzleHttp\Psr7\Response;
use JustCommunication\WiracleSDK\API\RequestInterface;
use JustCommunication\WiracleSDK\API\ResponseInterface;
use JustCommunication\WiracleSDK\API\WiracleAPIException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;

/**
 * Class WiracleClient
 *
 * @package WiracleSDK
 *
 * @method API\MessageCreateResponse sendMessageCreateRequest(API\MessageCreateRequest $request)
 * @method API\ChannelsAvailableResponse sendChannelsAvailableRequest(API\ChannelsAvailableRequest $request)
 */
class WiracleClient implements LoggerAwareInterface
{
    use LoggerAwareTrait;

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
     */
    public function __construct($username, $token, $timeout = 10)
    {
        $this->username = $username;
        $this->token = $token;

        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => 'https://wiracle.ru/',
            'connect_timeout' => 4,
            'timeout' => $timeout
        ]);

        $this->logger = new NullLogger();
    }

    public function __call($name, array $arguments)
    {
        if (0 === \strpos($name, 'send')) {
            return call_user_func_array([ $this, 'sendRequest' ], $arguments);
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
        /** @var Response $response */
        $response = $this->createAPIRequestPromise($request)->wait();
        return $this->createAPIResponse($response, $request->getResponseClass());
    }

    /**
     * @param Response $response
     * @param string $apiResponseClass
     *
     * @return ResponseInterface
     *
     * @throws WiracleAPIException
     */
    protected function createAPIResponse(Response $response, $apiResponseClass)
    {
        $response_string = (string)$response->getBody();
        $response_data = json_decode($response_string, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new WiracleAPIException('Invalid response data');
        }

        if (isset($response_data['code'], $response_data['message'])) {
            throw new WiracleAPIException('Wiracle API Error: ' . $response_data['message'], $response_data['code']);
        }

        $response = new $apiResponseClass;
        if (!$response instanceof ResponseInterface) {
            throw new WiracleAPIException('Invalid response class');
        }

        $response->setResponseData($response_data);

        return $response;
    }

    public function createAPIRequestPromise(RequestInterface $request)
    {
        $params = array_merge_recursive($request->createHttpClientParams(), [
            'headers' => [
                'X-WSSE' => $this->generateWsseHeader()
            ]
        ]);

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

        return $this->httpClient->requestAsync($request->getHttpMethod(), $request->getUri(), $params);
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
}