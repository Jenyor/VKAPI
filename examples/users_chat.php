<?php
$VK = new VKAPI("xxxxxxx", "5.103");

$users = $VK->messages_getChat('182', null, ['status'])->response->users;

$final = array();
for ($i=0; $i < count($users); $i++) {
  if(!isset($users[$i]->deactivated))
    echo "{$users[$i]->first_name} {$users[$i]->last_name}\n"; // Проверка на удаленных и забаенных пользователей
}

 ?>
