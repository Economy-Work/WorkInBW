<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>WorkinBW</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/assets/css/bootstrap.css" rel="stylesheet">
</head>
<body  style="background: #FDFF00;">

<main>
  <?php include __DIR__.'/parts/navbar.php'; ?>

  <div class="container px-4 py-5 pt-3">

    <h1 class="pb-2 mb-2 text-center border-bottom">Welcome to WorkinBW</h1>
    <div class="row">
      <img src="/assets/img/logo.svg" class="col-md-7 mx-auto img-fluid" alt="WorkinBW">
    </div>
    <div class="container">
      <div class="row mt-3 g-5" >
        <div class="col-md-4">
          <div class="d-flex flex-column justify-content-center align-items-center text-center border rounded bg-white h-100 px-2 py-4">
            <h3>Step 1</h3>
            Sign up for WorkinBW and start the adventurous journey in TheLänd!
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex flex-column justify-content-center align-items-center text-center border rounded bg-white h-100 px-2 py-4">
            <h3>Step 2</h3>
            Hurray! Your profile is shared with employers across BW
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex flex-column justify-content-center align-items-center text-center border rounded bg-white h-100 px-2 py-4">
            <h3>Step 3</h3>
            Lets get started to experience the life of your dreams in BW!
          </div>
        </div>
      </div>
      <div class="row mt-3 gx-5">
        <div class="col-12">
          <a href="/signup.php" class="btn btn-lg btn-block btn-dark p-2 w-100">Let's get started!</a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__.'/parts/footer.php'; ?>

  <script src="/assets/js/bootstrap.js"></script>
</body>
</html>