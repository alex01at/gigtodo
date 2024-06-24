<?php

@session_start();

if(!isset($_SESSION['admin_email'])){     
      echo "<script>window.open('../../login','_self');</script>";     
}else{

if(isset($_GET['delete_suggestion'])){
      
    $delete_id = $input->get('delete_suggestion');
    $delete_post = $db->delete("suggest_category",array('id' => $delete_id));
    
    if($delete_post){

        $insert_log = $db->insert_log($admin_id,"suggest_category",$delete_id,"deleted");

        echo "<script>

            swal({
            type: 'success',
            text: 'One suggestion Has Been Deleted Successfully!',
            timer: 1000,
            onOpen: function(){
            swal.showLoading()
            }
            }).then(function(){
                window.open('index?suggest_cat','_self');
            });

        </script>";
    }

}

?>

<?php } ?>