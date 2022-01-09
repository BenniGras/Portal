<!DOCTYPE html>
<html>
<head>
    <title>Anmelden</title>
    <meta http-equice="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/login.css">
</head>
<body class="background-picture">

<?php include "../components/header.php";?>

<?php if(!empty($error)): ?>
    <p>
        <?php echo $error ?>
    </p>
<?php endif; ?>

<div class="form">
    <div class="links">
        <a href="anmelden" class="link">
        <div class="button_anmelden"><p style="margin: 35px auto;">Anmelden</p></div></a>

        <a href="registrieren" class="link">
        <div class="button_registrieren"><p style="margin: 35px auto;">Registrieren</p></div></a>
    </div>    

    <div class="content">
    <form method="post" action="">
        <div class="input_div">
        <input style="width: 487px;" name="email" type="email" placeholder="Email" required>
        <input style="width: 487px;" name="password" type="password" placeholder="Passwort" required>
        </div>
        <button style="width: 500px;">Login</button>
    </form>
    </div>
</div>
</body>
</html>