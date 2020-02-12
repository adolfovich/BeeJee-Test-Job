<?php

$isLogin = FALSE;

if ($core->isLogin()) {
  header("Location: /");
}

if ($form) {
  if ($form['login'] == '' || $form['pass'] == '') {
    $msg_text = 'Поля логин и пароль обязательны для заполнения.';
  } else {
    $user = $db->getRow("SELECT * FROM users WHERE login = ?s", $form['login']);
    if ($user) {
      if (md5($form['pass']) == $user['pass']) {
        $core->logIn($user['login']);
        header("Location: /");
      } else {
        $msg_text = 'Неверный пароль.';
      }
    } else {
      $msg_text = 'Пользователь не найден.';
    }
  }
}

include ('tpl/main/login.tpl');
