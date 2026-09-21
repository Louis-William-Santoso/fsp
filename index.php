<?php 
require_once __DIR__.'/class/Connect.php';
session_start();
$conn = new Connect();
// var_dump($conn->link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas FSP</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
</head>
<body>
   <?php include $conn->page ?>
</body>
</html>