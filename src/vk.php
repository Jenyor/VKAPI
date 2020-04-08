<?php

class VKAPI {
  private $token;     //Токен ВК
  private $version;   //Версия VK API
  private $lang;      //Язык вывода


  function __construct($token, $version, $lang = '0') { // Токен ВК, версия API, язык вывода
    if(empty($token)) die("Invalid VK token"); else { // Если токена нет, то выводим ошибку
      $this->token = $token;      //Присвоили токен VK
      $this->version = $version;  //Присвоили версию API
      $this->lang = $lang;        //Присвоили язык
    }
  }

  /**
   * Основной запрос на VK API
   *
   * $method - Вызываемый метод (Обязательно)
   * $args   - Аргументы вызываемого метода (Обязательно)
   * $json   - Вывод в формате json (Необязательно)
   * return  - Успешное выполнение: response | ошибка: error
   */

  function query($method, $args = array(), $json = true) { // Получаем аргументы
    if(count($args) > 1) $args = http_build_query($args); // Переводим массив в ссылку
    $req = $this->http("https://api.vk.com/method/{$method}?{$args}&access_token={$this->token}&lang={$this->lang}&v={$this->version}"); //Сам запрос на VK API
    return ($json) ? json_decode($req, true) : $req; // Выводим в одном из форматов
  }

  /**
   * Получение содержимого из запроса
   *
   * $url    - Ссылка (Обязательно)
   * return  - отдает ответ VK
   */

  function http($url) { // Получаем аргументы
    return file_get_contents($url); // Возваращаем содержимое запроса
  }

  /* Работа с информацией о пользователе */

  /**
   * Возвращает расширенную информацию о пользователях
   *
   * $user_ids  - Идентификаторы пользователей, либо их короткие имена (Обязательно)
   * $fields    - Список дополнительных полей профилей, которые необходимо вернуть (Необязательно)
   * $name_case - Падеж для склонения имени и фамилии пользователя (Необязательно)
   * $json      - Вывод в формате json (Необязательно)
   * return     - После успешного выполнения возвращает массив объектов пользователей.
   */

  function users_get($user_ids = array(), $fields = array(), $name_case = array(), $json = true) { // Получаем аргументы
    if(!empty($fields)) $fields = "&fields=".implode(',', $fields); else $fields = ""; // Если не пуст, то переводим массив в ссылку, разбивая каждый айтем через запятую
    if(!empty($user_ids)) $user_ids = "&user_ids=".implode(',', $user_ids); else die("Введите один хотя бы один ID"); // Если не пуст, то переводим массив в ссылку, разбивая каждый айтем через запятую
    if(!empty($name_case)) $name_case = "&name_case=".implode(',', $name_case); else $name_case = ""; // Если не пуст, то переводим массив в ссылку, разбивая каждый айтем через запятую
    return $this->query('users.get', "{$chat_ids}{$fields}{$name_case}", $json); //Отправляем запрос
  }

  /**
   * Возвращает список идентификаторов пользователей, которые являются подписчиками пользователя
   *
   * $user_id   - Идентификатор пользователя. (Обязательно)
   * $offset    - Смещение, необходимое для выборки определенного подмножества подписчиков (Необязательно)
   * $count     - Количество подписчиков, информацию о которых нужно получить. (Необязательно)
   * $fields    - Список дополнительных полей профилей, которые необходимо вернуть (Необязательно)
   * $name_case - Падеж для склонения имени и фамилии пользователя (Необязательно)
   * $json      - Вывод в формате json (Необязательно)
   * return     - После успешного выполнения возвращает объект, содержащий число результатов в поле count и массив объектов user в поле items.
   */

  function users_getFollowers($user_id, $offset = 0, $count = 100, $fields = array(), $name_case = array(), $json = true) { // Получаем аргументы
    if(!empty($fields)) $fields = "&fields=".implode(',', $fields); else $fields = ""; // Если не пуст, то переводим массив в ссылку, разбивая каждый айтем через запятую
    if(!empty($name_case)) $name_case = "&name_case=".implode(',', $name_case); else $name_case = ""; // Если не пуст, то переводим массив в ссылку, разбивая каждый айтем через запятую
    return $this->query('users.getFollowers', "user_id={$user_id}&offset={$offset}&count={$count}{$fields}{$name_case}", $json); //Отправляем запрос
  }

  /**
   * Возвращает список идентификаторов пользователей и публичных страниц, которые входят в список подписок пользователя.
   *
   * $user_id   - Идентификатор пользователя, подписки которого необходимо получить. (Обязательно)
   * $extended  - Возвращает список идентификаторов групп и пользователей (1 - раздельно, 0 - слитно) (Необязательно)
   * $offset    - Смещение, необходимое для выборки определенного подмножества подписчиков (Необязательно)
   * $count     - Количество подписчиков, информацию о которых нужно получить. (Необязательно)
   * $fields    - Список дополнительных полей профилей, которые необходимо вернуть (Необязательно)
   * $json      - Вывод в формате json (Необязательно)
   * return     - После успешного выполнения возвращает объекты users и groups, каждый из которых содержит поле count —
   *              количество результатов и items — список идентификаторов пользователей или публичных страниц, на которые подписан текущий пользователь
   *              (из раздела «Интересные страницы»).
   */

