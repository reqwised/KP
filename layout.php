<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <link rel="stylesheet" href="sidenav.css">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DISNAV SMG</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        
        <style>body {font-family: 'Nunito'; font-size: 14px;}</style>
    </head>

    <body class="antialiased">
        <nav class="navbar bg-light">
            <div class="container-fluid" style="display:flex; align-items: flex-start;">
                <h1 class="navbar-brand">LOGBOOK TRAFFIC PELAYARAN</h1>
                <a href="logout.php" type="button" class="btn btn-danger">Logout</a>
            </div>
        </nav>
        
        <!-- SIDE NAVBAR -->
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="index.php">Logbook Pelayaran</a>
                <a href="indexKapal.php">Data Master Kapal</a>
                <a href="logout.php">Log Out</a>
            </div>

            <!-- Use any element to open the sidenav -->
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; MENU</span>
         
            <!-- Script Sidebar -->
            <script>
                /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
                function openNav() {
                    document.getElementById("mySidenav").style.width = "300px";
                }

                /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
                function closeNav() {
                    document.getElementById("mySidenav").style.width = "0";
                }
            </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        </body>
</html>