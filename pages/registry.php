<!DOCTYPE html>
<html>
<head>
    <title>Registrieren</title>
    <meta http-equice="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/registry.css">
</head>
<body class="background-picture">
<?php include "../components/header.php";?>

<div class="form">
    <div class="links">
        <a href="anmelden" class="link">
        <div class="button_anmelden"><p style="margin: 35px auto;">Anmelden</p></div></a>

        <a href="registrieren" class="link">
        <div class="button_registrieren"><p style="margin: 35px auto;">Registrieren</p></div></a>
    </div>

    <div class="content">

    <button onclick="window.location.href='registrieren_privat'" class="link_button">Als Privatperson registrieren</button>
    <button onclick="window.location.href='registrieren_handel'" class="link_button">Als Händler registrieren</button>

    </div>
</div>

</body>
</html>
