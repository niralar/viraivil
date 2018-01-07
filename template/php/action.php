<?php
require_once('config.php');

$sql      = "SELECT * FROM `" . TABLE . "`";
$select   = mysqli_query($con, $sql);
$rowcount = mysqli_num_rows($select);
if (isset($_POST['button'])) {
    // Delete Selected Rows if Delete Button Active
    if ($_POST['button'] == "Delete") {
        if (isset($_POST['checkbox'])) {
            $checkbox = $_POST['checkbox'];
            for ($i = 0; $i < $rowcount; $i++) {
                $del_id = $checkbox[$i];
                $sql    = "DELETE FROM `" . TABLE . "` WHERE id='$del_id'";
                $result = mysqli_query($con, $sql);
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
        $num_fields = mysqli_num_fields($select);
		
        $headers    = array();
        for ($i = 0; $i < $num_fields; $i++) {
            $headers[] = mysqli_fetch_field_direct($select, $i);
        }
		
        $fp = fopen('php://output', 'w');
        if ($fp && $select) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="Subscriber.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($fp, $headers);
			
            while ($row = mysqli_fetch_row($select)) {
                fputcsv($fp, array_values($row));
            }
            die;
        }
    }
	else if ($_POST['button'] == "Delete All") {
                $sql    = "DELETE FROM `" . TABLE . "`";
                $result = mysqli_query($con, $sql);
            if ($result) {
                header("location:../admin/index.php");
            }
        }
} else {
    header("location:../admin/index.php");
}

?>