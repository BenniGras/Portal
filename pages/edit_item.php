<!DOCTYPE html>
<html lang="de">
<head>
    <title>Anzeige bearbeiten</title>
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

    <div class="formular">
    <form method="post" action="">
        <div class="content">

        <h2 class="header">Anzeige bearbeiten</h2>
        <br />

        <label>Überschrift *<br />
            <input type="text" name="title" class="xl" value="<?php echo e($item->title) ?>" required>
        </label><br />

        <label>Beschreibung *<br />
        <textarea name="description" style="width: 588px; height: 150px;" required><?php echo e($item->description) ?>
        </textarea>
        </label><br />

        <label>Preis *<br />
            <input type="text" name="price" style="width: 137px;" value="<?php echo e($item->price) ?>" required>,00 EUR
            <?php if($item->negotiation == "ja"): ?>
                <label class="container" style="width:200px;display:inline;margin-left:50px;">Verhandlungsbasis
                    <input type="checkbox"  name="negotiation" value="ja" checked="checked">
                    <span class="checkmark"></span>
                </label>
            <?php else: ?>
                <label class="container" style="width:200px;display:inline;margin-left:50px;">Verhandlungsbasis
                    <input type="checkbox"  name="negotiation" value="ja">
                    <span class="checkmark"></span>
                </label>
            <?php endif; ?>

        </label><br />

        <?php if($item->status == "neu"): ?>
            <label>Zustand *<br />
                <label class="container" style="display:inline;margin:0 0 30px 0">gebraucht
                    <input type="radio" name="status" value="gebraucht" required>
                    <span class="radiobtn"></span>
                </label>

                <label class="container" style="display:inline;margin:0 0 30px 50px">neu
                    <input type="radio" name="status" value="neu" required checked="checked">
                    <span class="radiobtn"></span>
                </label><br />
            </label><br />
        <?php elseif($item->status == "gebraucht"): ?>
            <label>Zustand *<br />
                <label class="container" style="display:inline;margin:0 0 30px 0">gebraucht
                    <input type="radio" name="status" value="gebraucht" required checked="checked">
                    <span class="radiobtn"></span>
                </label>

                <label class="container" style="display:inline;margin:0 0 30px 50px">neu
                    <input type="radio" name="status" value="neu" required>
                    <span class="radiobtn"></span>
                </label><br />
            </label><br />
        <?php endif; ?>

        <label>Bilder *<br />
            <input type="file" name="pictures" style="width: 586px; height: 150px; border: 2px dashed black; border-radius: 10px;">
        </label>

        <button class="green">Anzeige aktualisieren</button>

        <a class="btn green" href="meine_anzeigen">Abbrechen</a>

        <p style="font-size: 21px; color: gray;">* Mit Stern gekennzeichnete Felder müssen ausgefüllt werden.</p>

        </div>
    </form>
    </div>

</div>

</body>
</html>
