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
        :root {
            --bg: #faf9f6;
            --ink: #1a1a1a;
            --muted: #666;
            --accent: #c0392b;
            --border: #ddd;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--ink);
            line-height: 1.6;
            padding: 40px 20px;
        }
        div, header {
            max-width: 650px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid var(--border);
            padding: 30px;
        }
        h1, h2 {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            margin-bottom: 16px;
        }
        h3 {
            font-size: 1rem;
            margin: 20px 0 8px;
            color: var(--ink);
        }
        p { margin-bottom: 12px; }
        a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }
        a:hover { text-decoration: underline; }
        input[type="radio"] {
            margin-right: 8px;
            vertical-align: middle;
        }
        label {
            display: inline-block;
            padding: 4px 0;
            cursor: pointer;
        }
        button, input[type="submit"] {
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            font-weight: 700;
            padding: 10px 20px;
            border: 1px solid var(--ink);
            background: var(--ink);
            color: #fff;
            cursor: pointer;
            margin: 10px 10px 0 0;
        }
        button:hover, input[type="submit"]:hover {
            background: var(--accent);
            border-color: var(--accent);
        }
        #halaman {
            font-family: 'Courier New', monospace;
            color: var(--muted);
            font-size: 0.85rem;
            margin-bottom: 20px;
        }
        .skor {
            font-family: 'Courier New', monospace;
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent);
            border-top: 2px solid var(--ink);
            padding-top: 16px;
            margin-top: 20px;
        }
        .nav-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        hr {
            border: none;
            border-top: 1px solid var(--border);
            margin: 20px 0;
        }
    </style>
</head>
<body>
   <?php include $conn->page ?>
</body>
</html>