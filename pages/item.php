<!DOCTYPE html>
<html>
<head>
    <title><?php echo e($item->title); ?></title>
    <meta http-equice="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/artikel.css">
</head>
<body class="background-picture">
<?php include "../components/header.php";?>

<div class="formular">
    <div class="content">

    <h2><?php echo e($item->title); ?></h2>
    
    <div class="flex">

        <!--<img class="image" style="flex-shrink: 0;" src="../../pictures/ ?php echo e($item->picture) ?>"> -->

        <!-- Slideshow container -->
        <div class="slideshow-container" style="flex-shrink: 0;">

            <!-- Full-width images with number and caption text -->
            <?php foreach ($pictures AS $picture): ?>
            <div class="mySlides fade">
                <img src="../../pictures/<?php echo($picture->name);?>" style="width:100%;height:100%">
            </div>
            <?php endforeach; ?>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>
        
        <div>
            <div class="seller">
                <?php if($user->companyname): ?>
                    <h3><?php echo e($user->companyname) ?></h3>
                    <p>Händler</p>
                    <p><?php echo e($user->street." ".$user->number) ?></p>
                <?php else: ?>
                    <h3><?php echo e($user->firstname." ".$user->surname) ?></h3>
                    <p>Privat</p>
                <?php endif; ?>             
                    <p><?php echo e($user->zipcode." ".$user->city) ?></p>
            </div>
            <button>Tel.: <?php echo e($user->customer_prefix." ".$user->customer_phone) ?></button>
            <button><?php echo e($user->customer_email) ?></button>
        </div>

    </div>

    <div class="container" style="width: 600px;justify-content: space-around;align-items: baseline;">
        <h3><?php echo e($item->price); ?>€ <?php 
        if ($item->negotiation == "ja") {
            echo "VB";
        } ?></h3>
        <p>Zustand: <?php echo e($item->status); ?></p>
    </div>

    <h3>Beschreibung:</h3>
    <p><?php echo nl2br(e($item->description)); ?></p>

    </div>
</div>

<script type="text/javascript" src="../../JS/item.js"></script>
</body>
</html>