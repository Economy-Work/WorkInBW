<?php
require_once __DIR__.'/config.php';

$step = strtolower($_GET['step']);

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
  <title></title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

<main>
  <div class="container px-4 py-5">
    <h2 class="pb-2 mb-2 text-center border-bottom">Interview</h2>
    <h4 class="pt-2 pb-3 text-center"><?php echo htmlentities($this_step['title']); ?></h4>
    <div class="row">
      <div class="col-md-6 mx-auto">
        <form method="POST">
          <?php
          if($this_step['type'] == 'form'){
            foreach($this_step['questions'] as $question){
              $input = '<input type="text" class="form-control" value="">';
              if($question['type'] == 'number'){
                $input = '<input type="number" class="form-control" value="0">';
              }elseif($question['type'] == 'textarea'){
                $input = '<textarea class="form-control"></textarea>';
              }elseif($question['type'] == 'voice'){
                $input = '<input type="file" accept=".mp3,.wav" capture>';
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
            Save & Next
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
          </button>
        </form>
      </div>
    </div>
  </div>
</main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>