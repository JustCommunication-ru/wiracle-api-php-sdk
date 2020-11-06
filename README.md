# Wiracle API PHP SDK
PHP SDK для Wiracle.ru API

## Использование

```php
$client = new WiracleClient('email', 'token');
```

В $client можно передать свой `Psr\Logger`

```php
$client->setLogger($someLogger);
```

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
