<?php

$link = mysqli_connect("localhost","root","tarkvsg","mailserver") or die("Error " . mysqli_error($link));

$result = $link->query("select * from users");


while( $row = mysqli_fetch_assoc($result)) {
    unset($row["md5password"]);
    $row["allow_nets"] = preg_replace('/[;,]\s*/','; ', $row["allow_nets"]);
    $rows[] = $row;
}

echo json_encode($rows);
?>