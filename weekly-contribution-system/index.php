<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Weekly Contribution System</title>

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
    font-family:Arial;
    background:#f5f7fb;
}

/* NAVBAR */

.navbar{
    background:white;
    padding:15px 40px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.logo{
    font-size:28px;
    font-weight:bold;
    color:#031b4e;
}

.nav-links a{
    text-decoration:none;
    margin-left:25px;
    color:#333;
    font-weight:500;
}

.btn-login{
    background:#2563eb;
    color:white !important;
    padding:10px 20px;
    border-radius:10px;
}

/* HERO */

.hero{
    min-height:90vh;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:60px;
}

.hero-text{
    width:50%;
}

.hero-text h1{
    font-size:60px;
    font-weight:bold;
    margin-bottom:20px;
    color:#031b4e;
}

.hero-text p{
    font-size:20px;
    color:#666;
    margin-bottom:30px;
}

.hero-buttons a{
    text-decoration:none;
    padding:15px 30px;
    border-radius:12px;
    margin-right:15px;
    font-weight:bold;
}

.btn-start{
    background:#16a34a;
    color:white;
}

.btn-admin{
    border:2px solid #031b4e;
    color:#031b4e;
}

.hero-image{
    width:45%;
}

.hero-image img{
    width:100%;
}

/* FEATURES */

.features{
    padding:80px 60px;
    background:white;
}

.section-title{
    text-align:center;
    margin-bottom:50px;
}

.section-title h2{
    font-size:40px;
    color:#031b4e;
}

.feature-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:30px;
}

.feature-box{
    background:#f8fafc;
    padding:30px;
    border-radius:20px;
    text-align:center;
}

.feature-box i{
    font-size:40px;
    color:#2563eb;
    margin-bottom:20px;
}

.feature-box h4{
    margin-bottom:15px;
}

/* FOOTER */

.footer{
    background:#031b4e;
    color:white;
    text-align:center;
    padding:25px;
}

@media(max-width:900px){

    .hero{
        flex-direction:column;
        text-align:center;
    }

    .hero-text{
        width:100%;
        margin-bottom:40px;
    }

    .hero-image{
        width:100%;
    }

    .hero-text h1{
        font-size:42px;
    }

    .feature-grid{
        grid-template-columns:1fr;
    }

}

</style>

</head>
<body>

<!-- NAVBAR -->

<nav class="navbar d-flex justify-content-between align-items-center">

    <div class="logo">
        Weekly Contribution
    </div>

    <div class="nav-links">

        <a href="index.php">
            Home
        </a>

        <a href="auth.php">
    Register
</a>

<a href="auth.php" class="btn-login">
    Login
</a>

    </div>

</nav>

<!-- HERO -->

<section class="hero">

    <div class="hero-text">

        <h1>
            Smart Weekly Contribution Platform
        </h1>

        <p>
            Manage contributions, fines,
            and online payments easily using
            our secure contribution system.
        </p>

        <div class="hero-buttons">

            <a href="auth.php"
   class="btn-start">

    Get Started

</a>

<a href="admin"
   class="btn-admin">

    Admin Panel

</a>

        </div>

    </div>

    <div class="hero-image">

        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

    </div>

</section>

<!-- FEATURES -->

<section class="features">

    <div class="section-title">

        <h2>
            Platform Features
        </h2>

    </div>

    <div class="feature-grid">

        <div class="feature-box">

            <i class="fa fa-wallet"></i>

            <h4>
                Weekly Contributions
            </h4>

            <p>
                Members contribute weekly
                using online or cash payments.
            </p>

        </div>

        <div class="feature-box">

            <i class="fa fa-mobile"></i>

            <h4>
                Paystack Payments
            </h4>

            <p>
                Accept secure M-Pesa and
                card payments online.
            </p>

        </div>

        <div class="feature-box">

            <i class="fa fa-triangle-exclamation"></i>

            <h4>
                Automatic Fines
            </h4>

            <p>
                Late contributors are
                automatically fined.
            </p>

        </div>

    </div>

</section>

<!-- FOOTER -->

<footer class="footer">

    <p>

        © 2026 Weekly Contribution System.
        All rights reserved.

    </p>

</footer>

</body>
</html>