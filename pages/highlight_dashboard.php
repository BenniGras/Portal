<!DOCTYPE html>
<html lang="de">
<head>
    <title>Highlightübersicht</title>
    <meta http-equice="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/highlight_item.css">
    <script src="https://kit.fontawesome.com/042b7aa4e1.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include "../components/header.php";?>

<div class="frame">
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
    <p>Anzeigentyp: <?php echo e($highlight->type) ?><p>

    <p>Startzeit: <?php echo e(date("d.m.Y H:i", $highlight->starttime)) ?><p>

    <p>Endzeit: <?php echo e(date("d.m.Y H:i", $highlight->endtime($highlight->starttime, $highlight->duration))) ?><p>

    <p>Dauer: <?php echo e(($highlight->duration/86400)) ?> Tage<p>
</div>



</body>
</html>
