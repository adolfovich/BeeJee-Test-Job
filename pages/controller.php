<?php

if (isset($url[0]) && $url[0] == 'login') {
  include ('pages/main/login.php');
} else if (isset($url[0]) && $url[0] == 'logout') {
  include ('pages/main/logout.php');
} else {
  include ('pages/main/template.php');
}
