<?php

/**
* mAlc_Jke a.k.a maalcjke
* @2020
*/

require 'methods.php';

class VKAPI extends Methods{
  private $token;         //Токен ВК
  private $version;       //Версия VK API
  private $lang;          //Язык вывода
  private $debug;         //Режим отладки
  private $custom_reason; //Кастомная причина ошибки. Срабатывает при debug = false;


  /**
   * Подключение
   *
   * $token           - Token VKAPI (Обязательно)
   * $version         - Version API (Обязательно)
   * $lang            - language (Необязательно)
   * $debug           - debug (Необязательно)
   * $custom_reason   - custom reason VKAPI (Необязательно)
   * return           - Успешное выполнение: response | ошибка: error
   */
  function __construct($token, $version, $lang = '0', $debug = false, $custom_reason = "Произошла непредвиденная ошибка!") { // Токен ВК, версия API, язык вывода, режим отладки, своя причина
    if(Errorhandler::init_check(array($token,$version))) { // Если токена нет, то выводим ошибку
      $this->token = $token;                  //Присвоили токен VK
      $this->version = $version;              //Присвоили версию API
      $this->lang = $lang;                    //Присвоили язык
      $this->debug = $debug;                  //Присвоили режим отображения ошибок
      $this->custom_reason = $custom_reason;  //Присвоили кастомнюу причину
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
    return ($json) ? Errorhandler::entrance(json_decode($req), $this->debug, $this->custom_reason) : $req; // Выводим в одном из форматов
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

}

 ?>
