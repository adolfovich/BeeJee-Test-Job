<?php

$saved = FALSE;
$error = FALSE;
$msg = [];

if (isset($get['done'])) {
  $db->query("UPDATE tasks SET status = 1 WHERE id = ?i", $get['done']);
}

if ($form) {
  if (strlen($form['login']) == 0) {
    $error = TRUE;
    $msg[] = '<i class="fa fa-exclamation-circle fw" aria-hidden="true"></i> Имя пользователя должно быть заполнено.';
  }

  if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
    $error = TRUE;
    $msg[] = '<i class="fa fa-exclamation-circle fw" aria-hidden="true"></i> Email не валиден.';
  }

  if (strlen($form['text']) == 0) {
    $error = TRUE;
    $msg[] = '<i class="fa fa-exclamation-circle fw" aria-hidden="true"></i> Поле текст должно быть заполнено.';
  }

  if (!$error) {
    $insert = [
      'name' => htmlspecialchars($form['login'], ENT_QUOTES),
      'email' => htmlspecialchars($form['email'], ENT_QUOTES),
      'text' => htmlspecialchars($form['text'], ENT_QUOTES)
    ];

    if ($db->query("INSERT INTO tasks SET ?u", $insert)) {
      $saved = TRUE;
    }
  } else {
    $msg_text = '';
    $i = 1;
    foreach ($msg as $ms) {
      $msg_text .= $ms;
      if ($i < count($msg)) {
        $msg_text .= '<br>';
      }
    }
  }
}

if (isset($get['sort']) && ($get['direct'] == 'up' || $get['direct'] == 'down')) {
  $sort = $get['sort'];
  $direct = $get['direct'];
} else {
  $sort = '';
  $direct = '';
}

if (isset($get['page'])) {
  $page = (int)$get['page'];
  $sort_page = '&page='.$page;
} else {
  $page = 1;
  $sort_page = '';
}

$tasks = $core->getTasks($sort, $direct, $page);

include ('tpl/main/default.tpl');
