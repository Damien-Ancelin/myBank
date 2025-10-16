<?php

  require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
  use Damien\MyBank\User;

  User::disconnect();

  header("Location: ./index.php");
  exit();

?>