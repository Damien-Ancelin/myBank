<?php
require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use Damien\MyBank\DB;

$title = "Mes comptes | myBank";

require '../utils/formatDate_fx.php';
require '../elements/header.php';
?>

<?php
$database = new DB();
$accounts = $database->getAccounts(1);
$loans = $database->getLoans(1);
// echo '<pre>';
//   print_r($accounts);
// echo '</pre>';
?>

<div class="container">
  <h1 class="mb-4">Mes comptes</h1>

  <h2>Comptes courant</h2>

  <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
    <?php foreach ($accounts as $account): ?>
      <div class="col">
        <?php if ($account->status === 'active'): ?>
          <div class="card text-bg-success mb-3">
        <?php else: ?>
          <div class="card text-bg-secondary mb-3">
        <?php endif ?>
          <div class="card-header">
            <a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="./account_details.php?user_id=<?= $account->user_id ?>&account_id=<?= $account->id ?>">Compte N° <?= $account->id ?> | <?= $account->account_type ?></a>
          </div>
          <div class="card-body">
            <h5 class="card-title"><?= $account->balance ?>€</h5>
            <h6 class="card-subtitle mb-2 text-muted">IBAN : <?= $account->IBAN ?></h6>
            <?php if((int)$account->interest_rate  !== 0): ?>
              <h6 class="card-subtitle mb-2 text-muted">Intêrets : <?= (int)$account->interest_rate ?> %</h6>
            <?php endif ?>
            <p class="card-text">plafond : <?= $account->limit ?> €</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Dernière mise à jour <?= parseDate($account->update_at ?? $account->created_at, true) ?></small>
          </div>
          </div>
      </div>
    <?php endforeach ?>
  </div>

  <h2>Crédits</h2>

  
  <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
    <?php foreach ($loans as $loan): ?>
      <div class="col">
        <?php if ($loan->status === 'active'): ?>
          <div class="card text-bg-warning  mb-3">
        <?php else: ?>
          <div class="card text-bg-secondary mb-3">
        <?php endif ?>
          <div class="card-header"><a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="./loan_details.php?user_id=<?= $loan->user_id ?>&loan_id=<?= $loan->id ?>">Crédit N° <?= $loan->id ?></a></div>
          <div class="card-body">
            <h5 class="card-title">Mensualisation <?= $loan->monthly_payment ?>€</h5>
            <h6 class="card-subtitle mb-2 text-muted">Intêrets : <?= (int)$loan->interest_rate ?> %</h6>
            <ul class="list-group">
              <li class="list-group-item"><strong>restant à payer :</strong> <?= $loan->remaining_amount ?> €</li>
              <li class="list-group-item"><strong>montant total du prêt :</strong> <?= $loan->total_payment ?> €</li>
              <li class="list-group-item"><strong>mois restant :</strong> <?= $loan->remaining_month ?> mois</li>
              <li class="list-group-item"><strong>date de fin :</strong> <?= parseDate($loan->end_date) ?></li>
            </ul>
          </div>
          <div class="card-footer">
            <small class="text-muted">Dernière mise à jour <?= parseDate($loan->update_at ?? $loan->created_at, true) ?></small>
          </div>
          </div>
      </div>
    <?php endforeach ?>
  </div>

</div>

<?php
require '../elements/footer.php';
?>