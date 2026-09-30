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
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
        }
        div, header {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 650px;
            box-sizing: border-box;
        }

        h1, h2 {
            color: #2c3e50;
            margin-top: 0;
        }

        h3 {
            color: #34495e;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        input[type="radio"] {
            margin-right: 8px;
            cursor: pointer;
        }

        label {
            cursor: pointer;
            line-height: 1.8;
        }
        button, input[type="submit"] {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button:hover, input[type="submit"]:hover {
            background-color: #2980b9;
        }
        #soal p, #soal h3 {
            margin-bottom: 15px;
        }
        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
   <?php include $conn->page ?>
</body>
</html>