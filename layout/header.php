<?php
session_start();
$session = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/colom.css">
    <link rel="stylesheet" href="css/nav.css">

    <link rel="icon" href="img/icon.png">
    <title>Alkomart</title>
</head>

<body>
    <nav>
        <ul>
            <a href="./"><img class="logo" src="img/Alkomart.png" alt="Alkomart"></a>
        </ul>
        <ul>
            <li>
                <div class="line">
                    <hr>
                    <hr>
                    <hr>
                </div>
                <ul>
                    <li><a class="navbar nav-a active" href="./">Home</a></li>
                    <li><a class="navbar nav-a" href="about.html">About</a></li>
                    <li><a class="navbar nav-a" href="product.html">Product</a></li>
                    <li><a class="navbar nav-a" href="contact.php">Contact</a></li>
                </ul>
            </li>
            <li class="search">
                <form method="get">
                    <div class="search-box">
                        <input type="text" placeholder="Search....">
                        <button type="submit">Search</button>
                    </div>
                </form>

            </li>
        </ul>
    </nav>
    <main>