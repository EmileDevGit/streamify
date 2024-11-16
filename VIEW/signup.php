<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/signupStyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streamify - Signup</title>
</head>

<body>
    <div class="loginForm">
        <div class="leftSide">

        </div>
        <div class="rightSide">
            <form action="Discovery.html" method="POST" id="loginForm" name="loginForm">
                <div class="loginTitle">
                    <h2><em>Register</em> your account</h2>
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
                    <div class="emailField">
                        <div class="label">
                            <label for="userEmail">Email</label><br>
                        </div>
                        <input type="email" name="userEmail" id="userEmail" placeholder="" required>
                    </div>
                    <div class="buttonSignup">
                        <button>Signup</button>
                    </div>
                    <div>
                        <a href="login.html" target="_self">Already have an account</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>