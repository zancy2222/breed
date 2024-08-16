<?php
    include 'conn.php';
    $id=$_GET['id'];
    if(isset($_POST['availabilityedit'])){
        $product_name=$_POST['product_name'];
        $product_ski=$_POST['product_ski'];
        $product_achieve=$_POST['product_achieve'];
        $unit =$_POST['unit'];
        $price=$_POST['price'];

        $insert= "UPDATE db_availability SET product_name='$product_name',product_ski='$product_ski',product_achieve='$product_achieve',unit='$unit',price='$price' WHERE id='$id'";
        $update_qry=mysqli_query($conn,$insert);
            echo"<script>alert('UPDATED');window.location.href='inventory-availability.php'</script>";
    }
?>