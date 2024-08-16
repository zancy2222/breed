<?php
    include('conn.php');

    $id=$_GET['id'];
    $status=$_GET['status'];

    mysqli_query($conn,"update 'db_chicks' set status='$status' where id='$id'");
    header('location:inventory-chicks.php');
?>