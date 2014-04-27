<?php
require_once('config.php');

$sql      = "SELECT * FROM `" . TABLE . "`";
$select   = mysql_query($sql);
$rowcount = mysql_num_rows($select);
if (isset($_POST['button'])) {
    // Delete Selected Rows if Delete Button Active
    if ($_POST['button'] == "Delete") {
        if (isset($_POST['checkbox'])) {
            $checkbox = $_POST['checkbox'];
            for ($i = 0; $i < $rowcount; $i++) {
                $del_id = $checkbox[$i];
                $sql    = "DELETE FROM `" . TABLE . "` WHERE id='$del_id'";
                $result = mysql_query($sql);
            }
            if ($result) {
                header("location:../admin/index.php");
            }
        }
    }
    //Export All Subscriber Details in CSV Format
    else if ($_POST['button'] == "Export All") {
        if (!$select)
            die('Couldn\'t fetch records');
        $num_fields = mysql_num_fields($select);
        $headers    = array();
        for ($i = 0; $i < $num_fields; $i++) {
            $headers[] = mysql_field_name($select, $i);
        }
        $fp = fopen('php://output', 'w');
        if ($fp && $select) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="Subscriber.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($fp, $headers);
            while ($row = mysql_fetch_row($select)) {
                fputcsv($fp, array_values($row));
            }
            die;
        }
    }
	else if ($_POST['button'] == "Delete All") {
                $sql    = "DELETE FROM `" . TABLE . "`";
                $result = mysql_query($sql);
            if ($result) {
                header("location:../admin/index.php");
            }
        }
} else {
    header("location:../admin/index.php");
}

?>