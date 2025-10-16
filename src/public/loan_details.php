<?php
  require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

  use Damien\MyBank\DB;

  $title = "Détails du crédit | myBank";

  require '../utils/formatDate_fx.php';
  require '../elements/header.php';
?>

<?php
  $database = new DB();

  if (isset($_GET['user_id']) && isset($_GET['loan_id'])) {
    $user_id = (int) $_GET['user_id'];
    $loan_id = (int) $_GET['loan_id'];
    $transactions = $database->getTransactionToLoanId($user_id, $loan_id);
    if (!$transactions) {
      header('Location: ./account.php');
      die();
    }
  } else {
    header('Location: ./account.php');
    die();
  }

  echo '<pre>';
  print_r($transactions);
  echo '</pre>';
?>

<?php
  require '../elements/footer.php';
?>