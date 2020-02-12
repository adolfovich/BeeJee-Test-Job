<?php

session_start();

require_once('_conf.php');

if ($debug_mode) {
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
} else {
  error_reporting(0);
}

include ('classes/safemysql.class.php');
$db = new SafeMySQL(array('host' => $db_host,'user' => $db_user, 'pass' => $db_pass, 'db' => $db_name, 'charset' => 'utf8'));

require_once('classes/core.class.php');

$core  = new Core();
$url = $core->url;
$form = $core->form;
$get = $core->get;

require_once('pages/controller.php');
