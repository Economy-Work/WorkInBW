<?php
require_once __DIR__.'/config.php';

// redirect the user to the login page if they aren't loggedin yet
if(!$_SESSION['loggedin']){
  header('Location: /login.php');
  die();
}

$step = strtolower($_GET['step']);

if(isset($_POST['action'])){

  foreach($_POST['answers'] as $question => $answer){
    if(is_array($answer)){
      $answer_txt = '';
      foreach($answer as $a){
        $answer_txt .= $a.',';
      }
      $answer = trim($answer_txt, ',');
    }
    if(!is_string($answer) || $_FILES['answers'][$question]){
      $file_name = $_FILES['answers']['name'][$question];
      $file_tmp = $_FILES['answers']['tmp_name'][$question];
      $file_type = $_FILES['answers']['type'][$question];
      continue; // TODO: handle file uploads from "speaking" step
    }
    if($question == 'writing'){
      $original_answer = $answer;
      // cll the python API to process the written text
      $curl = curl_init();
      curl_setopt_array($curl, [
        CURLOPT_URL => 'http://127.0.0.1:8001/AnalyzeText',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '', // empty to enable all supported compression algos
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['text' => $original_answer]),
        CURLOPT_HTTPHEADER => [
          'Content-Type: application/json'
        ]
      ]);
      $response = curl_exec($curl);
      $answer = $response; // save returned data into db
      curl_close($curl);

      $curl = curl_init();
      curl_setopt_array($curl, [
        CURLOPT_URL => 'http://127.0.0.1:8002/spellGrammarCheck',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '', // empty to enable all supported compression algos
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['text' => $original_answer]),
        CURLOPT_HTTPHEADER => [
          'Content-Type: application/json'
        ]
      ]);
      $response = curl_exec($curl);
      $answer .= ','.$response; // save returned data into db
      curl_close($curl);
    }
    $statement = $pdo->prepare('INSERT INTO interviews (user_id, step, question_name, answer, time) VALUES (?, ?, ?, ?, ?)');
    $statement->execute(array($_SESSION['user_id'], $step, strtolower($question), $answer, time()));
  }
  header('Location: /dashboard.php');
  die();
}

if(!$step){
  $step = array_key_first($interview_steps);
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
  <?php include __DIR__.'/parts/navbar.php'; ?>

  <div class="container px-4 py-5">
    <h2 class="pb-2 mb-2 text-center border-bottom">Interview</h2>
    <h4 class="pt-2 pb-3 text-center"><?php echo htmlentities($this_step['title']); ?></h4>
    <div class="row">
      <div class="col-md-7 mx-auto">
        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="action" value="save">
          <?php
          if($this_step['extra_info']){
            echo '<div class="alert alert-info mt-1" role="alert"><small>'.htmlentities($this_step['extra_info']).'</small></div>';
          }
          if($this_step['type'] == 'form'){
            foreach($this_step['questions'] as $question){
              $show_submit = true;
              $input = '<input type="text" class="form-control" name="answers['.htmlentities($question['name']).']" value="" required>';
              
              if($question['type'] == 'number'){
                $input = '<input type="number" class="form-control" name="answers['.htmlentities($question['name']).']" value="0" min="'.htmlentities($question['min_value']).'" max="'.htmlentities($question['max_value']).'" required>';
              }elseif($question['type'] == 'date'){
                $input = '<input type="date" class="form-control" name="answers['.htmlentities($question['name']).']" value="0" required>';
              }elseif($question['type'] == 'select'){
                $input = '<select class="form-control" name="answers['.htmlentities($question['name']).']'.($question['allow_multiselect']? '[]' : '').'" required '.($question['allow_multiselect']? 'multiple' : '').'>';
                $input .= '<option disabled selected>Select an Option</option>';
                foreach($question['options'] as $option=>$option_text){
                  if(!$option || is_numeric($option)){
                    $option = $option_text;
                  }
                  $input .= '<option value="'.htmlentities($option).'">'.htmlentities($option_text).'</option>';
                }
                $input .= '</select>';
                if($question['allow_multiselect']){
                  $input .= '<i><small>Select multiple Options by pressing and holding CTRL or CMD</small></i>';
                }
              }elseif($question['type'] == 'textarea'){
                $input = '<textarea class="form-control" name="answers['.htmlentities($question['name']).']" required></textarea>';
              }elseif($question['type'] == 'video'){
                $show_submit = false;
                $input = '<video id="video" style="display: none; width: 600px; height: 320px; max-width: 100%; background: black; transform: scaleX(-1);" autoplay></video><canvas id="canvas" style="display:none;"></canvas><h2 id="countdown"></h2><br><button type="button" id="btn" class="btn btn-dark btn-lg mx-auto mb-3">START</button><script src="/assets/js/camera.js"></script>';
              }
              if($question['extra_info']){
                $input .= '<div class="alert alert-info mt-1" role="alert"><small>'.htmlentities($question['extra_info']).'</small></div>';
              }
              if($question['video']){
              ?>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <video width="240" height="240" controls>
                    <source src="/assets/video/<?php echo htmlentities($question['video']); ?>">
                    Your browser does not support the video tag.
                  </video>
                </div>
                <div class="col-md-6">
              <?php
              }
          ?>
          <div class="mb-3">
            <label class="form-label"><?php echo htmlentities($question['question']); ?></label>
            <?php echo $input; ?>
          </div>
          <?php if($question['video']){ ?>
              </div>
            </div>
            <?php } ?>
          <?php
            }
          }
          if($show_submit){
          ?>
          <button type="submit" class="btn btn-dark my-3 float-end">
            Submit
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
          </button>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</main>

  <script src="/assets/js/bootstrap.js"></script>
</body>
</html>