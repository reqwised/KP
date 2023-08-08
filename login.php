<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="login.css">
    </head>

    <body>
        <div class="container">
            <h1>Login</h1>
            <form action="authenticate.php" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" id="username"></input>
                <label for="password">Password</label>
                <input type="password" name="password" id="password"></input>
                <div style="display:flex; align-items: flex-start;">
                    <a class="regButton" style="text-decoration:none;" href="register.php" type="button">Register</a>
                    <div style="padding: 0px 10px 0px;"></div>
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </body>
</html>