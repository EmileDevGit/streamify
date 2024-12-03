<?php 
    if(!isset($controller)){header("Location: ?action=");}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="VIEW/CSS/loginStyle.css">
    <title>Streamify - Login</title>
</head>

<body>
    <div class="loginForm">
        <div class="leftSide">

        </div>
        <div class="rightSide">
            <form  action="?action=login" method="post" id="loginForm" name="loginForm">
                <div class="loginTitle">
                    <h2><em>Login</em> your account</h2>
                </div>
                <div class="formInputs">
                    <div class="usernameField">
                        <div class="label">
                            <label for="userName">Username</label><br>
                        </div>
                        <input type="text" name="userName" id="userName" required placeholder="" >
                    </div>
                    <div class="passwordField">
                        <div class="label">
                            <label for="userPasswd">Password</label><br>
                        </div>
                        <input type="password" name="userPasswd" id="userPasswd" required placeholder="" >
                    </div>

                    <div class="buttonLogin">
                        <input type="submit" value="Login" id="login" form="loginForm">
                    </div>
                    <div class="signupLink">
                        <a href="?action=gotoSignup">Create an account</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>