<?php 
@session_start();
if(!isset($_SESSION['admin_email'])){
echo "<script>window.open('login.php','_self');</script>";
}else{
if(isset($_GET['edit_word'])){
$edit_id = $input->get('edit_word');
$edit_cat = $db->select("spam_words",array('id'=>$edit_id));
$row_edit = $edit_cat->fetch();
$name = $row_edit->word;
}
?>
<div class="main-container">
    <div class="row">
        <!--- 2 row Starts --->
        <div class="col-lg-12">
            <!--- col-lg-12 Starts --->
            <div class="card">
                <!--- card Starts --->
                <div class="card-header">
                    <!--- card-header Starts --->
                    <div class="card-header">
                        <div class="float-right">
                            <div class="page-title">
                                <ol class="text-right">
                                    <a href="index?view_words" class="btn btn-danger">
                                        <i class="text-white"></i> <span class="text-white">Cancel</span>
                                    </a>
                                </ol>
                            </div>
                        </div>
                        <h4 class="h4">
                            <i class="fa fa-money-bill-alt"></i> Edit Word
                        </h4>
                    </div>
                    <!--- card-header Ends --->
                    <div class="card-body">
                        <!--- card-body Starts --->
                        <form action="" method="post" enctype="multipart/form-data">
                            <!--- form Starts --->
                            <div class="form-group row">
                                <!--- form-group row Starts --->
                                <label class="col-md-3 control-label"> Word Name : </label>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" value="<?= $name; ?>" required>
                                </div>
                            </div>
                            <!--- form-group row Ends --->
                            <div class="form-group row">
                                <!--- form-group row Starts --->
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <input type="submit" name="update" value="Update Word"
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
    </div>
    <?php
if(isset($_POST['update'])){
$name = $input->post('name');
$update_word = $db->update("spam_words",array("word"=>$name),array("id"=>$edit_id));
if($update_word){
echo "<script>alert_success('One Word Has Been Updated.','index?view_words');</script>";
}
}
?>
    <?php } ?>