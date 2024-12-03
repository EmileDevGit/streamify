<?php 
    if(!isset($controller)){header("Location: ?action=");}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="VIEW/CSS/signupStyle.css">
    <title>Streamify - Signup</title>
</head>

<body>
    <div class="loginForm">
        <div class="leftSide">

        </div>
        <div class="rightSide">
            <form action="?action=signup"  method="POST" id="signupForm" name="signupForm">
                <div class="loginTitle">
                    <h2><em>Register</em> your account</h2>
                </div>
                <div class="formInputs">
                    <div class="usernameField">
                        <div class="label">
                            <label for="userName">Username</label><br>
                        </div>
                        <input type="text" name="userName" id="userName" placeholder="" required>
                    </div>
                    <div class="passwordField">
                        <div class="label">
                            <label for="userPassword">Password</label><br>
                        </div>
                        <input type="password" name="userPasswd" id="userPasswd" placeholder="" required>
                    </div>
                    <div class="emailField">
                        <div class="label">
                            <label for="userEmail">Email</label><br>
                        </div>
                        <input type="email" name="userEmail" id="userEmail" placeholder="" required>
                    </div>
                    <div class="buttonSignup">
                        <input type="submit" value="Signup" id="signup" form="signupForm">
                    </div>
                    <div>
                        <a href="?action=">Already have an account</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>