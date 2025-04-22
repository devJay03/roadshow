<?php
session_start();

define('ROOT', dirname(__DIR__) . '/');
define('APP', ROOT . 'app' . '/');
define('VIEW', APP . 'views' . '/');
define('CONTROLLER', APP . 'controllers' . '/');
define('MODEL', APP . 'models' . '/');

function setActive($pages)
{
  if (isset($_GET['url'])) {
    $currentPage = explode('/', $_GET['url'])[0];

    return in_array($currentPage, $pages) ? 'active' : '';
  }
  return '';
}