  function users_getSubscriptions($user_id, $extended = 0, $offset = 0, $count = 100, $fields = array(), $json = true) { // Получаем аргументы
    if(!empty($fields)) $fields = "&fields=".implode(',', $fields); else $fields = ""; // Если не пуст, то переводим массив в ссылку, разбивая каждый айтем через запятую
    return $this->query('users.getSubscriptions', "user_id={$user_id}&offset={$offset}&count={$count}{$fields}{$name_case}", $json); //Отправляем запрос
  }

  /* Работа с чатами */

  /**
   * Информация о беседе.
   *
   * $id_chat   - ID чата (Обязательно)
   * $chat_ids  - ID нескольких чатов (Необязательно)
   * $fields    - Список дополнительных полей профилей, которые необходимо вернуть (Необязательно)
   * $name_case - Падеж для склонения имени и фамилии пользователя (Необязательно)
   * $json      - Вывод в формате json (Необязательно)
   * return     - После успешного выполнения возвращает объект (или список объектов) мультидиалога.
   */

  function messages_GetChat($id_chat, $chat_ids = array(), $fields = array(), $name_case = array(), $json = true) { // Получаем аргументы
    if(!empty($fields)) $fields = "&fields=".implode(',', $fields); else $fields = ""; // Если не пуст, то переводим массив в ссылку, разбивая каждый айтем через запятую
    if(!empty($chat_ids)) $chat_ids = "&chat_ids=".implode(',', $chat_ids); else $chat_ids = ""; // Если не пуст, то переводим массив в ссылку, разбивая каждый айтем через запятую
    if(!empty($name_case)) $name_case = "&name_case=".implode(',', $name_case); else $name_case = ""; // Если не пуст, то переводим массив в ссылку, разбивая каждый айтем через запятую
    return $this->query('messages.getChat', "chat_id={$id_chat}{$chat_ids}{$fields}{$name_case}", $json); //Отправляем запрос
  }

  /**
   * Получает данные для превью чата с приглашением по ссылке.
   *
   * $id_peer   - ID пользователя (Обязательно)
   * $link      - ссылка-приглашение. (Обязательно)
   * $fields    - Список дополнительных полей профилей, которые необходимо вернуть (Необязательно)
   * $json      - Вывод в формате json (Необязательно)
   * return     - Возвращает объект, который содержит следующие поля:
   *
   *            preview  - информация о чате
   *            profiles - массив объектов пользователей
   *            groups   - массив объектов сообществ
   *            emails   - массив объектов, описывающих e-mail
   */

  function messages_getChatPreview($id_peer, $link, $fields = array(), $json = true) { // Получаем аргументы
    if(!empty($fields)) $fields = "&fields=".implode(',', $fields); else $fields = ""; // Если не пуст, то переводим массив в ссылку, разбивая каждый айтем через запятую
    return $this->query('messages.getChatPreview', "peer_id={$id_peer}&link={$link}{$fields}", $json); //Отправляем запрос
  }

  /* Работа с утилитами */

  /**
   * Возвращает информацию о том, является ли внешняя ссылка заблокированной на сайте ВКонтакте.
   *
   * $url       - внешняя ссылка, которую необходимо проверить. (Обязательно)
   * $json      - Вывод в формате json (Необязательно)
   * return     - Возвращает объект, который содержит следующие поля:
   *
   *            status         - статус ссылки. Возможные значения:
   *              not_banned   - ссылка не заблокирована
   *              banned       - ссылка заблокирована
   *              processing   - ссылка проверяется, необходимо выполнить повторный запрос через несколько секунд.
   *            link           - исходная ссылка (url) либо полная ссылка (если в url была передана сокращенная ссылка).
   */

  function utils_checkLink($url, $json = true) { // Получаем аргументы
    return $this->query('utils.checkLink', "url={$url}", $json); //Отправляем запрос
  }

  /**
   * Возвращает информацию о том, является ли внешняя ссылка заблокированной на сайте ВКонтакте.
   *
   * $url       - Короткое имя пользователя, группы или приложения. Например, apiclub, andrew или rules_of_war. (Обязательно)
   * $json      - Вывод в формате json (Необязательно)
   * return     - Возвращает объект, который содержит следующие поля:
   *
  *            type            - тип объекта. Возможные значения:
   *              user         - пользователь
   *              group        - сообщество
   *              application  - приложение
   *           object_id       - идентификатор объект
   */

  function utils_resolveScreenName($screen_name, $json = true) { // Получаем аргументы
    return $this->query('utils.resolveScreenName', "screen_name={$screen_name}", $json); //Отправляем запрос
  }


}

 ?>
