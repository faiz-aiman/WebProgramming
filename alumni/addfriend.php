<?php
    //Add this file to open session for every file
    require("sessionconfig.php");
    //Add this file to use database for every file
    include("../db.php");

    $senderid = $_SESSION['id'];
    $recieverid = $_POST['id'];

    $add = $con->prepare("INSERT INTO friend_list(sender_id, receiver_id) VALUES( ?, ?)");
    $notify = $con->prepare("INSERT INTO `notification`(receiver_id, type, content_id, time) VALUES($recieverid, 'request', $senderid, CURRENT_TIMESTAMP)");
    if (!$add) {
        header("Location:alumni.php#failModal");
        exit;
    } else {
        $add->bind_param('ii', $senderid, $recieverid);
        $add->execute();
        $notify->execute();
        header("Location:alumni.php#successModal");
        exit;
    }
?>