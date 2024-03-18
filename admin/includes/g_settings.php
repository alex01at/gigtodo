<?php 
include('general_settings.php');
?>
<div class="main-container">
<div class="pd-20 card-box mb-30">
   
    <form method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label"> Enable Site (WWW) :</label>
            <div class="col-sm-12 col-md-5">
                <select class="custom-select col-12" name="site_www">
                    <option selected="">Choose...</option>
                    <option value="1" <?php if($site_www == 1){ echo "selected"; } ?>> Yes </option>
                    <option value="0" <?php if($site_www == 0){ echo "selected"; } ?>> No </option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Site URL:</label>
            <div class="col-sm-12 col-md-5">
                <input type="text" name="site_url" class="form-control" value="<?= $site_url; ?>" required=""
                    type="url">
                <small class="form-text text-muted">
                    <span>NB:Enter the complete url. Ex: https://www.GigToDo.net</span>
                </small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Site Email:</label>
            <div class="col-sm-12 col-md-5">
                <input class="form-control" value="<?= $site_email_address; ?>" name="site_email_address" type="email">
            </div>
        </div>
      
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Site Timezone:</label>
            <div class="col-sm-12 col-md-5">
                <select name="site_timezone" class="custom-select col-12">
                    <?php foreach ($timezones as $key => $zone) { ?>
                    <option <?=($site_timezone == $zone)?"selected=''":""; ?> value="<?= $zone; ?>"><?= $zone; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Enable Maintenance Mode: </label>
            <div class="col-sm-12 col-md-5">
                <select name="enable_maintenance_mode" class="form-control" required="">
                    <?php if($enable_maintenance_mode == "yes"){ ?>
                    <option value="yes"> Yes </option>
                    <option value="no"> No </option>
                    <?php }elseif($enable_maintenance_mode == "no"){ ?>
                    <option value="no"> No </option>
                    <option value="yes"> Yes </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row" required=""><!--- form-group row Starts --->
  <label class="col-md-3 control-label"> Currency Symbol Position : </label>
  <div class="col-md-6">
    <select name="currency_position" class="form-control">
      <?php if($currency_position == "left"){ ?>
        <option value="left"> Left </option>
        <option value="right"> Right </option>
      <?php }elseif($currency_position == "right"){ ?>
        <option value="right"> Right </option>
        <option value="left"> Left </option>
      <?php } ?>
    </select>
  </div>
</div><!--- form-group row Ends --->
        <div>
            <input type="submit" name="general_settings_update" class="form-control btn btn-success"
                value="Update General Settings">
        </div>
    </form>
</div>
</div>
<?php if(isset($_POST['general_settings_update'])){
	$site_www = $input->post('site_www');
  	$site_url = $input->post('site_url');
	$site_email_address = $input->post('site_email_address');
	
    $site_timezone = $input->post('site_timezone');
    $enable_maintenance_mode = $input->post('enable_maintenance_mode');
    $update_general_settings = $db->update("general_settings",array(
        "site_www" => $site_www,
        "site_url" => $site_url,
        "site_email_address" => $site_email_address,
        "language_switcher" => $language_switcher,
        "site_timezone"=>$site_timezone,
        "enable_maintenance_mode"=>$enable_maintenance_mode
      ));
          if($update_general_settings){
              $insert_log = $db->insert_log($admin_id,"general_settings","","updated");
              if(updateHtaccess($site_www)){
                  echo "<script>alert_success('General Settings has been updated successfully.','index?general_settings');</script>";
            }
      }
      }
   