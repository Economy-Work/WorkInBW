<?php
require_once __DIR__.'/config.php';

if(isset($_POST['next_step'])){
  $step = strtolower($_POST['next_step']);
}

$is_last_step = false;
if(!$step){
  $step = array_key_first($interview_steps);
  $next_step_id = 1;
}else{
  $next_step_id = array_search($step, array_keys($interview_steps))+1;
}
$next_step = array_keys($interview_steps)[$next_step_id];

if($next_step_id >= count($interview_steps)){
  $is_last_step = true;
}

$this_step = $interview_steps[$step];

if(!$this_step){
  http_response_code(404);
  echo 'Step not found!';
  die();
}

?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Interview</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<main>
  <div class="container px-4 py-5">
    <h2 class="pb-2 mb-2 text-center border-bottom">Interview</h2>
    <h4 class="pt-2 pb-3 text-center"><?php echo htmlentities($this_step['title']); ?></h4>
    <div class="row">
      <div class="col-md-6 mx-auto">
        <form method="POST">
          <input type="hidden" name="next_step" value="<?php echo htmlentities($next_step); ?>">
          <?php
          if($this_step['type'] == 'form'){
            foreach($this_step['questions'] as $question){
              $input = '<input type="text" class="form-control" name="'.htmlentities($question['name']).'" value="" required>';
              if($question['type'] == 'number'){
                $input = '<input type="number" class="form-control" name="'.htmlentities($question['name']).'" value="0" required>';
              }elseif($question['type'] == 'textarea'){
                $input = '<textarea class="form-control" name="'.htmlentities($question['name']).'" required></textarea>';
              }elseif($question['type'] == 'voice'){
                $input = '<input type="file" accept=".mp3,.wav" name="'.htmlentities($question['name']).'" capture required>';
              }
          ?>
          <div class="mb-3">
            <label class="form-label"><?php echo htmlentities($question['question']); ?></label>
            <?php echo $input; ?>
          </div>
          <?php
            }
          }
          ?>
          <button type="submit" class="btn btn-primary my-3 float-end">
            <?php
            if($is_last_step){ 
              echo 'Submit'; 
            }else{ 
              echo 'Save & Next'; 
            } 
            ?>
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