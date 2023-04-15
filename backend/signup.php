<?php
require_once __DIR__.'/config.php';

// redirect the user to the dashboard if they are already loggedin
if($_SESSION['loggedin']){
  header('Location: /dashboard.php');
  die();
}

if(isset($_POST['action'])){
  if(!$_POST['email'] || !$_POST['password']){
    die('Error: missing parameters');
  }
  if($_POST['password'] != $_POST['password2']){
    die('Error: Passwords don\'t match.');
  }
  $statement = $pdo->prepare('SELECT id, email, password FROM users WHERE email = ?');
  $statement->execute(array($_POST['email']));
  $user = $statement->fetch();
  if($user){
    die('Error: User with this email address already exists. Please login instad.');
  }
  $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $statement = $pdo->prepare('INSERT INTO users (email, name, password, time) VALUES (?, ?, ?, ?)');
  $statement->execute(array($_POST['email'], $_POST['name'], $hashed_password, time()));
  $user_id = $pdo->lastInsertId();
  if(!$user_id){
    die('Error: Couldn\'t create account. Please try again.');
  }else{
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $_POST['name'];
    header('Location: /dashboard.php');
    die();
  }
}

?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Signup</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<main>
  <?php include __DIR__.'/parts/navbar.php'; ?>

  <div class="container px-4 py-5">
    <h2 class="pb-2 mb-4 text-center border-bottom">Sign Up</h2>
    <div class="row">
      <div class="col-md-6 mx-auto">
        <form method="POST">
          <input type="hidden" name="action" value="signup">
          <div class="mb-2">
            <label class="form-label">Name</label>
            <input class="form-control" type="text" name="name" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" required>
          </div>
          <div class="mb-2 row">
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input class="form-control" type="password" name="password" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Repeat Password</label>
              <input class="form-control" type="password" name="password2" required>
            </div>
          </div>
          <div class="my-3 py-2 float-start">
            Already have an account?
            <a href="/login.php">Login</a>
          </div>
          <button type="submit" class="btn btn-dark my-3 float-end">
            Create Account
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
          </button>
        </form>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__.'/parts/footer.php'; ?>

  <script src="/assets/js/bootstrap.js"></script>
</body>
</html>