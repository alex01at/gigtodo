<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
	echo "<script>window.open('login','_self');</script>";
}else{
?>


<div class="main-container"><!--- container Starts --->
<div class="row"><!--- 2 row Starts --->
<div class="col-lg-12"><!--- col-lg-12 Starts --->
<div class="card"><!--- card Starts --->
<div class="card-header"><!--- card-header Starts --->
<ol class="text-right">
					<li class="active">
					   <a href="index?insert_page" class="btn btn-success">
					   	<i class="fa fa-plus-circle text-white"></i> <span class="text-white">Add Page</span>
					   </a>
					</li>
				</ol>
<h4 class="h3">Pages</h4>
</div><!--- card-header Ends --->
<div class="card-body"><!--- card-body Starts --->
<div class="table-responsive">
<table class="table table-bordered"><!--- table table-bordered table-hover Starts --->	
	<thead>
	<tr>
		<th>Title</th>
		<th>Language:</th>
		<th>Date Updated:</th>
		<th>Action:</th>
	</tr>
	</thead>
	<tbody><!--- tbody Starts --->
	<?php
$selPages = $db->query("select * from pages");

if ($selPages->rowCount() > 0) {
    // Datensätze gefunden, Schleife durchlaufen
    while ($page = $selPages->fetch()) {
        $page_meta = $db->select("pages_meta", array("page_id" => $page->id, "language_id" => $adminLanguage))->fetch();
        $language = $db->select("languages", array("id" => $page_meta->language_id));
        $language_title = $language->fetch()->title;
        ?>
        <tr>
            <td><?= $page_meta->title; ?></td>
            <td><?= $language_title; ?></td>
            <td><?= $page->date; ?></td>
            <td>
                
                    <!-- Button, um das Modal anzuzeigen -->
<button class="btn btn-success" data-toggle="modal" data-target="#pageActionsModal">
  Actions
</button>

<!-- Das Modal -->
<div class="modal fade" id="pageActionsModal" tabindex="-1" role="dialog" aria-labelledby="pageActionsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pageActionsModalLabel">Page Actions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-1 text-center">
        <a class="btn btn-success" href="../pages/<?= $page->url; ?>" target="_blank">
          <i class="fa fa-eye"></i> Preview Page
        </a>
        <a class="btn btn-success" href="index?edit_page=<?= $page->id; ?>">
          <i class="fa fa-edit"></i> Edit Page
        </a>
        
      </div>
      <div class="modal-footer"><a class="btn btn-danger del-btn" href="index?delete_page=<?= $page->id; ?>">
          <i class="fa fa-trash"></i> Delete Page
        </a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

                   
                
            </td>
        </tr>
    <?php
    }
} else {
    // Keine Datensätze gefunden
    ?>
    <tr>
        <td colspan="4">No page found <a href="index?insert_page" class="btn btn-success">
					   	<i class="fa fa-plus-circle text-white"></i> <span class="text-white">Add first Page</span>
					   </a> now. </td>
    </tr>
<?php
}
?>
</tbody>

</table>
</div>

</div><!--- card-body Ends --->
</div><!--- card Ends --->
</div><!--- col-lg-12 Ends --->
</div><!--- row Ends --->
</div><!--- container Ends --->
<?php } ?>