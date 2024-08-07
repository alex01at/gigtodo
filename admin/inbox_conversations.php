<?php
@session_start();
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login','_self');</script>";
} else {
    if (isset($_POST['delete_message'])) {
        $delete_message_id = $_POST['message_id'];

        // Löschen der Nachricht aus der inbox_messages Tabelle
        $delete_message = $db->delete("inbox_messages", array("message_id" => $delete_message_id));

        // Löschen der zugehörigen Einträge aus der inbox_sellers Tabelle
        $delete_inbox_sellers = $db->delete("inbox_sellers", array("message_id" => $delete_message_id));

        if ($delete_message && $delete_inbox_sellers) {
            echo "<script>alert('Die Nachricht und die zugehörigen Einträge wurden erfolgreich gelöscht.');</script>";
            echo "<script>window.open('index?inbox_conversations=" . $_GET['inbox_conversations'] . "','_self');</script>";
        } else {
            echo "<script>alert('Fehler beim Löschen der Nachricht oder der zugehörigen Einträge.');</script>";
        }
    }
?>
<div class="main-container">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Messages</h4>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered links-table">
                    <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>Message Content</th>
                            <th>Attachment</th>
                            <th>Updated</th>
                            <th>Action</th> <!-- Neue Spalte für Aktion -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $per_page = 15;
                        if (isset($_GET["inbox_conversations"])) {
                            $page = $input->get("inbox_conversations");
                            if ($page == 0) { $page = 1; }
                        } else {
                            $page = 1;
                        }
                        // Page starts from 0 and multiply per page
                        if ($page < 1) {
                            $page = 1;
                        }
                        $start_from = ($page-1) * $per_page;
                        $get_inbox_sellers = $db->query("select * from inbox_sellers where not message_status='empty' order by 1 DESC LIMIT :limit OFFSET :offset", "", array("limit" => $per_page, "offset" => $start_from));
                        while ($row_inbox_sellers = $get_inbox_sellers->fetch()) {
                            $sender_id = $row_inbox_sellers->sender_id;
                            $receiver_id = $row_inbox_sellers->receiver_id;
                            $message_id = $row_inbox_sellers->message_id;
                            $message_group_id = $row_inbox_sellers->message_group_id;
                            $select_inbox_message = $db->select("inbox_messages", array("message_id" => $message_id));
                            $row_inbox_message = $select_inbox_message->fetch();
                            $message_file = $row_inbox_message->message_file;
                            $message_desc = substr(strip_tags($row_inbox_message->message_desc), 0, 170);
                            $message_date = $row_inbox_message->message_date;
                            $select_sender = $db->select("sellers", array("seller_id" => $sender_id));
                            $row_sender = $select_sender->fetch();
                            $seller_user_name = $row_sender->seller_user_name;
                            $select_receiver = $db->select("sellers", array("seller_id" => $receiver_id));
                            $row_receiver = $select_receiver->fetch();
                            $receiver_user_name = $row_receiver->seller_user_name;
                        ?>
                        <tr>
                            <td><?= $seller_user_name; ?></td>
                            <td><?= $receiver_user_name; ?></td>
                            <td width="300">
                                <?php
                                if (strlen($message_desc) > 120) {
                                    echo $message_desc . " ...";
                                } else {
                                    echo $message_desc;
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (empty($message_file)) {
                                    echo "No File Attachment";
                                } else {
                                ?>
                                <a href="#" class="text-primary">
                                    <i class="fa fa-download"></i> <?= $message_file; ?>
                                </a>
                                <?php } ?>
                            </td>
                            <td><?= $message_date; ?></td>
                            <td>
                                <form method="post" onsubmit="return confirm('Bist du sicher, dass du diese Nachricht löschen möchtest?');">
                                    <input type="hidden" name="message_id" value="<?= $message_id; ?>">
                                    <button type="submit" name="delete_message" class="btn btn-danger btn-sm">
                                        Löschen
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <ul class="pagination">
                        <?php
                        $query = $db->query("select * from inbox_sellers where not message_status='empty' order by 1 DESC");
                        $total_records = $query->rowCount();
                        $total_pages = ceil($total_records / $per_page);
                        echo "<li class='page-item'><a href='index?inbox_conversations=1' class='page-link'>First Page</a></li>";
                        echo "<li class='page-item " . (1 == $page ? "active" : "") . "'><a class='page-link' href='index?inbox_conversations=1'>1</a></li>";
                        $i = max(2, $page - 5);
                        if ($i > 2) {
                            echo "<li class='page-item' href='#'><a class='page-link'>...</a></li>";
                        }
                        for (; $i < min($page + 6, $total_pages); $i++) {
                            echo "<li class='page-item";
                            if ($i == $page) {
                                echo " active ";
                            }
                            echo "'><a href='index?inbox_conversations=" . $i . "' class='page-link'>" . $i . "</a></li>";
                        }
                        if ($i != $total_pages && $total_pages > 1) {
                            echo "<li class='page-item' href='#'><a class='page-link'>...</a></li>";
                        }
                        if ($total_pages > 1) {
                            echo "<li class='page-item " . ($total_pages == $page ? "active" : "") . "'><a class='page-link' href='index?inbox_conversations=$total_pages'>$total_pages</a></li>";
                        }
                        echo "<li class='page-item'><a href='index?inbox_conversations=$total_pages' class='page-link'>Last Page </a></li>";
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<div class="clearfix"></div>
