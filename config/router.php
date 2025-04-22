<?php

$url = explode('/', $_GET['url'] ?? 'index');
$cn = ucfirst($url[0]) . 'Controller';
$method = $url[1] ?? 'index';
$param = $url[2] ?? null;

if ($url[0] === 'api') {
  $apiController = ucfirst($url[1]) . 'Controller';
  $apiMethod = $url[2] ?? 'index';
  $apiParam = $url[3] ?? null;

  $cp = "app/controllers/$apiController.php";

  if (file_exists($cp)) {
    require_once $cp;
    if (class_exists($apiController)) {
      $controller = new $apiController();
      if (method_exists($controller, $apiMethod)) {
        header('Content-Type: application/json');
        echo json_encode($controller->$apiMethod($apiParam));
        exit;
      }

      http_response_code(404);
      echo json_encode(["error" => "Method not found"]);
      exit;
    }
  }

  http_response_code(404);
  echo json_encode(["error" => "API controller not found"]);
  exit;
}

$GLOBALS['cn'] = $cn;
$GLOBALS['method'] = $method;
$GLOBALS['param'] = $param;
