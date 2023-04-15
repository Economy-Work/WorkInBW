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

  <div class="container px-4 pt-3 pb-5">
    <h2 class="pb-2 mb-2 border-bottom">Dashboard</h2>
    <h4 class="pt-2 pb-3">Welcome, <?php echo htmlentities($_SESSION['user_name']); ?>! 👋</h4>
    <div class="row">
      <div class="col-md-8">
        <div class="stepper d-flex flex-column mt-5 ml-2">
          <?php
          $step_num = 0;
          $future_step = true;
          $action_shown = false;
          foreach($interview_steps as $name => $step){
            $step_num++;
            $completed = false;
            $future_step = true;

            // check if the user has already completed this step
            $statement = $pdo->prepare('SELECT id FROM interview WHERE user_id = ? AND step = ?');
            $statement->execute(array($_SESION['user_id'], $name));
            $interview_submission = $statement->fetch();
            if($interview_submission){
              $completed = true;
            }
            if($completed){
              $future_step = false;
            }
          ?>
          <div class="d-flex mb-1">
            <div class="d-flex flex-column pr-4 align-items-center">
              <div class="rounded-circle py-2 px-3 <?php if($completed){ echo 'bg-dark text-white'; }else{ echo 'bg-body-secondary'; } ?> mb-1"><?php echo $step_num; ?></div>
              <?php if($step_num != count($interview_steps)){ ?><div class="line border-end border-2 border-gray h-100"></div><?php } ?>
            </div>
            <div class="ps-3 pb-3">
              <h5 class="pt-2">
                <?php echo htmlentities($step['title']); ?>
                <?php if($completed){ ?>
                  <big><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle text-success" viewBox="0 0 16 16"><path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/><path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/></svg></big>
                <?php } ?>
              </h5>
              <p class="lead text-muted"><?php echo htmlentities($step['description']); ?></p>
              <?php
              if(!$completed && $future_step && !$action_shown){
                $action_shown = true;
              ?>
                <a href="/interview.php?step=<?php echo $name; ?>" class="btn btn-outline-dark">
                  Enter details
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                </a>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-4 pt-5">
        <div class="card w-100">
          <div class="card-body">
            <h5 class="card-title">Get Started in THE LÄND</h5>
            <p class="card-text">Learn more about accomondations, visas, transportation and more in Baden-Württemberg!</p>
            <a href="/links.php" class="btn btn-dark">
              View Resources
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__.'/parts/footer.php'; ?>

  <script src="/assets/js/bootstrap.js"></script>
</body>
</html>