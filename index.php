<?php include 'config/loader.php';
include 'config/router.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roadshow</title>
  <link rel="stylesheet" href="public/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>

<body>
  <?php include 'app/views/navbar.php' ?>
  <div class="page-inner">
    <?php
    $cn = $GLOBALS['cn'] ?? null;
    $method = $GLOBALS['method'] ?? 'index';
    $param = $GLOBALS['param'] ?? null;

    $cp = "app/controllers/$cn.php";
    $vp = "app/views/" . strtolower(str_replace('Controller', '', subject: $cn)) . ".php";

    if (file_exists($cp)) {
      require_once $cp;
      if (class_exists($cn)) {
        $controller = new $cn();
        if (method_exists($controller, $method)) {
          $controller->$method($param);
        } else {
          echo "Method $method not found.";
        }
      }
    } elseif (file_exists($vp)) {
      include $vp;
    } else {
      echo "Page not found!";
    }
    ?>
  </div>
</body>

</html>