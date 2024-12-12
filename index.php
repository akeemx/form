<?php
  require_once "controllers/FormController.php";
  
  $controller = new FormController();
  $isSubmitted = $controller->handleRequest();
  $celebrate = $controller->getCelebrateStatus();
  $heading = $controller->getHeading();
  $message = $controller->getMessage();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styling.css">
  </head>
  <body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
      <div class="container text-center">
        <?php
          if ($isSubmitted !== null) {
            require "views/response.php";
          } else {
            require "views/form.php";
          }
          ?>
      </div>
    </div>
    <script src="assets/bootstrap.bundle.min.js"></script>
  </body>
</html>