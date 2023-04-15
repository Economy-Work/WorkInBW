<?php
require_once __DIR__.'/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Links</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<main>
  <?php include __DIR__.'/parts/navbar.php'; ?>

  <div class="container px-4 pt-3 pb-5">
    <h2 class="pb-2 mb-2 border-bottom">Results</h2>
    <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <th style="width: 60%;">Category</th>
            <th style="width: 40%;">Score</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $step_num = 0;
          foreach($interview_steps as $name => $step){
            if($name == 'details'){
              continue;
            }
            $step_num++;
            ?>
            <tr>
              <th scope="row" class="text-start"><?php echo htmlentities($step_num.'. '.$step['title']); ?></th>
              <td></td>
            </tr>
            <?php
            foreach($step['questions'] as $q){
              $statement = $pdo->prepare('SELECT answer FROM interviews WHERE user_id = ? AND question_name = ?');
              $statement->execute(array($_SESION['user_id'], $q['name']));
              $answer = $statement->fetch()['answer'];
              if(!$answer){
                $answer = 'not answered yet';
              }
          ?>
          <tr>
            <th scope="row" class="text-start text-secondary"><?php echo htmlentities($q['question']); ?></th>
            <td><?php echo htmlentities($answer); ?></td>
          </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>

  </div>
</main>

<?php include __DIR__.'/parts/footer.php'; ?>

  <script src="/assets/js/bootstrap.js"></script>
</body>
</html>