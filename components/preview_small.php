<?php foreach ($items AS $item): ?>

<?php
$user_id = $item->user_id;
$user = $this->userRepository->find($user_id);
?>

<div class="container">

<a class="preview" href="artikel?id=<?php echo e($item->id); ?>">
    <img class="image" src="../../pictures/<?php echo e($item->picture) ?>">

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

    
<div class="edit">
    <?php if($this->highlightRepository->getItemHighlight($item->id)): ?>
        <a class="btn_preview blue" href="highlight_dashboard?id=<?php echo e($item->id); ?>">Anzeigendashboard</a>
    <?php else: ?>
        <a class="btn_preview green" href="anzeige_hervorheben?id=<?php echo e($item->id); ?>">Anzeige hervorheben</a>
    <?php endif; ?>
    <a class="btn_preview" href="anzeige_bearbeiten?id=<?php echo e($item->id); ?>">Anzeige bearbeiten</a>
    <a class="btn_preview" href="">Anzeige löschen</a>
</div>

</div>
    


<?php endforeach; ?>