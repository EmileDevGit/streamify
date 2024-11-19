<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/loginStyle.css">
    <title>Streamify - Login</title>
</head>

<body>
    <div class="loginForm">
        <div class="leftSide">

        </div>
        <div class="rightSide">
            <form action="discovery.php" method="GET" id="loginForm" name="loginForm">
                <div class="loginTitle">
                    <h2><em>Login</em> your account</h2>
                </div>
                <div class="formInputs">
                    <div class="usernameField">
                        <div class="label">
                            <label for="userID">Username</label><br>
                        </div>
                        <input type="text" name="userID" id="userID" placeholder="" required>
                    </div>
                    <div class="passwordField">
                        <div class="label">
                            <label for="userPassword">Password</label><br>
                        </div>
                        <input type="password" name="userPasswd" id="userPasswd" placeholder="" required>
                    </div>

                    <div class="buttonLogin">
                        <button>Login</button>
                    </div>
                    <div class="signupLink">
                        <a href="signup.php" target="_self">Create an account</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>