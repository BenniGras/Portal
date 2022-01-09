<!DOCTYPE html>
<html>
<head>
    <title>Meine Anzeigen</title>
    <meta http-equice="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/dashboard.css">
    <link rel="stylesheet" href="../../CSS/preview_small.css">
</head>
<body>

<div style="display: flex;align-items: space-between;">

    <div class="nav">
        <a href="startseite"><img src="../../pictures/logo.png" style="width: 250px;"></a>
            
        <div class="nav_links">
            <a href="merkliste" class="btn">Meine Merkliste</a>
            <a href="meine_daten" class="btn">Meine Daten</a>
            <a href="meine_anzeigen" class="btn green">Meine Anzeigen</a>
            <a href="anzeige_erstellen" class="btn">Anzeige erstellen</a>
            <!--<a href="abonnement" class="btn">Abonnement</a>
            <a href="benachrichtigungen" class="btn">Benachrichtigungen</a>-->
            <a href="abmelden" class="btn">Abmelden</a>
        </div>

    </div>

    <div style="flex-grow: 1"> 
    <?php include "../components/preview_small.php";?>
    </div>

</div>

</body>
</html>