<?php
$get_section = $db->select("home_section",array("language_id" => $siteLanguage));
$row_section = $get_section->fetch();
$count_section = $get_section->rowCount();
@$section_heading = $row_section->section_heading;
@$section_short_heading = $row_section->section_short_heading;

$get_slides = $db->query("select * from home_section_slider LIMIT 0,1");
$row_slides = $get_slides->fetch();
$slide_id = $row_slides->slide_id; 
$slide_image = $row_slides->slide_image; 
?>
<!-- start main -->
<section class="pb-5 pt-5">
<div class="container">
          <div class="row flex-center">
            <div class="col-lg-6 col-md-5 order-md-1"><img class="img-fluid" src="images/1.png" alt="" /></div>
            <div class="col-md-7 col-lg-6 mt-5 text-center text-md-start">
              <h1 class="fw-medium" style="font-size:3em; text-shadow: 3px 3px 5px rgba(30, 0, 128, 0.33);"><?= $section_heading; ?></h1>
              <p class="mt-3 mb-4"><?= $section_short_heading; ?> </p><a class="btn btn-lg btn-danger hover-top btn-glow" href="how-it-works-de">Wie funktioniert es? </a>
            </div>
          </div>
        </div>
</section>
<!-- end main -->
<!-- start market -->
<div class="container mb-5 cards" style="max-width: 1360px !important;">
  <div class="row">
    <div class="col-md-12">
   
    <!-- <h1 class="mt-5 mb-1 <?=($lang_dir == "right" ? 'text-right':'')?>"><?= $lang['home']['cards']['title']; ?></h1>
    <p class="subHeading mb-4 <?=($lang_dir == "right" ? 'text-right':'')?>"><?= $lang['home']['cards']['desc']; ?></p> -->
    <div class="owl-carousel home-cards-carousel owl-theme"><!--- owl-carousel home-cards-carousel Starts --->
        <?php

          $get_cards = $db->select("home_cards",array("language_id" => $siteLanguage));
          while($row_cards = $get_cards->fetch()){
          $card_id = $row_cards->card_id;
          $card_title = $row_cards->card_title;
          $card_desc = $row_cards->card_desc;
          $card_image = getImageUrl("home_cards",$row_cards->card_image); 
          $card_link = $row_cards->card_link;
        ?>
        <div class="card-box">
          <div>
            <a href="<?= $card_link; ?>" class="subcategory">
              <h4><small><?= $card_desc; ?></small><?= $card_title; ?></h4>
              <picture>
                <img src="<?= $card_image; ?>">
              </picture>
            </a>
          </div>
        </div>
        <?php } ?>
      </div><!--- owl-carousel home-cards-carousel Ends --->
    </div>
  </div>
</div>
<!-- start market -->
<section class="market">
<div class="container" style="max-width: 1360px !important;">
  <div class="row">
    <div class="col-md-12">
      <!-- <h2><?= $lang['home']['categories']['title']; ?></h2>
      <h4><?= $lang['home']['categories']['desc']; ?></h4> -->
      <div class="row space80">
        <?php
          $get_categories = $db->query("select * from categories where cat_featured='yes' ".($lang_dir == "right" ? 'order by 1 DESC LIMIT 4,4':' LIMIT 0,4')."");
          while($row_categories = $get_categories->fetch()){
          $cat_id = $row_categories->cat_id;
          $cat_image = getImageUrl("categories",$row_categories->cat_image); 
          $cat_url = $row_categories->cat_url;

          $get_meta = $db->select("cats_meta",array("cat_id" => $cat_id, "language_id" => $siteLanguage));
          $row_meta = $get_meta->fetch();
          $cat_title = $row_meta->cat_title;
        ?>
        <div class="col-md-3 col-6">
          <a href="categories/<?= $cat_url; ?>">
            <div class="grn_box">
              <img src="<?= $cat_image; ?>" class="mx-auto d-block" width="96px" height="96px">
              <p><?= $cat_title; ?></p>
            </div>
          </a>
        </div>
        <?php } ?>
      </div>
      <div class="space80 hidden-xs"></div>
      <div class="space20 visible-xs"></div>
      <div class="row space80">
        <?php
          $get_categories = $db->query("select * from categories where cat_featured='yes' ".($lang_dir == "right" ? 'order by 1 DESC LIMIT 0,4':' LIMIT 4,4')."");
          while($row_categories = $get_categories->fetch()){
          $cat_id = $row_categories->cat_id;
          $cat_image = getImageUrl("categories",$row_categories->cat_image);
          $cat_url = $row_categories->cat_url;

          $get_meta = $db->select("cats_meta",array("cat_id" => $cat_id, "language_id" => $siteLanguage));
          $row_meta = $get_meta->fetch();
          $cat_title = $row_meta->cat_title;
        ?>
        <div class="col-md-3 col-6">
          <a href="categories/<?= $cat_url; ?>">
            <div class="grn_box">
              <img src="<?= $cat_image; ?>" class="mx-auto d-block" width="96px" height="96px">
              <p><?= $cat_title; ?></p>
            </div>
          </a>
        </div>
        <?php } ?>
      </div>

    </div>
  </div>
