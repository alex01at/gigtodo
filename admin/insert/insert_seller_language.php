<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
echo "<script>window.open('login','_self');</script>";
}else{
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
                    <h4 class="h4">
                        <div class="float-right">
                            <div class="page-title">
                                <ol class="text-right">
                                    <a href="index?view_seller_languages" class="btn btn-danger">
                                        <i class="text-white"></i> <span class="text-white">Cancel</span>
                                    </a>
                                </ol>
                            </div>
                        </div>
                        Add New Language
                    </h4>
                </div>
                <!--- card-header Ends --->
                <div class="card-body">
                    <!--- card-body Starts --->
                    <form action="" method="post">
                        <!--- form Starts --->
                        <div class="form-group row">
                            <!--- form-group row Starts --->
                            <label class="col-md-3 control-label"> Language Title : </label>
                            <div class="col-md-6">
                                <input type="text" name="language_title" class="form-control" required>
                            </div>
                        </div>
                        <!--- form-group row Ends --->
                        <div class="form-group row">
                            <!--- form-group row Starts --->
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" name="submit" class="btn btn-success form-control"
                                    value="Insert Seller Language">
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
if(isset($_POST['submit'])){
$rules = array("language_title" => "required");
$messages = array("language_title" => "Seller Language Title Is Required.");
$val = new Validator($_POST,$rules,$messages);
if($val->run() == false){
Flash::add("form_errors",$val->get_all_errors());
Flash::add("form_data",$_POST);
echo "<script> window.open('index?insert_seller_language','_self');</script>";
}else{
$data = $input->post();
unset($data['submit']);
$insert_seller_language = $db->insert("seller_languages",$data);
if($insert_seller_language){
$insert_id = $db->lastInsertId();
$insert_log = $db->insert_log($admin_id,"seller_language",$insert_id,"inserted");
echo "<script>alert('One Seller Language Has Been Inserted.');</script>";
echo "<script>window.open('index?view_seller_languages','_self');</script>";
}	
}
}
?>
</div>
<?php } ?>