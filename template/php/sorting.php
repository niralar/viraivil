<?php
include 'pagination.php';
$Pagination = new Pagination();
//Column Sorting Arrows
function columnSortArrows($field, $text, $currentfield = null, $currentsort = null)
{
    $sortquery  = "sort=ASC";
    $orderquery = "orderby=" . $field;
    if ($currentsort == "ASC") {
        $sortquery = "sort=DESC";
        if ($field == "id")
            $sortarrow = '<i class="icon-sort-by-order"></i>';
        else if ($field == "email_address")
            $sortarrow = '<i class="icon-sort-by-alphabet"></i>';
        else
            $sortarrow = '<i class="icon-sort-by-attributes"></i>';
    }
    if ($currentsort == "DESC") {
        $sortquery = "sort=ASC";
        if ($field == "id")
            $sortarrow = '<i class="icon-sort-by-order-alt"></i>';
        else if ($field == "email_address")
            $sortarrow = '<i class="icon-sort-by-alphabet-alt"></i>';
        else
            $sortarrow = '<i class="icon-sort-by-attributes-alt"></i>';
    }
    if ($currentfield == $field) {
        $orderquery = "orderby=" . $field;
    } else {
        $sortarrow = null;
    }
    return '<a href="?' . $orderquery . '&' . $sortquery . '">' . $text . '</a> ' . $sortarrow;
}
//---------------------------------------------------------------------------
//Counting Total Number of Rows
$totalrows = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM `" . TABLE . "`"));
//Setting Item Limit Per Page
$limit     = RECORDPERPAGE;
if (isset($_GET['page']) && is_numeric(trim($_GET['page']))) {
    $page = mysql_real_escape_string($_GET['page']);
} else {
    $page = 1;
}
$startrow = $Pagination->getStartRow($page, $limit);
//Create Page Links
if (SHOWPAGENUMBERS == true) {
    $pagination_links = $Pagination->showPageNumbers($totalrows['total'], $page, $limit);
} else {
    $pagination_links = null;
}
if (SHOWPREVNEXT == true) {
    $prev_link = $Pagination->showPrev($totalrows['total'], $page, $limit);
    $next_link = $Pagination->showNext($totalrows['total'], $page, $limit);
} else {
    $prev_link = null;
    $next_link = null;
}
//If OrderBy Not Set Or Invalid, Set Default
if($totalrows['total']>0)
{
if (!isset($_GET['orderby']) OR trim($_GET['orderby']) == "") {
    $sql = "SELECT * FROM `" . TABLE . "` LIMIT 1";
    $result = mysql_query($sql) or die(mysql_error());
    $array = mysql_fetch_assoc($result);
    $i     = 0;
    foreach ($array as $key => $value) {
        if ($i > 0) {
            break;
        } else {
            $orderby = $key;
        }
        $i++;
    }
    $sort = "ASC";
} else {
    $orderby = mysql_real_escape_string($_GET['orderby']);
}
//If Sort Not Set Or Invalid, Set Default
if (!isset($_GET['sort']) OR ($_GET['sort'] != "ASC" AND $_GET['sort'] != "DESC")) {
    $sort = "ASC";
} else {
    $sort = mysql_real_escape_string($_GET['sort']);
}
//Getting Data
$sql = "SELECT * FROM `" . TABLE . "` ORDER BY $orderby $sort LIMIT $startrow,$limit";
$result = mysql_query($sql) or die(mysql_error());
$array = mysql_fetch_assoc($result);
}
//Counting Active and Inactive Users
$active = mysql_fetch_array(mysql_query("SELECT count(*) as rows FROM `" . TABLE . "` WHERE subscribed='Yes'"));
$inactive = mysql_fetch_array(mysql_query("SELECT count(*) as rows FROM `" . TABLE . "` WHERE subscribed='No'"));

?>