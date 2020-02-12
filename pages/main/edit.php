<?php

if (!$core->isLogin()) {
  header("Location: /login");
  die();
}

if ($form) {
  $db->query("UPDATE tasks SET text = ?s, edited = 1 WHERE id = ?i", $form['newText'], $get['id']);
  header("Location: /");
}

$task = $db->getRow("SELECT * FROM tasks WHERE id = ?i", $get['id']);

if ($task) {
  include ('tpl/main/edit.tpl');
} else {
  include ('pages/main/404.php');
}
