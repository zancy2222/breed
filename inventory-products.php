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
   
        if(isset($_POST['add_product'])) {
            $img = $_FILES['img']['name'];
            $breed = $_POST['breed'];
            $hatched = date('Y-m-d H:i:s', strtotime($_POST['hatched']));
            
            // Check if hen_achieve is set and not empty
            if(isset($_POST['hen_achieve']) && !empty($_POST['hen_achieve'])) {
                $hen_achieve = $_POST['hen_achieve'];
            } else {
                // Assign a default value or handle the case accordingly
                $hen_achieve = ''; // You can change this to whatever default value you want
            }
            
            $hen_produce = $_POST['hen_produce'];
            $product_quant = $_POST['product_quant'];
        
            if(empty($breed) || empty($hen_produce)) {
                $message[] = 'Please fill out all fields';
            } else {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($img);
                
                if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    $age = time();
                    $insert = $conn->prepare("INSERT INTO db_henproducts (img, breed, hatched, age, hen_achieve, hen_produce, product_quant) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $insert->bind_param("sssssii", $img, $breed, $hatched, $age, $hen_achieve, $hen_produce, $product_quant);
                    
                    if($insert->execute()) {
                        $message[] = 'Product added successfully';
                    } else {
                        $message[] = 'Failed to add product';
                    }
                } else {
                    $message[] = 'Failed to upload image';
                }
            }
        }
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM db_henproducts WHERE id = $id");
    header('location:inventory-products.php');
}
?>
<?php 
@include 'products-modal.php';
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
                *
                {
                    padding: 0;
                    margin: 0;
                    text-transform: capitalize;
                    font-family: Arial, Helvetica, sans-serif;
                }
                body
                {   
                    padding-top: 80px;
                }
                header
                {
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
                header .logo
                {
                    color: white;
                    text-decoration: none;
                    font-weight:bolder;
                    font-size:25px;
                }
                header .nav ul
                {
                    list-style: none;
                    padding-top: 10px;
                }
                header .nav ul li
                {
                    position: relative;
                    float: left;
                }
                header .nav ul li a
                {
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
                header .nav ul li ul li
                {
                    width:100%;
                    border-top:1px solid black;
                }
                header .nav ul li ul li ul
                {
                    left: 200px;
                    top: 0;
                }
                header .nav ul li:focus-within > ul,
                header .nav ul li:hover > li
                {
                    display: initial;
                }
                #menu-bar
                {
                    display: none;
                }

                header label
                {
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
                        }

                        .card-body th,
                        .card-body td {
                            white-space: nowrap;
                            word-wrap: break-word;
                            padding: 8px;
                        }
                    }

                .con
                {
                    position: relative;
                    margin: 30px;
                    padding-top: 80px;
                }
                .chicks{
                    background: none; 
                    border: none; 
                    font-size:24px; 
                    border-bottom:2px solid #408a76; 
                    cursor: pointer;
                }
                .modal-dialog {
                    width: auto;
                    margin: 5% auto;
                }

                .modal-content {
                    width: 90%;
                    max-width: 500px;
                    margin: 0 auto;
                }

                .modal-body {
                    padding: 20px;
                }

                .modal-footer {
                    padding: 10px 20px;
                    justify-content: space-between;
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
                    color: black;
                }
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
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
   <div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0" style="font-weight: bold; display: inline;">Manage Hen</h2>
                <div>
                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productsModal" style="height: 40px; width: 150px; margin-bottom: 10px; font-size: 18px">Add Hen</button>
                </div>
            </div>
           
            <div class="card-body">
                <table class="table table-bordered table-striped">

                    <?php

$select = mysqli_query($conn, "SELECT * FROM db_henproducts");

?>
         <thead>
         <tr>
            <th>Image</th>
            <th>Breed</th>
            <th>Hatched Date</th>
            <th>Age</th>
            <th>Achievements</th>
            <th>Produce</th>
            <th>.......</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ 
            ?>
<tr style="vertical-align: middle;">
<td style=" font-size: 15px; text-align: center;"><img src="uploads/<?php echo $row['img']; ?>" height="100" alt=""></td>
    <td style="font-size: 20px; text-align: center;"><?php echo $row['breed']; ?></td>
    <td style="font-size: 20px; text-align: center;"><?php echo date('Y.m.d', strtotime($row['hatched'])); ?></td>
    <td style="font-size: 20px; text-align: center;"><?php echo getDateTimeDiff($row['hatched']); ?></td>
    <td style="font-size: 20px; text-align: center;"><?php echo $row['hen_achieve']; ?></td>
    <td style="width: 2%; font-size: 20px; text-align: center;"><?php echo $row['hen_produce']; ?></td>
    <td style="width: 200px;">
        <button type="button" class="btn btn-outline-danger sell-btn" data-bs-toggle="modal" data-bs-target="#stoleModal<?php echo $row['id']; ?>" data-product-id="<?php echo $row['id']; ?>" style="font-size: 18px; width: 90px;">Died</button>
        <button type="button" class="btn btn-outline-warning sell-btn" data-bs-toggle="modal" data-bs-target="#stoleModal<?php echo $row['id']; ?>" data-product-id="<?php echo $row['id']; ?>" style="font-size: 18px; width: 90px;">Stole</button>
        <button type="button" class="btn btn-outline-info sell-btn" data-bs-toggle="modal" data-bs-target="#sellModal<?php echo $row['id']; ?>" data-product-id="<?php echo $row['id']; ?>" style="font-size: 18px; width: 90px;">Breed</button>
        <button type="button" class="btn btn-outline-success sell-btn" data-bs-toggle="modal" data-bs-target="#soldModal<?php echo $row['id']; ?>" data-product-id="<?php echo $row['id']; ?>" style="font-size: 18px; width: 90px;">Sell</button>
    </td>
    <td style="padding: 15px;">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#productseditModal<?php echo $row['id'] ?>" style="font-weight: bold; font-size: 15px; font-family: Arial;"><i class="fas fa-edit"></i>
            Edit
        </button><br>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#productsdeleteModal<?php echo $row['id'] ?>" style="font-weight: bold; font-size: 15px; font-family: Arial;"><i class="fas fa-trash"></i>
            Delete
        </button>
    </td>
</tr>
<div class="modal fade" id="productseditModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Hen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="product-edit-process.php?id=<?php echo $row['id']; ?>" method="post">
                    <div class="row">
                    <div class="col-md-12">
                            <div class="form-group">
                                <label for="breed">Breed Name</label>
                                <input type="text" class="form-control" name="breed" id="breed" value="<?php echo $row['breed']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="hatched">Hatched Date</label>
                                <input type="datetime-local" class="form-control" name="hatched" id="hatched" value="<?php echo date('Y-m-d\TH:i', strtotime($row['hatched'])); ?>" required>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="product_achieve">Achievements</label>
                                <input type="text" class="form-control" name="hen_achieve" id="hen_achieve" value="<?php echo $row['hen_achieve']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="product_quant">Product Stocks</label>
                                <input type="number" class="form-control" name="product_quant" id="product_quant" value="<?php echo $row['product_quant']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="productsedit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="productsdeleteModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Hen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="products-delete-process.php?id=<?php echo $row['id']?>" method="post">
                    <p>Are you sure you want to delete this product <?php echo $row['breed']?>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-danger" name="productsdelete">Submit</button>
            </div>
            </form>
            </div>
        </div>
        </div>

    <div class="modal fade" id="soldModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Sell Hen</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form name="sell_form" action="inventory-availability.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <label for="img" style="font-weight: bold; font-size: 15px; font-family: arial">Product Image:</label>
                            <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="img" name="img" required><br>
                            <label for="breed" style="font-weight: bold; font-size: 15px; font-family: arial">Product Breed:</label>
                            <input type="text" class="form-control" id="breed" name="breed" value="<?php echo $row['breed'];?>" readonly><br>
                            <label for="product_name" style="font-weight: bold; font-size: 15px; font-family: arial">Product Name:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required><br>
                            <label for="hatched" style="font-weight: bold; font-size: 15px; font-family: arial">Hatched Date</label>
                            <input type="text" class="form-control" id="hatched" name="hatched" value="<?php echo $row['hatched'];?>" readonly><br>
                            <label for="age" style="font-weight: bold; font-size: 15px; font-family: arial">Age</label>
                            <input type="text" class="form-control" id="age" name="age" value="<?php echo $row['age'];?>" readonly><br>
                            <label for="product_weight" style="font-weight: bold; font-size: 15px; font-family: arial">Weight</label>
                            <input type="text" class="form-control" id="product_weight" name="product_weight" required><br>
                            <label for="product_hei" style="font-weight: bold; font-size: 15px; font-family: arial">Height</label>
                            <input type="text" class="form-control" id="product_hei" name="product_hei" required><br>
                            <label for="product_ski" style="font-weight: bold; font-size: 15px; font-family: arial">Skills</label>
                            <input type="text" class="form-control" id="product_desc" name="product_ski" value="<?php echo $row['product_ski'];?>" required><br>
                            <label for="product_achieve" style="font-weight: bold; font-size: 15px; font-family: arial">Achievements</label>
                            <input type="text" class="form-control" id="product_achieve" name="product_achieve" value="<?php echo $row['product_achieve'];?>" required><br>
                            <label for="price" style="font-weight: bold; font-size: 15px; font-family: arial;">Product Price:</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                            <label for="product_quant" style="font-weight: bold; font-size: 15px; font-family: arial;">Quantity to Sell:</label>
                            <input type="number" class="form-control" id="product_quant" name="product_quant" value="1" readonly>
                        </div>
                        <div class="modal-footer" >
                        <button type="submit" name="save" class="btn btn-primary" style="font-weight: bold; font-size: 15px; font-family: Arial;">Sell</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-weight: bold; font-size: 15px; font-family: Arial;">Close</button>
                        </div>

                    </form>
                </div>
            </div>
            </div>
    </div>
<?php } ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.sell-btn').click(function() {
            var productId = $(this).data('product-id');
            $('#productId').val(productId);
            $('#sellModal').modal('show');
        });
    });
</script>
</body>
</html>