<?php
session_start(); // Starte die Sitzung, falls noch nicht geschehen
   if(isset($_SESSION['cat_id'])){
          $cat_id = $_SESSION['cat_id'];
          $get_meta = $db->select("cats_meta",array("cat_id" => $cat_id,"language_id" => $siteLanguage));
          $row_meta = $get_meta->fetch();
          $cat_title = $row_meta->cat_title;
          $cat_desc = $row_meta->cat_desc;
          ?>
          <h1 class="mb-3"><?= $cat_title; ?></h1>
          <h4 class="mb-3"><?= $cat_desc; ?></h4>
          <?php if(!isset($_SESSION['seller_user_name'])){?>
          
          <a href="#" data-toggle="modal" data-target="#register-modal" class="btn btn-outline-light btn-lg"><?= $lang['become_seller']; ?></a>
          <a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-outline-light btn-lg"><?= $lang['sign_in']; ?></a> <?php } ?>
        </div>
        <?php  } ?>
        <?php
          if(isset($_SESSION['cat_child_id'])){
          $cat_child_id = $_SESSION['cat_child_id'];
          $get_meta = $db->select("child_cats_meta",array("child_id" => $cat_child_id,"language_id" => $siteLanguage));
          $row_meta = $get_meta->fetch();
          $child_title = $row_meta->child_title;
          $child_desc = $row_meta->child_desc;
          ?>
          <h1 class="mb-3"><?= $child_title; ?></h1>
          <h4 class="mb-3"><?= $child_desc; ?></h4>
      </div>
    <?php } ?>
<div class='col-md-12'>
    <h1 class='text-center mt-4'><i class='fa fa-meh-o'></i> <?=$lang['category']['no_results'];?> </h1><br>

</div>
