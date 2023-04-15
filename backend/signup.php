<?php
require_once __DIR__.'/config.php';

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
  $statement = $pdo->prepare('INSERT INTO users (email, name, password, time) VALUES (?, ?, ?, ?)');
  $statement->execute(array($_POST['email'], $_POST['name'], $_POST['password'], time()));
  $user_id = $pdo->lastInsertId();
  if(!$user_id){
    die('Error: Couldn\'t create account. Please try again.');
  }else{
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $user_id;
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
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 px-3 mb-4 border-bottom" style="background: #FDFF00;">
   <ul class="nav col-md-3 mb-2 mb-md-0">
      <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
    </ul>  
  
    <a href="/" class="d-flex col-12 justify-content-center flex-grow-1 align-items-center col-md-auto col-md-3 mb-2 text-dark text-decoration-none">
      <img src="/assets/img/logo.svg" height="55" alt="WorkinBW">
    </a>

    <div class="col-md-3 text-end">
      <button type="button" class="btn btn-outline-primary me-2">Login</button>
    </div>
  </header>

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
              <input class="form-control" type="password" name="password"2 required>
            </div>
          </div>
          <div class="my-3 py-2 float-start">
            Already have an account?
            <a href="/login.php">Login</a>
          </div>
          <button type="submit" class="btn btn-primary my-3 float-end">
            Create Account
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
          </button>
        </form>
      </div>
    </div>
  </div>
</main>

  <script src="/assets/js/bootstrap.js"></script>
</body>
</html>