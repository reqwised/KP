<?php
    include "config.php";
    $message = "";
    if(isset($_POST['reg_button'])) {
        if ($_POST['name'] != "" && $_POST['username'] != "" && $_POST['email'] != "" && $_POST['password'] != "") {
            $name = $_POST['name']; $username = $_POST['username']; $email = $_POST['email'];$password = $_POST['password'];
            $result = mysqli_query($mysqli,"INSERT into user (`name`,`username`,`email`,`password`) VALUES ('".$name."', '".$username."','".$email."',md5('".$password."'))");
            header("Location: login.php");
        }
        else {
            $message = "Form Belum Lengkap!";
        }
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Register</title>
        <link rel = "icon" href = "https://media.geeksforgeeks.org/wp-content/cdn-uploads/gfg_200X200.png" type = "image/x-icon">
        <link rel="stylesheet" href="login.css">
    </head>

    <body>
        <div class="container">
            <h1>Register</h1>
            <form action="register.php" method="post">
                <div style="display:flex; align-items: flex-start">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name"></input>
                    </div>
                    <div style="padding: 0px 10px 0px;"></div>
                    <div>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"></input>
                    </div>
                </div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email"></input>
                <label for="password">Password</label>
                <input type="password" name="password" id="password"></input>
                <div style="display:flex; align-items: flex-start;">
                    <button type="submit" name="reg_button" id="reg_button">Register</button>
                    <div style="padding: 0px 10px 0px;"></div>
                    <a class="backButton" href="login.php" style="text-decoration:none;" type="button">Back</a>
                </div>
            </form>
            <br></br>
            <label style="color:#f44336"><?php echo $message?></label>
        </div>
    </body>
</html>