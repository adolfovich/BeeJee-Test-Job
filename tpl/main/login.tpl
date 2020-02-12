<!DOCTYPE html>
<html lang="ru">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Test job - Task list login</title>

  <!-- Custom fonts for this theme -->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="/css/template.min.css" rel="stylesheet">
  <link href="/css/login.css" rel="stylesheet">

</head>

<body id="page-top">

  <div class="wrapper fadeInDown">
    <div id="formContent">
      <?php if (isset($msg_text)) { ?>
      <div class="alert alert-danger" role="alert"><?=$msg_text?></div>
      <?php } ?>

      <!-- Login Form -->
      <form method="POST">
        <input type="text" id="login" class="fadeIn second" name="login" placeholder="Логин" value="<?php if (isset($form['login'])) echo $form['login'];?>">
        <input type="password" id="password" class="fadeIn third" name="pass" placeholder="Пароль">
        <input type="submit" class="fadeIn fourth" value="Войти">
      </form>

    </div>
  </div>


  <!-- Bootstrap core JavaScript -->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>
