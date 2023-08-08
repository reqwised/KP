<?php
    include_once "config.php";
    session_start();
    if ( mysqli_connect_errno() ) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    if ( !isset($_POST['username'], $_POST['password']) ) {
        exit('Isi Data Username dan Password');
    }
    else {
        if ($stmt = $mysqli->prepare('SELECT username, password FROM user WHERE username = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($username,$password);
                $stmt->fetch();
                // Account exists, now we verify the password.
                // Note: remember to use password_hash in your registration file to store the hashed passwords.
                if (substr(md5($_POST['password']),0,30) == $password) {
                    // Verification success! User has logged-in!
                    // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['username'];
                    header('Location: index.php');
                } else {
                    // Incorrect password
                    echo 'Username dan/atau password salah!';
                }
            } else {
                // Incorrect username
                echo 'Username dan/atau password salah!';
            }
            $stmt->close();
        }
    }
?>