<span class="<?= "$priceClass-num"; ?> d-none"><?= $price; ?></span>

<h4 class="text-success mb-3"><?= $lang['proposal']['about']; ?></h4>
<h5><i class="fa fa-clock-o"></i> <?= $delivery_time; ?>&nbsp;<?=$lang["day"];?> <?= $lang["sidebar"]["delivery_time"];?> &nbsp; <i class="fa fa-refresh"></i> </h5>
<h5 class="mt-2 mb-3"><i class="fa fa-refresh"></i> &nbsp; 

<?php
	
      if($row->revisions != "unlimited"){
        echo $row->revisions ?> <?=$lang['order_details']['revisions'];
      }else{
        echo $lang['unlimited'] ?>&nbsp; <?= $lang['order_details']['revisions'];
      }
    ?>

</h5>

<?php if(!isset($_SESSION['seller_user_name'])){ ?>
	
<a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-order primary mb-3">
	<i class="fa fa-shopping-cart"></i> &nbsp; <strong><?= $lang['proposal']['nav']['add_to_cart'];?></strong>
</a>
<a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-order">
	<strong><?= $lang['proposal']['nav']['order_now']?> (<?= showPrice($price,$priceClass); ?>)</strong>
</a>

<?php 
	if($count_extras > 0){ 
		include('extras.php'); 
	} 
?>

<?php }else{ ?>

<?php if($proposal_seller_user_name == @$_SESSION['seller_user_name']){  ?>
<a class="btn btn-order" href="../edit_proposal.php?proposal_id=<?= $proposal_id; ?>">
<i class="fa fa-edit"></i> <?=$lang["titles"]["edit_proposal"];?>
</a>

	<?php if($count_extras > 0){ ?>
		<?php include('extras.php'); ?>
	<?php } ?>

<?php }else{ ?>
<form method="post" action="../../checkout" id="checkoutForm<?= $packagenum; ?>"><!--- form Starts --->
	<input type="hidden" name="proposal_qty" value="1">
	<input type="hidden" name="package_id" value="<?= $package_id; ?>">
	<input type="hidden" name="proposal_id" value="<?= $proposal_id; ?>">
  <?php if($countcart == 1){ ?>
	<button type="button" class="btn btn-order primary added mb-3">
	<i class="fa fa-shopping-cart"></i> &nbsp;<strong>Already Added</strong>
	</button>
  <?php }else{ ?>
	<button type="submit" name="add_cart" class="btn btn-order primary mb-3">
	<i class="fa fa-shopping-cart"></i> &nbsp;<strong><?= $lang['proposal']['nav']['add_to_cart'];?></strong>
	</button>
  <?php } ?>
	<button type="submit" name="add_order" class="btn btn-order">
		<strong><?= $lang['proposal']['nav']['order_now']?> (<?= showPrice($price,$priceClass); ?>)</strong>
	</button>

	<?php if($count_extras > 0){ ?>
		<?php include('extras.php'); ?>
	<?php } ?>
</form><!--- form Ends --->
<?php } ?>
<?php } ?>
<hr>
<div class="form-group row mb-0"><!--- form-group row mb-0 Starts --->
	<label class="col-6 control-label"> <?=$lang['order_details']['quantity'];?>  </label>
	<div class="col-6">
		<select class="form-control" name="proposal_qty" form="checkoutForm">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
		</select>
	</div>
</div><!--- form-group row mb-0 Ends --->
