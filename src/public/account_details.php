<?php
  require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

  use Damien\MyBank\DB;
  use Damien\MyBank\User;

  $title = "Détails du compte | myBank";

  require '../utils/formatDate_fx.php';
  require '../elements/header.php';
?>

<?php
  if (User::isConnected()) {
      $user_id = (int) $_SESSION['id'];

      if(isset($_GET['account_id'])) {   
        $account_id = (int) $_GET['account_id'];
        $database = new DB();
        $transactions = $database->getTransactionToAccountId($user_id, $account_id);

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

  <h1 class="my-4">Détails transactions pour Compte N° <?= $account_id ?></h1>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">N° Transaction</th>
        <th scope="col">Label</th>
        <th scope="col">Somme</th>
        <th scope="col">Destinataire</th>
        <th scope="col">Type d'opération</th>
        <th scope="col">Catégorie</th>
        <th scope="col">Date de l'opération</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($transactions as $transaction): ?>
        <tr>
        <th scope="row"><?= $transaction->id ?></th>
        <td><?= $transaction->label ?></td>
        <td class="fw-bold <?= ($transaction->operation_name === 'Remboursement') ? 'text-success' : 'text-danger' ?>"><?= $transaction->amount ?>€</td>
        <?php if((!$transaction->loan_id) && (!$transaction->counterparty_id)): ?>          
          <td>Compte N° <?= $transaction->account_id ?></td>
        <?php elseif ($transaction->counterparty_id && !$transaction->loan_id): ?>
          <td>IBAN : <?= $transaction->counterparty_iban ?></td>
        <?php else: ?>
          <td>Crédit N° <?= $transaction->loan_id ?></td>
        <?php endif; ?>
        <td><?= $transaction->operation_name ?></td>
        <td><?= $transaction->category_name ?></td>
        <td><?= parseDate($transaction->created_at, true) ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<?php
  require '../elements/footer.php';
?>