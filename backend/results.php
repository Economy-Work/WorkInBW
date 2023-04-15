<?php
require_once __DIR__.'/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Results</title>
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
              $statement->execute(array($_SESSION['user_id'], $q['name']));
              $answer = $statement->fetch()['answer'];
              if(!$answer){
                $answer = 'not answered yet';
              }
          ?>
          <tr>
            <th scope="row" class="text-start text-secondary"><?php echo htmlentities($q['question']); ?></th>
            <td>
              <?php
              if($answer == 'tmp_success_mocked' || $name == 'writing'){ // TEMP
              ?>
              <span class="text-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16"><path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/></svg>
                Passed
              </span>
              <?php
              }else{
                echo htmlentities($answer);
              }
              ?>
            </td>
          </tr>
          <?php
            }
          }
          ?>
          <tr>
            <th scope="row" class="text-start text-secondary">Personality Score</th>
            <td>
              <?php
              $statement = $pdo->prepare('SELECT answer FROM interviews WHERE user_id = ? AND question_name = ?');
              $statement->execute(array($_SESSION['user_id'],'personality_score'));
              $score = $statement->fetch()['answer'];
              if(!$score){
                $score = 'not answered yet';
              }else{
                $score = json_decode($score, true)['score'];
              }
              ?>
              <span class="text-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16"><path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/></svg>
                <?php echo htmlentities($score); ?>
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</main>

<?php include __DIR__.'/parts/footer.php'; ?>

  <script src="/assets/js/bootstrap.js"></script>
</body>
</html>