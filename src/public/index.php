<?php
require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
use Damien\MyBank\DB;
use Damien\MyBank\User;

require '../elements/header.php';
?>

<?php
  if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $database = new DB();
    $user = $database->login($email, $password);
    
    if ($user) {
        $user->addSession($user);
        $success = "Vous êtes connecté";
        $error = null;
    } else {
        $success = null;
        $error = "Email ou mot de passe incorrect";
    }
  }
?>

<div class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
  <div class="row">
    <div class="col-md-6">
      <h1 class="center">Bienvenue sur myBank</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis quasi, aliquam minus facilis suscipit in, culpa magni architecto, alias aut iste dolore voluptas itaque doloremque quisquam necessitatibus ex nisi! Aspernatur?Libero perferendis voluptatibus deleniti rem! Perspiciatis perferendis quis dolorem harum sit, possimus est aspernatur eaque praesentium culpa, nihil cumque ducimus.</p>
    </div>

    <?php if (User::isConnected()): ?>
    <div class="col-md-6 text-center align-self-center">
      <p>Bienvenue <?= htmlentities($_SESSION['firstname']) . ' ' . htmlentities($_SESSION['lastname']) ?></p>
      <a href="./account.php" class="btn btn-primary">Voir mes comptes</a>
      <a href="./logout.php" class="btn btn-secondary">Se déconnecter</a>
    </div>
    <?php else: ?>
    <div class="col-md-6">
      <form action="" method="POST">
        <div class="form-group mb-3">
          <label for="email">email</label>
          <input class="form-control" type="email" name="email" id="email" value="" placeholder="mon_email@mail.io"/>
        </div>
        <div class="form-group mb-3">
          <label for="password">password</label>
          <input class="form-control" type="password" name="password" id="password" value="" placeholder="*******************"/>
        </div>
        <button class="btn btn-primary" type="submit">Se connecter</button>
      </form>
    </div>
    <?php endif; ?>
  </div>
</div>

<div class="container mb-1">
  <?php if(!empty($_POST)): ?>
    <?php if(isset($success)): ?>
      <p class="alert alert-success"><?= $success ?></p>
    <?php else: ?>
      <p class="alert alert-danger"><?= $error ?></p>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php
require '../elements/footer.php';
?>