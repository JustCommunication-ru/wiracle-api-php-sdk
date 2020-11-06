# Wiracle API PHP SDK
PHP SDK для Wiracle.ru API

## Использование

```php
$client = new WiracleClient('username', 'token');
```

В $client можно передать свой `Psr\Logger`

```php
$client->setLogger($someLogger);
```

## Методы

### Токен авторизации

```php
$client = new \JustCommunication\WiracleSDK\WiracleClient('', '');

$email = 'wiracle@example.com';
$profile_id = md5('password');

$response = $client->sendTokenRequest(new TokenRequest($email, $profile_id));

print_r($response->getToken());
```

Так же токен авторизации можно получить через web-интерфейс
https://wiracle.ru/account/settings/api

### Информация об аккаунте и его профилях

```php
$response = $client->sendAccountRequest(new AccountRequest());

print_r($response->getAccount());
```

### Список каналов доступных профилю

```php
$profile_id = 123;
$response = $client->sendChannelsAvailableRequest(new ChannelsAvailableRequest($profile_id));

print_r($response->getProfiles());
```

### Отправить сообщение

```php
$response = $client->sendMessageCreateRequest(MessageCreateRequest::withPlainText($profile_id, $channel_id, $text));

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
