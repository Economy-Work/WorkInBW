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
            <th style="width: 60%;"></th>
            <th style="width: 40%;">Score</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-start">Job-Skills</th>
            <td>100</td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Speaking-Assignment</th>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"></use></svg></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th scope="row" class="text-start">Writing-Assignment</th>
            <td>70</td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Personality</th>
            <td>20</td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th scope="row" class="text-start">Writing-Assignment</th>
            <td>70</td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Summary</th>
            <td>260</td>
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