</div>
</section>
<!-- end market -->
<!-- start timer -->
<section class="timer">
<div class="container" style="max-width: 1335px !important;">
  <div class="row">
    <?php
      $get_boxes = $db->query("select * from section_boxes where language_id='$siteLanguage' LIMIT 0,1");
      while($row_boxes = $get_boxes->fetch()){
      $box_id = $row_boxes->box_id;
      $box_title = $row_boxes->box_title;
      $box_desc = $row_boxes->box_desc;
      $box_image = getImageUrl("section_boxes",$row_boxes->box_image);
      ?>
    <div class="col-md-4 pad0">
      <div class="box">
        <h5><?= $box_title; ?></h5>
        <p><?= $box_desc; ?></p>
      </div>
    </div>
    <div class="col-md-4 pad0">
      <div class="blu_box">
        <img src="<?= $box_image; ?>" class="img-fluid mx-auto d-block">
      </div>
    </div>
    <?php } ?>
    <?php
      $get_boxes = $db->query("select * from section_boxes where language_id='$siteLanguage' LIMIT 1,100");
      while($row_boxes = $get_boxes->fetch()){
      $box_id = $row_boxes->box_id;
      $box_title = $row_boxes->box_title;
      $box_desc = $row_boxes->box_desc;
      $box_image = getImageUrl("section_boxes",$row_boxes->box_image);
      ?>
    <div class="col-md-4 pad0">
      <div class="box">
        <h5><?= $box_title; ?></h5>
        <p><?= $box_desc; ?></p>
      </div>
    </div>
    <div class="col-md-4 pad0">
      <div class="blu_box1">
        <img src="<?= $box_image; ?>" class="img-fluid mx-auto d-block">
      </div>
    </div>
    <?php } ?>
  </div>
</div>
</section>
<!-- end timer -->
<!-- start top -->
<section class="top mb-0">
  <div class="container" style="max-width: 1360px !important;">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center"><?= $lang['home']['proposals']['title']; ?></h1>
        <h4 class="text-center"><?= $lang['home']['proposals']['desc']; ?></h4>
        <?php 
          $get_proposals = $db->query("select * from proposals where proposal_featured='yes' AND proposal_status='active'");
          $count_proposals = $get_proposals->rowCount();
          if($count_proposals > 1){
          ?>
        <span class="pull-right text-success"><a href="featured_proposals">View More</a></span>
        <?php } ?>
        <div class="mt-5">
          <!--- home-featured-carousel Starts --->
          <div class="row">
            <!--- row Starts -->
            <?php
              $get_proposals = $db->query("select * from proposals where proposal_featured='yes' AND proposal_status='active' LIMIT 0,10");
              while($row_proposals = $get_proposals->fetch()){
              $proposal_id = $row_proposals->proposal_id;
              $proposal_title = $row_proposals->proposal_title;
              $proposal_price = $row_proposals->proposal_price;
              if($proposal_price == 0){
              $get_p_1 = $db->select("proposal_packages",array("proposal_id" => $proposal_id,"package_name" => "Basic"));
              $proposal_price = $get_p_1->fetch()->price;
              }
              $proposal_img1 = getImageUrl2("proposals","proposal_img1",$row_proposals->proposal_img1);
              $proposal_video = $row_proposals->proposal_video;
              $proposal_seller_id = $row_proposals->proposal_seller_id;
              $proposal_rating = $row_proposals->proposal_rating;
              $proposal_url = $row_proposals->proposal_url;
              $proposal_featured = $row_proposals->proposal_featured;
              $proposal_enable_referrals = $row_proposals->proposal_enable_referrals;
              $proposal_referral_money = $row_proposals->proposal_referral_money;
              if(empty($proposal_video)){
              $video_class = "";
              }else{
              $video_class = "video-img";
              }
              $get_seller = $db->select("sellers",array("seller_id" => $proposal_seller_id));
              $row_seller = $get_seller->fetch();
              $seller_user_name = $row_seller->seller_user_name;
              $seller_image = getImageUrl2("sellers","seller_image",$row_seller->seller_image);
              $seller_level = $row_seller->seller_level;
              $seller_status = $row_seller->seller_status;
              if(empty($seller_image)){
              $seller_image = "empty-image.png";
              }
              // Select Proposal Seller Level
              @$seller_level = $db->select("seller_levels_meta",array("level_id"=>$seller_level,"language_id"=>$siteLanguage))->fetch()->title;
              $proposal_reviews = array();
              $select_buyer_reviews = $db->select("buyer_reviews",array("proposal_id" => $proposal_id));
              $count_reviews = $select_buyer_reviews->rowCount();
              while($row_buyer_reviews = $select_buyer_reviews->fetch()){
                $proposal_buyer_rating = $row_buyer_reviews->buyer_rating;
                array_push($proposal_reviews,$proposal_buyer_rating);
              }
              $total = array_sum($proposal_reviews);
              $total = array_sum($proposal_reviews);
              if (count($proposal_reviews) > 0) {
                  $average_rating = $total / count($proposal_reviews);
              } else {
                  // Handle the case where $proposal_reviews is empty
                  // For example, set $average_rating to 0 or display a message to the user.
              }
              
            ?>
            <div class="col-xl-2dot4 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
              <?php require("includes/proposals.php"); ?>
            </div>
            <?php } ?>
          </div>
          <!--- row Ends -->
        </div><!--- home-featured-carousel Ends --->
      </div>
    </div>
  </div>
</section>

<script>

$(document).ready(function(){

  var slider = $('#demo1').carousel({
    interval: 4000
  });

  var active = $(".carousel-item.active").find("video");
  var active_length = active.length;

  if(active_length == 1){
    slider.carousel('pause');
    console.log('paused');
    $(".carousel-indicators").css({"bottom": "90px"});
  }

  $("#demo1").on('slide.bs.carousel', function(event){
    var eq = event.to;
    // console.log(event.from);
    // console.log(event.to);
    var video = $(event.relatedTarget).find("video");
    if(video.length == 1){
        slider.carousel('pause');
        console.log('paused');
        $(".carousel-indicators").css({"bottom": "90px"});
        video.trigger('play');
    }else{
      $(".carousel-indicators").css({"bottom": "20px"});
    }
  });

  $('video').on('ended',function(){
    slider.carousel({'pause': false});
    console.log('started');
  });

});

</script>