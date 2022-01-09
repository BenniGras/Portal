<!DOCTYPE html>
<html lang="de">
<head>
    <title>Anzeige erstellen</title>
    <meta http-equice="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/add_user.css">
</head>
<body class="background-picture">
<?php include "../components/header.php";?>

<div class="formular">
<form method="post" action="" id="form" enctype="multipart/form-data">
    <div class="content">

    <h2 class="header">Anzeige erstellen</h2>
    <br />

    <div >
        <label for="title">Überschrift *</label>
        <div class="form-control">
            <input type="text" name="title" id="title" placeholder="Überschrift" class="xl"> 
            <i class="fa fa-check-circle fa-2x"></i>
            <i class="fa fa-exclamation-circle fa-2x"></i>
            <small>Error message</small>
        </div>
	</div>

    <div >
        <label for="description">Beschreibung *</label>
        <div class="form-control">
            <textarea name="description" id="description" style="width: 588px; height: 150px;" placeholder="Beschreibung"></textarea>
            <i class="fa fa-check-circle fa-2x"></i>
            <i class="fa fa-exclamation-circle fa-2x"></i>
            <small>Error message</small>
            <small id="characters">Noch <em>100</em> Zeichen</small>
        </div>
	</div>

    <div >
        <label for="price">Preis *</label>
        <div class="form-control">
            <input type="text" id="price" name="price" placeholder="100" style="width: 137px;">
            <span style="font-size:26px;">,00 EUR</span>
            <i class="fa fa-check-circle fa-2x"></i>
            <i class="fa fa-exclamation-circle fa-2x"></i>
            <small>Error message</small>
            <label class="container" style="width:200px;display:inline;margin-left:50px;">Verhandlungsbasis
            <input type="checkbox"  name="negotiation" value="ja">
            <span class="checkmark"></span>
            </label>
        </div>
	</div>

    <label>Zustand *<br />
        <div class="form-control">
        <label class="container" style="display:inline;margin:0 0 30px 0">gebraucht
            <input type="radio" name="status" value="gebraucht">
            <span class="radiobtn"></span>
        </label>

        <label class="container" style="display:inline;margin:0 0 30px 50px">neu
            <input type="radio" name="status" value="neu">
            <span class="radiobtn"></span>
        </label>

        <i class="fa fa-check-circle fa-lg"></i>
        <i class="fa fa-exclamation-circle fa-lg"></i>
        <small>Error message</small>
        </div>
    </label><br />


    <label>Bilder *
        <input type="file" name="pictures[]" style="width: 586px; height: 40px; border: 2px dashed black; border-radius: 10px;" multiple>
    </label>

    <button style="width: 600px;">Anzeige veröffentlichen</button>

    <p style="font-size: 21px; color: gray;">* Mit Stern gekennzeichnete Felder müssen ausgefüllt werden.</p>

    </div>
</form>

<script type="text/javascript" src="../../JS/add_item.js"></script>

</div>
</body>
</html>
