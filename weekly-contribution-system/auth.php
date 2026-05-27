<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Authentication</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(
        135deg,
        #031b4e,
        #2563eb
    );
    font-family:Arial;
}

.auth-container{
    width:950px;
    height:600px;
    background:white;
    border-radius:30px;
    overflow:hidden;
    display:flex;
    box-shadow:0 10px 40px rgba(0,0,0,0.2);
}

/* LEFT SIDE */

.left-side{
    width:50%;
    background:linear-gradient(
        135deg,
        #031b4e,
        #2563eb
    );
    color:white;
    padding:60px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.left-side h1{
    font-size:50px;
    font-weight:bold;
    margin-bottom:20px;
}

.left-side p{
    font-size:18px;
    line-height:1.7;
}

.left-side img{
    width:80%;
    margin-top:40px;
}

/* RIGHT SIDE */

.right-side{
    width:50%;
    padding:50px;
    overflow-y:auto;
}

.form-title{
    font-size:35px;
    font-weight:bold;
    color:#031b4e;
    margin-bottom:10px;
}

.form-subtitle{
    color:#666;
    margin-bottom:35px;
}

.input-group{
    margin-bottom:20px;
}

.input-group label{
    margin-bottom:8px;
    font-weight:600;
    color:#333;
}

.input-box{
    position:relative;
}

.input-box i{
    position:absolute;
    left:15px;
    top:16px;
    color:#777;
}

.input-box input{
    width:100%;
    padding:14px 14px 14px 45px;
    border:1px solid #ddd;
    border-radius:12px;
    outline:none;
}

.input-box input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,0.1);
}

.btn-auth{
    width:100%;
    background:#2563eb;
    border:none;
    color:white;
    padding:15px;
    border-radius:12px;
    font-size:18px;
    font-weight:bold;
    transition:0.3s;
}

.btn-auth:hover{
    background:#1d4ed8;
}

.switch-text{
    margin-top:25px;
    text-align:center;
    color:#666;
}

.switch-text a{
    color:#2563eb;
    text-decoration:none;
    font-weight:bold;
}

/* MOBILE */

@media(max-width:900px){

    .auth-container{
        width:95%;
        height:auto;
        flex-direction:column;
    }

    .left-side{
        width:100%;
        text-align:center;
        padding:40px;
    }

    .right-side{
        width:100%;
    }

}

</style>

</head>
<body>

<div class="auth-container">

    <!-- LEFT -->

    <div class="left-side">

        <h1>
            Weekly Contribution
        </h1>

        <p>
            Manage contributions,
            fines and online payments
            easily and securely.
        </p>

        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

    </div>

    <!-- RIGHT -->

    <div class="right-side">

        <!-- LOGIN FORM -->

        <div id="loginForm">

            <h2 class="form-title">
                Welcome Back
            </h2>

            <p class="form-subtitle">
                Login to continue
            </p>

            <!-- LOGIN -->

            <form action="login.php"
                  method="POST">

                <div class="input-group">

                    <label>Email</label>

                    <div class="input-box">

                        <i class="fa fa-envelope"></i>

                        <input type="text"
                               name="email"
                               placeholder="Enter email or admin username"
                               required>

                    </div>

                </div>

                <div class="input-group">

                    <label>Password</label>

                    <div class="input-box">

                        <i class="fa fa-lock"></i>

                        <input type="password"
                               name="password"
                               placeholder="Enter password"
                               required>

                    </div>

                </div>

                <button type="submit"
                        class="btn-auth">

                    Login

                </button>

            </form>

            <div class="switch-text">

                Don’t have an account?

                <a href="#"
                   onclick="showRegister()">

                    Register

                </a>

            </div>

        </div>

        <!-- REGISTER FORM -->

        <div id="registerForm"
             style="display:none;">

            <h2 class="form-title">
                Create Account
            </h2>

            <p class="form-subtitle">
                Register new member account
            </p>

            <!-- REGISTER -->

            <form action="register.php"
                  method="POST">

                <div class="input-group">

                    <label>Full Name</label>

                    <div class="input-box">

                        <i class="fa fa-user"></i>

                        <input type="text"
                               name="fullname"
                               placeholder="Enter full name"
                               required>

                    </div>

                </div>

                <div class="input-group">

                    <label>Email</label>

                    <div class="input-box">

                        <i class="fa fa-envelope"></i>

                        <input type="text"
                               name="email"
                               placeholder="Enter email"
                               required>

                    </div>

                </div>

                <div class="input-group">

                    <label>Password</label>

                    <div class="input-box">

                        <i class="fa fa-lock"></i>

                        <input type="password"
                               name="password"
                               placeholder="Create password"
                               required>

                    </div>

                </div>

                <button type="submit"
                        class="btn-auth">

                    Register

                </button>

            </form>

            <div class="switch-text">

                Already have an account?

                <a href="#"
                   onclick="showLogin()">

                    Login

                </a>

            </div>

        </div>

    </div>

</div>

<script>

function showRegister(){

    document.getElementById(
        "loginForm"
    ).style.display = "none";

    document.getElementById(
        "registerForm"
    ).style.display = "block";
}

function showLogin(){

    document.getElementById(
        "registerForm"
    ).style.display = "none";

    document.getElementById(
        "loginForm"
    ).style.display = "block";
}

</script>

</body>
</html>