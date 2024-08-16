<?php
    include 'conn.php';
    $id=$_GET['id'];
    if(isset($_POST['productedit'])){
    $prod_num = $_POST['prod_num'];
    $breed = $_POST['breed'];
    $hatched = $_POST['hatched'];
    $product_achieve = $_POST['product_achieve'];

    $hatched_date = date('Y-m-d H:i:s', strtotime($hatched));

    $update_query = "UPDATE db_products SET prod_num= ?, breed = ?, hatched = ?, product_achieve = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, 'isssii', $prod_num, $breed, $hatched_date,$product_achieve, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo"<script>alert('UPDATED');window.location.href='inventory-product.php'</script>";
    } else {
        echo "<script>alert('Update failed: " . mysqli_error($conn) . "'); window.location.href='inventory-product.php'</script>";
    }

    mysqli_stmt_close($stmt);
}
?>
