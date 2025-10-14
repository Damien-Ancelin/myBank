<?php
require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
use Damien\MyBank\DB;

require '../elements/header.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
  <div class="row">
    <div class="col-md-6">
      <h1 class="center">Bienvenue sur myBank</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis quasi, aliquam minus facilis suscipit in, culpa magni architecto, alias aut iste dolore voluptas itaque doloremque quisquam necessitatibus ex nisi! Aspernatur?Libero perferendis voluptatibus deleniti rem! Perspiciatis perferendis quis dolorem harum sit, possimus est aspernatur eaque praesentium culpa, nihil cumque ducimus.</p>
    </div>
  
    <div class="col-md-6">
      <form action="" method="POST">
        <div class="form-group mb-3">
          <label for="email">email</label>
          <input class="form-control" type="text" name="email" id="email" value="" placeholder="mon_email@mail.io"/>
        </div>
        <div class="form-group mb-3">
          <label for="password">password</label>
          <input class="form-control" type="password" name="password" id="password" value="" placeholder="*******************"/>
        </div>
        <button class="btn btn-primary" type="submit">Se connecter</button>
      </form>
    </div>
  </div>
</div>

<?php
require '../elements/footer.php';
?>