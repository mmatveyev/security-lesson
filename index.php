
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container">
<?php
session_start();
include 'main.php';
$dispatcher = new Main();
try {
    $dispatcher->dispatch();
} catch (PDOException $e) {
    $trace = $e->getTrace();
    printf('Exception: %s. Query was: %s', $e->getMessage(), $trace[0]['args'][0]);
}

?>
</div> <!-- /container -->
</body>
</html>
