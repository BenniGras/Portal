<!DOCTYPE html>
<html>
<head>
    <title>Registrieren</title>
    <meta http-equice="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/add_user.css">
</head>
<body class="background-picture">
<?php include "../components/header.php";?>

<div class="formular">
<form action="" method="post" id="form">
    <div class="content">

    <h2 class="header">Konto erstellen</h2>
    <br />

    <?php if(!empty($error)): ?>
        <div >
            <label for="email">Ihre E-Mail-Adresse *</label>
            <div class="form-control error">
                <input type="text" name="email" id="email" placeholder="Ihre E-Mail-Adresse" style="width:585px"> 
                <i class="fa fa-check-circle fa-2x"></i>
                <i class="fa fa-exclamation-circle fa-2x"></i>
                <small><?php echo($error) ?></small>
            </div>
        </div>
    <?php else: ?>
        <div >
            <label for="email">Ihre E-Mail-Adresse *</label>
            <div class="form-control">
                <input type="text" name="email" id="email" placeholder="Ihre E-Mail-Adresse" style="width:585px"> 
                <i class="fa fa-check-circle fa-2x"></i>
                <i class="fa fa-exclamation-circle fa-2x"></i>
                <small>Error message</small>
            </div>
        </div>
    <?php endif; ?> 

    <div>
        <label>Ihr Vor- und Nachname *</label><br />
        <div style="display: flex;justify-content:space-between;width:600px;">
            <div class="form-control" style="width:49%;">
                <input type="text" name="firstname" id="firstname" placeholder="Ihr Vorname" style="width:95%;" >
                <i class="fa fa-check-circle fa-2x"></i>
                <i class="fa fa-exclamation-circle fa-2x"></i>
                <small>Error message</small>
            </div>

            <div class="form-control" style="width:49%;">
                <input type="text" name="surname" id="surname" placeholder="Ihr Nachname" style="width:95%;">
                <i class="fa fa-check-circle fa-2x"></i>
                <i class="fa fa-exclamation-circle fa-2x"></i>
                <small>Error message</small>
            </div>
        </div>
    </div>  

    <div>
        <label>Ihre Postleitzahl / Stadt *</label><br />
        <div style="display: flex;justify-content:space-between;width:600px;">
            <div class="form-control" style="width:29%;">
                <input type="number" name="zipcode" id="zipcode" placeholder="Ihre Postleitzahl" style="width:92%;">
                <i class="fa fa-check-circle fa-2x"></i>
                <i class="fa fa-exclamation-circle fa-2x"></i>
                <small>Error message</small>
            </div>

            <div class="form-control" style="width:69%;">
                <input type="text" name="city" id="city" placeholder="Ihre Stadt" style="width:96%;">
                <i class="fa fa-check-circle fa-2x"></i>
                <i class="fa fa-exclamation-circle fa-2x"></i>
                <small>Error message</small>
            </div>
        </div>
    </div> 

    <div>
        <label for="password_1">Passwort *</label>
        <div class="form-control">
            <input type="password" name="password_1" id="password_1" placeholder="Passwort" style="width:585px">
            <i class="fa fa-check-circle fa-2x"></i>
            <i class="fa fa-exclamation-circle fa-2x"></i>
            <small>Error message</small>
        </div>  
	</div>

    <div>
        <label for="password_2">Passwort wiederholen *</label>
        <div class="form-control">
            <input type="password" name="password_2" id="password_2" placeholder="Passwort" style="width:585px">
            <i class="fa fa-check-circle fa-2x"></i>
            <i class="fa fa-exclamation-circle fa-2x"></i>
            <small>Error message</small>
        </div>
	</div>

    <h3 class="header">Kontakt</h3>
    <br />

    <div>
        <label>Telefonnummer für Kundenanfragen</label><br />
        <div style="display: flex;justify-content:space-between;width:600px;">
            <div class="form-control" style="width:19%;">
                <select class="phone" name="customer_prefix" style="margin-bottom: 0px;">
                    <option>+41</option>
                    <option>+43</option>
                    <option selected>+49</option>
                </select>
            </div>

            <div class="form-control" style="width:79%;">
                <input type="number" name="customer_phone" id="customer_phone" placeholder="Telefonnummer" style="width:97%;">
                <i class="fa fa-check-circle fa-2x"></i>
                <i class="fa fa-exclamation-circle fa-2x"></i>
                <small>Error message</small>
            </div>
        </div>
    </div>

    <div >
        <label for="customer_email">E-Mail-Adresse für Kundenanfragen</label>
        <div class="form-control">
            <input type="text" name="customer_email" id="customer_email" placeholder="E-Mail-Adresse" style="width:585px"> 
            <i class="fa fa-check-circle fa-2x"></i>
            <i class="fa fa-exclamation-circle fa-2x"></i>
            <small>Error message</small>
        </div>
    </div><br />

    <div class="form-control">
        <label class="container">
            Ja, ich stimme den AGBs zu. *
            <input type="checkbox" id="agb">
            <span class="checkmark"></span>
        </label>
        <i class="fa fa-check-circle fa-2x" style="top: 0px;"></i>
        <i class="fa fa-exclamation-circle fa-2x" style="top: 0px;"></i>
        <small>Error message</small>
    </div>

    <div class="form-control">
        <label class="container">
             Ja, ich stimme der Nutzung meiner Daten gemäß der Datenschutzerklärung zu. *
            <input type="checkbox" id="ds">
            <span class="checkmark"></span>
        </label>
        <i class="fa fa-check-circle fa-2x" style="top: 0px;"></i>
        <i class="fa fa-exclamation-circle fa-2x" style="top: 0px;"></i>
        <small>Error message</small>
    </div> 
    
    <button style="width: 600px;">Registrieren</button>

    <p style="font-size: 21px; color: gray;">* Mit Stern gekennzeichnete Felder müssen ausgefüllt werden.</p>

    </div>
</form>

<script type="text/javascript" src="../../JS/add_user.js"></script>

</div>
</body>
</html>