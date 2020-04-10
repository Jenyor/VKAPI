# PHP VKAPI - Библиотека для работы с API VK.COM

### Подключение
```php
$VK = new VKAPI(">>> TOKEN VK <<<", ">>> VKAPI VERSION <<<");
```
***
### Использование
```php
$VK = new VKAPI(">>> TOKEN VK <<<", "5.103"); // Объявляем главный класс, передавая в него токен и версию VK API

$wall = $VK->query(
  'wall.get', [ // Метод
    'owner_id' => '1', // Идентификатор пользователя
    'count' => '1', // Выводимое кол-во
    'filter' => 'owner' // Выводить записи только владельца страницы
  ]
);

```
#### [Подробнее об основыных методах](https://github.com/maalcjke/VKAPI/wiki/%D0%9E%D1%81%D0%BD%D0%BE%D0%B2%D0%BD%D1%8B%D0%B5)
#### [Готовые](https://github.com/maalcjke/VKAPI/wiki/%D0%A1%D1%83%D1%89%D0%B5%D1%81%D1%82%D0%B2%D1%83%D1%8E%D1%89%D0%B8%D0%B5-%D0%BC%D0%B5%D1%82%D0%BE%D0%B4%D1%8B) методы
***
### Дополнительно
Используйте [Вики](https://github.com/maalcjke/VKAPI/wiki) , чтобы подробнее узнать о библиотеке
1. [Примеры](https://github.com/maalcjke/VKAPI/wiki/%D0%9F%D1%80%D0%B8%D0%BC%D0%B5%D1%80%D1%8B-%D0%B8%D1%81%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F)
2. [Просмотр существующих методов](https://github.com/maalcjke/VKAPI/wiki/%D0%A1%D1%83%D1%89%D0%B5%D1%81%D1%82%D0%B2%D1%83%D1%8E%D1%89%D0%B8%D0%B5-%D0%BC%D0%B5%D1%82%D0%BE%D0%B4%D1%8B)
***
### TODO:
1. Реализация поддержки Standalone приложений
2. Реализация единого обработчика ошибок
***
vkapi,vk,api,php
