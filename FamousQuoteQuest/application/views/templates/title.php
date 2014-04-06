<div class="container-title">
    <p class="x-large green"><?php echo $title; ?></p>
    <p class="title-links">
        <a href="<?php echo $baseDirectory; ?>quiz">Quiz</a>
        /
        <a href="<?php echo $baseDirectory; ?>cms">CMS</a>
    </p>
    <div class="fatal_error">
        <?php 
            if (isset($fatalError) && $fatalError) {
                echo '<p>Fatal Error!</p>';
                echo '<p>'.$fatalError.'</p>';
            }
        ?>
    </div>
</div>