<?php
    include 'conn.php';

    $id =$_GET['id'];

    if(isset($_POST['delete'])){
        $insert ="Delete FROM db_category WHERE id= '$id'";
        $delete_qry =mysqli_query($conn, $insert);

        if($delete_qry){
            echo"<script>alert('Deleted');window.location.href='inventory-category.php'</script>";
        }else{
            echo"<script>alert('delete failed');</script>";
        }
    }
?>