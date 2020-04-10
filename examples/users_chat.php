<?php
$VK = new VKAPI("xxxxxxx", "5.103"); // 'xxxxxxx' - token vk, '5.103' - version vkapi

$users = $VK->messages_getChat('1', null, ['status'])->users;

for ($i=0; $i < count($users); $i++) {
  if(!isset($users[$i]->deactivated)) // Проверка на удаленных и забаенных пользователей
    echo "{$users[$i]->first_name} {$users[$i]->last_name}\n";  // Вывод имени и фамилии
}

 ?>
