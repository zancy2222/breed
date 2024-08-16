<?php

@include 'conn.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $breed = $_POST['breed'];
   $product_name = $_POST['product_name'];
   $product_quant = $_POST['product_quant'];

       $insert ="UPDATE db_products SET breed ='$breed',product_name='$product_name', product_quant='$product_quant' WHERE id='$id'";
       $update_qry=mysqli_query($conn,$insert);
           echo"<script>alert('UPDATED');window.location.href='inventory-product.php'</script>";
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM db_products WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">update the product</h3>
      <select class="box" name="breed" required>
                                    <option value="" disabled selected>Select Breed</option>
                                    <?php
                                    include 'conn.php';
                                    $breeds_query = mysqli_query($conn, "SELECT * FROM db_category");
                                    while ($row = mysqli_fetch_assoc($breeds_query)) {
                                        ?>
                                        <option value="<?php echo $row['breed']; ?>"><?php echo $row['breed']; ?></option>
                                    <?php } ?>
                                </select><br>
      <input type="text" class="box" name="product_name" value="<?php echo isset ($row['product_name'])? $row['$product_name']:''; ?>" placeholder="enter the product name" required><br>
      <input type="number" class="box" name="product_quant" value="<?php echo $row['product_quant']; ?>" placeholder="enter the product quantity" required>
      <input type="submit" value="update product" name="update_product" class="btn">
      <a href="inventory-product.php" class="btn">go back!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>