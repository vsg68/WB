<?php

$link = mysqli_connect("localhost","root","tarkvsg","mailserver") or die("Error " . mysqli_error($link));
($mbox = $_REQUEST["mbox"]) ||  die("error");

if( $_REQUEST["q"] == "alias" ){
    $sql = "SELECT  * FROM aliases WHERE delivery_to = '". $mbox."' AND alias_name != '". $mbox."'";
}
elseif($_REQUEST["q"] == "fwd" ){
    $sql = "SELECT  * FROM aliases WHERE alias_name = '". $mbox."'";
}

$res = $link->query($sql);
$rows= array();
while( $row = mysqli_fetch_assoc($res)) {
    $rows[] = $row;
}

echo json_encode($rows);
?>