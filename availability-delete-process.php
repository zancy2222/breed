<?php
    include 'conn.php';

    $id =$_GET['id'];

    if(isset($_POST['availabilitydelete'])){
        $insert ="Delete FROM db_availability WHERE id= '$id'";
        $delete_qry =mysqli_query($conn, $insert);

        if($delete_qry){
            echo"<script>alert('Deleted');window.location.href='inventory-availability.php'</script>";
        }else{
            echo"<script>alert('delete failed');</script>";
        }
    }
?>