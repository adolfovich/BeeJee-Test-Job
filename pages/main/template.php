<?php

include ('tpl/main/head.tpl');

if (isset($url[0])) {
  if (file_exists('pages/main/'.$url[0].'.php')) {
    include ('pages/main/'.$url[0].'.php');
  } else {
    include ('pages/main/404.php');
  }
} else {
  include ('pages/main/default.php');
}

include ('tpl/main/footer.tpl');
