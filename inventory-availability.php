<?php
@include 'conn.php';

function getDateTimeDiff($date){
    $now_timestamp= strtotime(date('Y-m-d H:i:s'));
    $diff_timestamp= $now_timestamp - strtotime($date);
    
    if($diff_timestamp < 60){
    return 'few seconds ago';
    }
    else if($diff_timestamp>=60 && $diff_timestamp<3600){
    return round($diff_timestamp/60).' mins ago';
    }
    else if($diff_timestamp>=3600 && $diff_timestamp<86400){
    return round($diff_timestamp/3600).' hours ago';
    }
    else{
        return round($diff_timestamp/(86400)).' days ago';
    }
}


if(isset($_POST['save'])){
    $id = $_POST['id'];
    $img = $_FILES['img']['name'];
    $breed = $_POST['breed'];
    $product_name = $_POST['product_name'];
    $hatched=date ('Y-m-d H:i:s', strtotime($_POST['hatched']));
    $age=strtotime (date('Y-m-d H:i:s'));    
    $product_weight = $_POST['product_weight'];
    $product_hei = $_POST['product_hei'];
    $product_quant = $_POST['product_quant'];
    $price = $_POST['price'];

    // Upload image to the uploads directory
    $targetDirectory = 'uploads/';
    $targetFile = $targetDirectory . basename($_FILES['img']['name']);

    if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
        // Image uploaded successfully
        // Proceed with database operations
        $update_query = "UPDATE db_products SET breed=?, hatched=?, age=?, product_quant=? WHERE id=?";
        $stmt_update = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt_update, "ssssi", $breed, $hatched, $age, $product_quant, $id);

        if(mysqli_stmt_execute($stmt_update)){
            $insert_query = "INSERT INTO db_availability(breed, product_name, hatched, age, product_weight, product_hei, price, product_quant, img) VALUES(?,?,?,?,?,?,?,?,?)";
            $stmt_insert = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($stmt_insert, "sssssssis", $breed, $product_name, $hatched, $age, $product_weight, $product_hei, $price, $product_quant, $img);

            if(mysqli_stmt_execute($stmt_insert)){
                $delete_query = "DELETE FROM db_products WHERE id=?";
                $stmt_delete = mysqli_prepare($conn, $delete_query);
                mysqli_stmt_bind_param($stmt_delete, "i", $id);

                if(mysqli_stmt_execute($stmt_delete)){
                    echo "<script>alert('Successfully sell product.');</script>";
                } else {
                    echo "<script>alert('Failed to remove product: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                echo "<script>alert('Failed to insert into availability: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Failed to update quantity: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        // File upload failed
        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
    }
} 

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM db_products WHERE id = $id");
    header('location:inventory-product.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gamefowl</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <style>

*{
    padding: 0;
    margin: 0;
    text-transform: capitalize;
    font-family: Arial;
}
body{
padding-top: 80px;
}
header{
    position: fixed;
    top: 0;
    left: 0; 
    right: 0;
    background: #4EB098;
    box-shadow:0 5px 10px black;
    padding:0px 100px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 1000;
}
header .logo{
    color: white;
    text-decoration: none;
    font-weight:bolder;
    font-size:25px;
}
header .nav ul{
    list-style: none;
    padding-top: 10px;
}
header .nav ul li{
    position: relative;
    float: left;
}
header .nav ul li a{
    font-size:20px;
    padding:18px;
    color: #fff;
    display: block;
    height: 51px;
    text-decoration: none;
    margin-bottom: 5px;
}
nav a:hover{
    color: #ffffff;  
    font-weight: 100;
    background : #408a76;
    transition: .5s; 
    box-shadow:1px 1px 1px 1px rgba(2, 2, 92, 0.354);
}
header .nav ul li ul{
    position: absolute;
    left: 0;
    width: 200px;
    background: #4EB098;
    display: none;
    margin-top: 7px;
}
header .nav ul li ul li{
    width:100%;
    border-top:1px solid black;
}
header .nav ul li ul li ul{
    left: 200px;
    top: 0;
}
header .nav ul li:focus-within > ul,
header .nav ul li:hover > li{
    display: initial;
}
#menu-bar{
    display: none;
}

header label{
    font-size:20px;
    color: #fff;
    cursor: pointer;
    display: none;
}



@media(max-width:991px){
    header{
        padding:18px;
    }
    header label{
        display: initial;
    }
    header .nav{
        position: absolute;
        top:100%; left: 0; right: 0;
        background: #4EB098;
        border-top:1px solid rgba(0, 0, 0, 1);
        display: none;
    }
    header .nav ul li{
        width:100%;
    }
    header .nav ul li ul{
        position: relative;
        width:100%;
    }
    header .nav ul li ul li{
        background: #333;
    }
    header .nav ul li ul li ul{
        width:100%;
        top: 0;
    }
    #menu-bar:checked ~ .nav{
        display: initial;
    }
    header .nav ul li:hover{
        display: initial;
    }
    .modal-dialog{
        width:300px;
        position: absolute;
        left: 0;
        padding: 0;
        top: 10%;
        transform: translateY(-10%);
        margin: auto;
        margin-left: 10%;
    }
    .table-bordered img {
            max-width: 100%;
            height: auto;
        }

        .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            overflow-x: auto;
        }

        .card-header h5 {
            margin-bottom: 0;
        }

        .card-body table {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
        }

        .card-body th,
        .card-body td {
            white-space: nowrap;
            word-wrap: break-word;
            padding: 8px;
        }
    }

