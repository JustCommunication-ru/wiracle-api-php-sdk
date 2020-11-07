# Wiracle API PHP SDK
PHP SDK для Wiracle.ru API

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

### Список каналов доступных профилю

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

### Отправить составное сообщение

```php
$message = new Message();

$message->addPart(new HeaderPart('Header'));
$message->addPart(new TextPart('Text'));
$message->addPart(new ImagePart('https://wiracle.ru/images/app_banner/512x512.png', 512, 512));
$message->addPart(new CutlinePart());
$message->addPart(new TextPart('Text 2'));

$response = $client->sendMessageCreateRequest(MessageCreateRequest::withParts($profile_id, $channel_id, $message));

// идентификатор нового сообщения
print_r($response->getId());
```

## Обработка ошибок

При ошибке будет сгенерировано исключение ```WiracleAPIException```

```php
try {
    $client->sendMessageCreateRequest(MessageCreateRequest::withPlainText($profile_id, $channel_id, $text));
} catch (WiracleAPIException $e) {
    $logger->error('Wiracle ERROR: ' . $e->getMessage());
}
```

## Логирование

В $client можно передать свой `Psr\Logger`.

```php
$client->setLogger($someLogger);
```

По-умолчанию, логирование отключено.
