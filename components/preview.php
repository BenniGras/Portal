<?php foreach ($items AS $item): ?>

    <?php
    $user = $this->userRepository->find($item->user_id);
    $highlight = $this->highlightRepository->getItemHighlight($item->id);
    ?>

    <?php if($highlight): ?>
    <div class="preview highlight">
    <?php else: ?>
    <div class="preview">
    <?php endif; ?>
        <a href="artikel?id=<?php echo e($item->id); ?>">
            <img class="image" src="../../pictures/<?php echo e($item->picture) ?>">
        </a>
        <div class="text">

        <a href="artikel?id=<?php echo e($item->id); ?>">
            <h1 style="margin: 0;"><?php echo e($item->title); ?></h1>
        </a>
    
        <?php $len = strlen($item->description);?>

        <?php if ($len <= 300): ?>
            <p><?php  echo e($item->description); ?></p>
        <?php elseif ($len <= 400): ?>
            <p style="font-size: 22px"><?php  echo e($item->description); ?></p>
        <?php else: ?>
            <p style="font-size: 20px"><?php  echo e($item->short_description($item->description)); ?>...</p>
        <?php endif; ?>        

        <p class="row">

            <span style="font-size: 30px; font-weight: bold;">
            <?php echo e($item->price); ?>€ 
            <?php if ($item->negotiation === "ja"):?>
                <?php echo "VB"?>
            <?php endif; ?></span>

            <?php if ($item->status === "neu"): ?>
                <span class="neu">neu</span>
            <?php else: ?>
                <span class="gebraucht">gebraucht</span>
            <?php endif; ?>

            <span>
            <?php if($item->companyname):?>
                <?php echo("Händler");?>
            <?php else:?>
                <?php echo("Privat");?>
            <?php endif;?>
            , 
            <?php echo e($item->city); ?></span>  

            <a href="change_wishlist?id=<?php echo e($item->id); ?>">
            <?php if(isset($_SESSION['id'])):?>
                <?php if($this->wishlistRepository->getWishlistItem($item->id, $_SESSION['id'])): ?>
                    <i class="fas fa-heart heart-color"></i>
                <?php else: ?>
                    <i class="far fa-heart"></i>
                <?php endif; ?>
            <?php else: ?>
                <i class="far fa-heart"></i>
            <?php endif; ?>
            </a>
            
        </p>
        
         
        </div>
    </div>

<?php endforeach; ?>