<?php
require_once __DIR__.'/config.php';

// redirect the user to the login page if they aren't loggedin yet
if(!$_SESSION['loggedin']){
  header('Location: /login.php');
  die();
}

?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<main>
  <?php include __DIR__.'/parts/navbar.php'; ?>

  <div class="container px-4 py-5">
    <h2 class="pb-2 mb-2 text-center border-bottom">Dashboard</h2>
    <h4 class="pt-2 pb-3 text-center">Welcome, <?php echo htmlentities($_SESSION['user_name']); ?>!</h4>
    <div class="row">
      <div class="col-md-6 mx-auto">
        <a href="/interview.php" class="btn btn-primary">Start Interview</a><bR><br>
        [more content goes here]
      </div>
    </div>
  </div>
</main>

  <script src="/assets/js/bootstrap.js"></script>
</body>
</html>