.con{
    position: relative;
    margin: 30px;
    padding-top: 80px;
}
.chicks{
    background: none; 
    border: none; 
    font-size:24px; 
    border-bottom:2px solid #408a76; 
    border-right:2px solid #408a76;
    box-shadow:1px 1px 1px 1px rgba(2, 2, 92, 0.354);
    cursor: pointer;
}
.modal-dialog{
    width:350px;
}
    .table-bordered img {
        max-width:120px;
        max-height:100px;
    }
     .card-body th {
    padding: 15px;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    color: black;}
.card-header h5 {
margin-bottom: 0;
}

</style>
</head>
  
<body>
     <header>
        <a href="#" class="logo">Gamefowl</a>   
        <input type="checkbox" id="menu-bar">
        <label for="menu-bar">Menu</label>

    <nav class="nav">
        <ul>
            <li><a href="inventory-dashboard.php">Dashboard</a></li>
            <li><a href="inventory-category.php">Category</a></li>
            <li><a href="inventory-product.php">Rooster</a></li>
            <li><a href="inventory-products.php">Hen</a></li>
            <li><a href="#">Breeding</a></li>
            <li><a href="inventory-availability.php">stock</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    </header>
   
   <div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0" style="font-weight: bold;">Manage Availability Products</h2>
                <div style="height: 50px; width: 150px; margin-bottom: 10px; font-size: 18px">
                </div>
            </div>
           
            <div class="card-body">
                <table class="table table-bordered table-striped">

         <thead>
         <tr>
            <th style="padding-left: 20px">Image</th>
            <th style="padding-left: 20px">Breed</th>
            <th style="padding-left: 20px">Name</th>
            <th style="padding-left: 20px">Age</th>
            <th style="padding-left: 20px">Weight</th>
            <th style="padding-left: 20px">Height</th>
            <th style="padding-left: 20px">Quantity</th>
            <th style="padding-left: 20px">Price</th>
            <th style="padding-left: 20px">Action</th>
         </tr>  
         </thead>
         <?php
         $select = mysqli_query($conn, "SELECT * FROM db_availability");
         $id = 1;
         while($row = mysqli_fetch_assoc($select)){ ?>
         <tr style="vertical-align: middle;">
            <td style=" font-size: 15px; text-align: center;"><img src="uploads/<?php echo $row['img']; ?>" height="100" alt=""></td>
            <td style=" font-size: 15px; text-align: center;"><?php echo $row['breed']; ?></td>
            <td style=" font-size: 15px; text-align: center;"><?php echo $row['product_name']; ?></td>
            <td style="font-size: 15px; text-align: center;"><?php echo getDateTimeDiff($row['hatched']); ?></td>
            <td style=" font-size: 15px; text-align: center;"><?php echo $row['product_weight']; ?></td>
            <td style=" font-size: 15px; text-align: center;"><?php echo $row['product_hei']; ?></td>
            <td style=" font-size: 15px; text-align: center;"><?php echo $row['product_quant']; ?></td>
            <td style=" font-size: 15px; text-align: center;"><i class="fa-solid fa-peso-sign"></i><?php echo $row['price']; ?></td>
            <td style=" font-size: 15px; text-align: center;">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#availabilityeditModal<?php echo $row['id'] ?>" style="font-weight: bold; font-size: 15px; font-family: Arial; width: 120px; margin-left: 15px"><i class="fas fa-edit"></i>
                Edit
            </button><br>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#availabilitydeleteModal<?php echo $row['id'] ?>" style="font-weight: bold; font-size: 15px; font-family: Arial;  width: 120px; margin-left: 15px"><i class="fas fa-trash"></i>
                Delete
            </button>
            </td>
         </tr>
      <?php 
      include 'availability-delete-modal.php';
      include 'availability-edit-modal.php';
      $id++;} ?>
    
      </table>
   </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>