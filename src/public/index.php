<?php
  require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
  use Damien\MyBank\Test;
  use Damien\MyBank\DB;

  require '../elements/header.php';
?>

<h1>Accueil</h1>

<?php
  $database = new DB();
?>

<?php
  require '../elements/footer.php';
?>