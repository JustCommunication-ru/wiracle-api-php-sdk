# Wiracle API PHP SDK

[![Latest Stable Version](https://poser.pugx.org/justcommunication-ru/wiracle-api-php-sdk/v)](//packagist.org/packages/justcommunication-ru/wiracle-api-php-sdk) [![Total Downloads](https://poser.pugx.org/justcommunication-ru/wiracle-api-php-sdk/downloads)](//packagist.org/packages/justcommunication-ru/wiracle-api-php-sdk) 

PHP SDK для Wiracle.ru API

## Установка

`composer require justcommunication-ru/wiracle-api-php-sdk`

## Использование

```php
$client = new WiracleClient('email', 'token');
```

`email` — email пользователя на wiracle.ru

`token` — аутентификационный токен. 
Токен можно получить через web-интерфейс https://wiracle.ru/account/settings/api, либо методом `WiracleClient::getToken($email, $password)`

## Методы

### Токен авторизации

```php
$token = WiracleClient::getToken($email, $password);

print_r($token);
```

Так же токен авторизации можно получить через web-интерфейс
https://wiracle.ru/account/settings/api

### Информация об аккаунте и его профилях

```php
$account = $client->getAccount();

print_r($account);
```

### Список каналов профиля

```php
$response = $client->sendChannelsRequest(new ChannelsRequest($profile_id));

print_r($response->getChannels());
```

### Список каналов доступных профилю

Каналы всех профилей на страницу которых можно добавлять сообщения (включая собственные)

```php
$response = $client->sendChannelsAvailableRequest(new ChannelsAvailableRequest($profile_id));

print_r($response->getProfiles());
```

### Отправить простое текстовое сообщение

```php
$response = $client->sendMessageCreateRequest(MessageCreateRequest::withPlainText($profile_id, $channel_id, $text));

// идентификатор нового сообщения
print_r($response->getId());
```

### Отправить изображение

```php
// $width, $height не обязательные поля
$response = $client->sendMessageCreateRequest(MessageCreateRequest::withImage($profile_id, $channel_id, $src, $width, $height));

// идентификатор нового сообщения
print_r($response->getId());
```

### Отправить составное сообщение

```php
$message = new Message([
    new HeaderPart('Header'),
    new TextPart('Text')
]);

$message
    ->addPart(new ImagePart('https://wiracle.ru/images/app_banner/512x512.png', 512, 512))
    ->addPart(new CutlinePart())
    ->addPart(new TextPart('Text 2'))
;

$response = $client->sendMessageCreateRequest(MessageCreateRequest::withMessage($profile_id, $channel_id, $message));

// идентификатор нового сообщения
print_r($response->getId());
```

Сообщения поддерживают inline markdown такие как: **bold text**, *italic text*, [link](https://github.com/JustCommunication-ru/wiracle-api-php-sdk) и тд.

## Обработка ошибок

При ошибке будет сгенерировано исключение ```WiracleAPIException```

```php
try {
    $client->sendMessageCreateRequest(MessageCreateRequest::withPlainText($profile_id, $channel_id, $text));
} catch (WiracleAPIException $e) {
    $logger->error('Wiracle ERROR: ' . $e->getMessage());
}
```

## Настройка HTTP клиента

### Способ №1: передача массива параметров

```php
$client = new WiracleClient('email', 'token', [
    'proxy' => 'tcp://localhost:8125',
    'timeout' => 6,
    'connect_timeout' => 4
]);
```

Список доступных параметров: https://docs.guzzlephp.org/en/stable/request-options.html

### Способ №2: передача своего `\GuzzleHttp\Client`

Настройте своего http клиента:

```php
// Http клиент с логгированием всех запросов

$stack = HandlerStack::create();
$stack->push(Middleware::log($logger, new MessageFormatter(MessageFormatter::DEBUG)));

$httpClient = new \GuzzleHttp\Client([
    'handler' => $stack,
    'timeout' => 6
]);
```

и передайте его аргументом конструктора:

```php
$client = new WiracleClient('email', 'token', $httpClient);
```

либо сеттером:

```php
$client = new WiracleClient('email', 'token');
$client->setHttpClient($httpClient);
```

## Логирование

В `$client` можно передать свой `Psr\Logger`.

```php
$client->setLogger($someLogger);
```

По-умолчанию, логирование отключено.

## Тесты

Запустить тесты можно командой:

`vendor/bin/phpunit`