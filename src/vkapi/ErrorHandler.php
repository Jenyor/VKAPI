<?php

/**
* mAlc_Jke a.k.a maalcjke
* @2020
*/

class Errorhandler
{
  function entrance($json, $debug, $custom_reason) {
    if(!isset($json->response))
      ($debug) ? die(var_dump(['error', 'Code' => $json->error->error_code, 'Message' => $json->error->error_msg, 'Params' => $json->error->request_params])) : exit($custom_reason);
    else return $json->response;
  }

  function init_check($args = array()) {
    (empty($args[0])) ? die('Empty vk token') : $i++;
    (empty($args[1])) ? die('Empty version') : $i++;
    return true;
  }
}

 ?>
