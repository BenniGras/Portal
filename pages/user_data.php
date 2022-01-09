<!DOCTYPE html>
<html>
<head>
    <title>Meine Daten</title>
    <meta http-equice="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/dashboard.css">
</head>
<body>

<div style="display: flex;align-items: space-between;">

    <div class="nav">
        <a href="startseite"><img src="../../pictures/logo.png" style="width: 250px;"></a>
            
        <div class="nav_links">
            <a href="merkliste" class="btn">Meine Merkliste</a>
            <a href="meine_daten" class="btn green">Meine Daten</a>
            <a href="meine_anzeigen" class="btn">Meine Anzeigen</a>
            <a href="anzeige_erstellen" class="btn">Anzeige erstellen</a>
            <a href="abmelden" class="btn">Abmelden</a>
        </div>

    </div>

    <div style="flex-grow: 1"> 
        <div class="content">

        <h2 style="margin-top: 100px">Persönliche Daten</h2>
        <p><span class="label">Email</span>
        <?php echo e($user->email) ?>
        </p>

        <p><span class="label">Name</span>
        <?php 
        if($user->companyname){
            echo e($user->companyname);
        } else{
            echo e($user->firstname." ".$user->surname); 
        }?> 
        </p>
        
        <p><span class="label">Straße/Nr</span>
        <?php echo e($user->street." ".$user->number);?>
        </p>

        <p><span class="label">Ort</span>
        <?php echo e($user->zipcode." ".$user->city); ?> 
        </p>

        <h2>Kontaktdaten</h2>
        <p><span class="label">Email</span>
        <?php echo e($user->customer_email) ?>
        </p>

        <p><span class="label">Telefon</span>
        <?php 
        if($user->customer_phone){
        echo e($user->customer_prefix." ".$user->customer_phone);} ?> 
        </p>

        <a class="btn green" href="daten_ändern">Daten aktuallisieren</a>
        <a class="btn green" href="passwort_ändern">Passwort ändern</a>
        
        </div>
    </div>

</div>

</body>
</html>