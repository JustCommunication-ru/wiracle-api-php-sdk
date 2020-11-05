# Wiracle API PHP SDK
PHP SDK для Wiracle.ru API

## Использование
```
$client = new WiracleClient('username', 'token');
```

В $client можно передать свой `Psr\Logger`
```
$client->setLogger($someLogger);
```
## Методы

### Список каналов профиля
```
$profile_id = 123;
$response = $client->sendChannelsAvailableRequest(new ChannelsAvailableRequest($profile_id));

print_r($response->getProfiles());
```

### Отправить сообщение
```
$response = $client->sendMessageCreateRequest(MessageCreateRequest::withPlainText($profile_id, $channel_id, $text));

// идентификатор нового сообщения
print_r($response->getId());
```

## Обработка ошибок
При ошибке будет сгенерировано исключение ```WiracleAPIException```

```
try {
    $client->sendMessageCreateRequest(MessageCreateRequest::withPlainText($profile_id, $channel_id, $text));
} catch (WiracleAPIException $e) {
    $logger->error('Wiracle ERROR: ' . $e->getMessage());
}
```