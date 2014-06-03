<?php

$link = mysqli_connect("localhost","root","tarkvsg","mailserver") or die("Error " . mysqli_error($link));

    if( $_REQUEST["q"] == "list" ){
        $sql = "SELECT CONCAT('users_',id) as id, active, mailbox, username FROM users";
    }
    elseif($_REQUEST["q"] == "mbox" ){
//        $sql = "SELECT * FROM users ORDER BY `mailbox`";
        $sql = "SELECT *, DATE_FORMAT(`last_login`, '%d-%m-%Y') as lastlog FROM users ORDER BY `mailbox`";
    }

$res = $link->query($sql);
while( $row = mysqli_fetch_assoc($res)) {

    if($_REQUEST["q"] == "mbox" ){
        unset($row["md5password"]);
        $row["allow_nets"] = preg_replace('/[;,]\s*/',';', $row["allow_nets"]);
    }

    $rows[] = $row;
}

echo json_encode($rows);
?>