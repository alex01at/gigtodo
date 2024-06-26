<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
echo "<script>window.open('login','_self');</script>";
}else{
if(isset($_GET['edit_delivery_time'])){
$edit_id = $input->get('edit_delivery_time');
$edit_delivery_time =  $db->select("delivery_times",array('delivery_id' => $edit_id));
if($edit_delivery_time->rowCount() == 0){
  echo "<script>window.open('index?dashboard','_self');</script>";
}
$row_edit = $edit_delivery_time->fetch();
$delivery_id = $row_edit->delivery_id;
$delivery_title = $row_edit->delivery_title;
$delivery_proposal_title = $row_edit->delivery_proposal_title;
}
?>
<div class="main-container">
    <div class="row">
        <!--- 2 row Starts --->
        <div class="col-lg-12">
            <!--- col-lg-12 Starts --->
            <?php 
        $form_errors = Flash::render("form_errors");
        $form_data = Flash::render("form_data");
        if(is_array($form_errors)){
        ?>
            <div class="alert alert-danger">
                <!--- alert alert-danger Starts --->
                <ul class="list-unstyled mb-0">
                    <?php $i = 0; foreach ($form_errors as $error) { $i++; ?>
                    <li class="list-unstyled-item"><?= $i ?>. <?= ucfirst($error); ?></li>
                    <?php } ?>
                </ul>
            </div>
            <!--- alert alert-danger Ends --->
            <?php } ?>
            <div class="card">
                <!--- card Starts --->
                <div class="card-header">
                    <!--- card-header Starts --->
                    <div class="float-right">
                        <div class="page-title">
                            <ol class="text-right">
                                <a href="index?view_delivery_times" class="btn btn-danger">
                                    <i class="text-white"></i> <span class="text-white">Cancel</span>
                                </a>
                            </ol>
                        </div>
                    </div>
                    <h4 class="h4">
                        <i class="fa fa-money-bill-alt"></i> Edit Delivery Time
                    </h4>
                </div>
                <!--- card-header Ends --->
                <div class="card-body">
                    <!--- card-body Starts --->
                    <form action="" method="post">
                        <!--- form Starts --->
                        <div class="form-group row">
                            <!--- form-group row Starts --->
                            <label class="col-md-3 control-label"> Delivery Time Title : </label>
                            <div class="col-md-6">
                                <input type="text" name="delivery_title" class="form-control"
                                    value="<?= $delivery_title; ?>" required>
                                <small class="form-text text-muted">
                                    This delivery title will show on categories, sub categories and search related
                                    pages.
                                </small>
                            </div>
                        </div>
                        <!--- form-group row Ends --->
                        <div class="form-group row">
                            <!--- form-group row Starts --->
                            <label class="col-md-3 control-label"> Proposal Delivery Time Title : </label>
                            <div class="col-md-6">
                                <input type="text" name="delivery_proposal_title" class="form-control"
                                    value="<?= $delivery_proposal_title; ?>" required>
                                <small class="form-text text-muted">
                                    This delivery title will show on proposal related pages.
                                </small>
                            </div>
                        </div>
                        <!--- form-group row Ends --->
                        <div class="form-group row">
                            <!--- form-group row Starts --->
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" name="update_delivery_time" value="Update Delivery Time"
                                    class="btn btn-success form-control">
                            </div>
                        </div>
                        <!--- form-group row Ends --->
                    </form>
                    <!--- form Ends --->
                </div>
                <!--- card-body Ends --->
            </div>
            <!--- card Ends --->
        </div>
        <!--- col-lg-12 Ends --->
    </div>
    <!--- 2 row Ends --->
    <?php
        if(isset($_POST['update_delivery_time'])){
        $rules = array(
        "delivery_title" => "required",
        "delivery_proposal_title" => "required");
        $messages = array("delivery_title" => "Delivery Time Title Is Required.","delivery_proposal_title" => "Proposal Delivery Time Title Is Required.");
        $val = new Validator($_POST,$rules,$messages);
        if($val->run() == false){
        Flash::add("form_errors",$val->get_all_errors());
        Flash::add("form_data",$_POST);
        echo "<script> window.open(window.location.href,'_self');</script>";
        }else{
        $delivery_title = $input->post('delivery_title');
        $delivery_proposal_title = $input->post('delivery_proposal_title');
        $update_delivery_time = $db->update("delivery_times",array("delivery_title" => $delivery_title,"delivery_proposal_title" => $delivery_proposal_title),array("delivery_id" => $delivery_id));
        if($update_delivery_time){
        $insert_log = $db->insert_log($admin_id,"delivery_time",$edit_id,"updated");
        echo "<script>alert('One Delivery Time Has Been Updated.');</script>";
        echo "<script>window.open('index?view_delivery_times','_self');</script>";
        }
        }
        }
    ?>
</div>
<?php } ?>