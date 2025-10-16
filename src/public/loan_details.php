<?php
  require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

  use Damien\MyBank\DB;
  use Damien\MyBank\User;

  $title = "Détails du crédit | myBank";

  require '../utils/formatDate_fx.php';
  require '../elements/header.php';
?>

<?php

if (User::isConnected()) {
      $user_id = (int) $_SESSION['id'];

      if(isset($_GET['loan_id'])) {   
        $loan_id = (int) $_GET['loan_id'];
        $database = new DB();
        $transactions = $database->getTransactionToLoanId($user_id, $loan_id);

        if (!$transactions) {
          header('Location: ./account.php');
          die();
        }
    }
  } else {
      header('Location: ./index.php');
      die();
  }
?>

<div class="container">

  <h1 class="my-4">Détails transactions pour Prêt N° <?= $loan_id ?></h1>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">N° Transaction</th>
        <th scope="col">Label</th>
        <th scope="col">Somme</th>
        <th scope="col">Depuis</th>
        <th scope="col">Type d'opération</th>
        <th scope="col">Date de l'opération</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($transactions as $transaction): ?>
        <tr>
        <th scope="row"><?= $transaction->id ?></th>
        <td><?= $transaction->label ?></td>
        <td class="fw-bold text-danger"><?= $transaction->amount ?>€</td>
          <td>Compte N° <?= $transaction->account_id ?></td>
        <td><?= $transaction->operation_name ?></td>
        <td><?= parseDate($transaction->created_at, true) ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<?php
  require '../elements/footer.php';
?>