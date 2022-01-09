<!DOCTYPE html>
<html lang="de">
<head>
    <title>Anzeige hervorheben</title>
    <meta http-equice="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/highlight_item.css">
    <script src="https://kit.fontawesome.com/042b7aa4e1.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include "../components/header.php";?>

<a class="preview" href="artikel?id=<?php echo e($item->id); ?>">
    <img class="image" src="../../pictures/<?php echo e($item->picture) ?>" alt="Vorschaubild">

    <div class="text">
        <h3 style="margin: 0;"><?php echo e($item->title); ?></h3> 
        
        <p class="row">

            <span style="font-size: 30px; font-weight: bold;">
            <?php echo e($item->price); ?>€ 
            <?php if ($item->negotiation === "ja"):?>
                <?php echo "VB"?>
            <?php endif; ?></span>
            
            <?php if ($item->status === "neu"): ?>
                <span class="neu"><?php echo "neu"?></span>
            <?php else: ?>
                <span class="gebraucht"><?php echo "gebraucht"?></span>
            <?php endif; ?> 
        </p>
    </div>
</a>

<div class="select-type">
    <div class="type">
    <form method="post">
        <strong style="text-align: left;">Sie haben ausgewählt:</strong>
        <h3><?php echo e($data->s_type); ?></h3>
        <ul>
            <div class="infos">
                <li><?php echo e($data->s_info1); ?></li>
                <li><?php echo e($data->s_info2); ?></li>
            </div>
            <li>
                <label for="duration">Tage: </label>
                <select name="duration" id="select" style="width: 150px">
                    <option value="604800" <?php if($data->s_duration == 7) {echo("selected");} ?>>7 Tage</option>
                    <option value="1209600" <?php if($data->s_duration == 14) {echo("selected");} ?>>14 Tage</option>
                    <option value="1814400" <?php if($data->s_duration == 21) {echo("selected");} ?>>21 Tage</option>
                    <option value="2419200" <?php if($data->s_duration == 28) {echo("selected");} ?>>28 Tage</option>
                </select>
            </li>
            <li>Preis: <strong><?php echo e($data->s_price); ?>€</strong></li>
        </ul>
        
        <input type="checkbox" name="type" value="<?php echo e($data->s_type); ?>" required>Ich stimme irgendwas zu.
        <br />
        <button>Jetzt buchen</button>
    </form>
    </div>

    <?php if($data->p_type != ""): ?>
    <div class="type middle">
        <strong style="text-align: left;">Nächst beste Option:</strong>
        <h3><?php echo e($data->p_type); ?></h3>
        <ul>
            <div class="infos">
                <li><?php echo e($data->p_info1); ?></li>
                <li><?php echo e($data->p_info2); ?></li>
            </div>
            <li>Tage: <?php echo e($data->p_duration); ?> Tage</li>
            <li>Preis: <strong><?php echo e($data->p_price); ?>€</strong></li>
        </ul>
        <br />
        <a class="btn green" href="<?php echo e($data->link.$item->id); ?>">Jetzt auswählen</a>
    </div>
    <?php endif; ?>
</div>


<script type="text/javascript" src="../../JS/cross_selling.js"></script>

</body>
</html>
