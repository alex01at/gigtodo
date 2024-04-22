<?php

    $get_cats = $db->select("categories");
    $row_cats = $get_cats->fetch();
    $cat_id = $row_cats->cat_id;
    
      ?>

<div class='col-md-12'>
    <h1 class='text-center mt-4'><i class='fa fa-meh-o'></i> <?=$lang['category']['no_results'];?> </h1><br>
    <?= $cat_id; ?>
</div>