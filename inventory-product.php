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
        
    if(isset($_POST['add_product']))
    {
        $prod_num=$_POST ['prod_num'];
        $breed=$_POST ['breed'];
        $hatched=date ('Y-m-d H:i:s', strtotime($_POST['hatched']));
        $age=strtotime (date('Y-m-d H:i:s'));    
        $product_quant=$_POST ['product_quant'];
        $product_achieve=$_POST ['product_achieve'];
        $test_query = mysqli_query($conn, "SELECT 1");
        if (!$test_query) {
            die("Database connection test failed: " . mysqli_error($conn));
        }
        
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Handle each question response
            $db_products = array(
                'q1' => isset($_POST['q1']) ? $_POST['q1'] : '',
                'q2' => isset($_POST['q2']) ? $_POST['q2'] : '',
                'q3' => isset($_POST['q3']) ? $_POST['q3'] : '',
                'q4' => isset($_POST['q4']) ? $_POST['q4'] : '',
                'q5' => isset($_POST['q5']) ? $_POST['q5'] : '',
                'q6' => isset($_POST['q6']) ? $_POST['q6'] : '',
                'q7' => isset($_POST['q7']) ? $_POST['q7'] : '',
                'q8' => isset($_POST['q8']) ? $_POST['q8'] : '',
                'q9' => isset($_POST['q9']) ? $_POST['q9'] : '',
            );
            function calculatePercentage($questions, $db_products) {
                $totalQuestions = count($questions);
                $correctAnswers = 0;
            
                foreach ($questions as $question) {
                    if (isset($db_products[$question]) && $db_products[$question] === 'yes') {
                        $correctAnswers++;
                    }
                }
            
                return ($totalQuestions > 0) ? ($correctAnswers / $totalQuestions) * 100 : 0;
            }
            // Calculate percentages
            $intelligencePercentage = calculatePercentage(['q1', 'q2', 'q3'], $db_products);
            $airPercentage = calculatePercentage(['q4', 'q5', 'q6'], $db_products);
            $landPercentage = calculatePercentage(['q7', 'q8', 'q9'], $db_products);
        }
        }            
        if(empty($breed) || empty($product_quant)){
        } else {
            $insert="INSERT INTO db_products(prod_num,breed,hatched,age,product_achieve,product_quant, q1, q2, q3, intellpercentage, q4, q5, q6, airpercentage, q7, q8, q9, landpercentage) 
            VALUES ('$prod_num','$breed','$hatched','$age','$product_achieve' ,'$product_quant', '".$db_products['q1']."', '".$db_products['q2']."', '".$db_products['q3']."', '$intelligencePercentage', 
            '".$db_products['q4']."', '".$db_products['q5']."', '".$db_products['q6']."', '$airPercentage', 
            '".$db_products['q7']."', '".$db_products['q8']."', '".$db_products['q9']."', '$landPercentage')";
            $upload=mysqli_query($conn, $insert);
            if(!$upload) {
                $message[] = 'Failed to add product';
            }
        }
    
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM db_products WHERE id = $id");
        header('location:inventory-product.php');
    }
    
    ?>

<?php 
@include 'product-modal.php';
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
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
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
                    width: 100%;
                    max-width: 550px;
                    margin: 0 auto;
                }

                .modal-footer {
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
                <div>
                <h2 class="mb-0" style="font-weight: bold; display: inline;">Manage Rooster</h2>
                </div>
                <div>
                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal" style="height: 40px; width: 150px; margin-bottom: 10px; font-size: 18px">Add Rooster</button>
                </div>
            </div>
           
            <div class="card-body">
                <table class="table table-bordered table-striped">

                    <?php

$select = mysqli_query($conn, "SELECT * FROM db_products");

?>
         <thead>
    <tr>
        <th rowspan="2">#</th>
        <th rowspan="2">Breed</th>
        <th rowspan="2">Hatched Date</th>
        <th rowspan="2">Age</th>
        <th colspan="3">Skills</th>
        <th rowspan="2">Achievements</th>
        <th  rowspan="2">.......</th>
        <th  rowspan="2">Action</th>
    </tr>
    <tr>
        <th>Smart</th>
        <th>Air</th>
        <th>Land</th>
    </tr>
</thead>

         <?php while($row = mysqli_fetch_assoc($select)){ 
            ?>
<tr style="vertical-align: middle;">
    <td style="font-size: 20px; text-align: center;"><?php echo $row['prod_num']; ?></td>
    <td style="font-size: 20px; text-align: center;"><?php echo $row['breed']; ?></td>
    <td style="font-size: 20px; text-align: center;"><?php echo date('Y.m.d', strtotime($row['hatched'])); ?></td>
    <td style="font-size: 20px; text-align: center;"><?php echo getDateTimeDiff($row['hatched']); ?></td>
    <td style="font-size: 20px; text-align: center;"><?php echo $row['intellpercentage']; ?></td>
    <td style="font-size: 20px; text-align: center;"><?php echo $row['airpercentage']; ?></td>
    <td style="font-size: 20px; text-align: center;"><?php echo $row['landpercentage']; ?></td>
    <td style="font-size: 20px; text-align: center;"><?php echo $row['product_achieve']; ?></td>
    <td style="width: 200px;">
        <button type="button" class="btn btn-outline-danger sell-btn" data-bs-toggle="modal" data-bs-target="#stoleModal<?php echo $row['id']; ?>" data-product-id="<?php echo $row['id']; ?>" style="font-size: 15px; width: 90px;">Deceased</button>
        <button type="button" class="btn btn-outline-warning sell-btn" data-bs-toggle="modal" data-bs-target="#stoleModal<?php echo $row['id']; ?>" data-product-id="<?php echo $row['id']; ?>" style="font-size: 15px; width: 90px;">Stole</button>
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#breedModal<?php echo $row['id']; ?>" data-product-id="<?php echo $row['id']; ?>" style="font-size: 15px; width: 90px;">Breed</button>
        <button type="button" class="btn btn-outline-success sell-btn" data-bs-toggle="modal" data-bs-target="#sellModal<?php echo $row['id']; ?>" data-product-id="<?php echo $row['id']; ?>" style="font-size: 15px; width: 90px;">Sell</button>
    </td>
    <td>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#producteditModal<?php echo $row['id'] ?>" style="font-weight: bold; font-size: 15px; font-family: Arial;"><i class="fas fa-edit"></i>
            Edit
        </button><br>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#productdeleteModal<?php echo $row['id'] ?>" style="font-weight: bold; font-size: 15px; font-family: Arial;"><i class="fas fa-trash"></i>
            Delete
        </button>
    </td>
</tr>
<div class="modal fade" id="producteditModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Rooster</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="product-edit-process.php?id=<?php echo $row['id']; ?>" method="post">
                    <div class="row">
                    <div class="col-md-12">
                            <div class="form-group">
                                <label for="breed">Cockfighting Number</label>
                                <input type="number" class="form-control" name="prod_num" id="prod_num" value="<?php echo $row['prod_num']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="breed">Cockfighting Breed</label>
                                <input type="text" class="form-control" name="breed" id="breed" value="<?php echo $row['breed']; ?>" readonly>
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
                                <label for="product_ski">Achievements</label>
                                <input type="text" class="form-control" name="product_ski" id="product_achieve" value="<?php echo $row['product_achieve']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="productedit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="productdeleteModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Rooster</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="product-delete-process.php?id=<?php echo $row['id']?>" method="post">
                    <p>Are you sure you want to delete this product <?php echo $row['breed']?>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-danger" name="productdelete">Submit</button>
            </div>
            </form>
            </div>
        </div>
        </div>

        <div class="modal fade" id="breedModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">     
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Breed Rooster</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="sell_form" action="inventory-breeding.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="mb-3">
                            <label for="breed" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Product Breed:</label>
                            <input type="text" class="form-control" id="breed" name="breed" value="<?php echo $row['breed']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="product_achieve" class="form-label" style="font-weight: bold; font-size: 15px; font-family: arial">Achievements:</label>
                            <input type="text" class="form-control" id="product_achieve" name="product_achieve" value="<?php echo $row['product_achieve']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <div id="chartContainer" style="height: 420px;"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="mate" class="btn btn-primary" style="font-weight: bold; font-size: 15px; font-family: Arial;">Mate</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-weight: bold; font-size: 15px; font-family: Arial;">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sellModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Sell Rooster</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                <form name="sell_form" action="inventory-availability.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> 
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
<?php 
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "breeders");

$test = array();

$count = 0;
$res = mysqli_query($link, "SELECT breed, SUM(intellpercentage) AS total_intell, SUM(airpercentage) AS total_air, SUM(landpercentage) AS total_land FROM db_products GROUP BY breed");

$intellData = array();
$airData = array();
$landData = array();

while ($row = mysqli_fetch_array($res)) {
    $intellData[] = array(
        "label" => $row["breed"],
        "y" => $row["total_intell"]
    );
    $airData[] = array(
        "label" => $row["breed"],
        "y" => $row["total_air"]
    );
    $landData[] = array(
        "label" => $row["breed"],
        "y" => $row["total_land"]
    );
}
?>
<script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title: {
        text: "Rooster Percentage Skills",
        fontFamily: "Arial",
        fontSize: 24, 
        fontColor: "blue",
        fontWeight: "bold"
    },
    axisY: {
        title: "Percentage"
    },
    data: [
        {
            type: "column",
            showInLegend: true,
            legendText: "Intelligence",
            yValueFormatString: "#,##0.## items",
            dataPoints: <?php echo json_encode($intellData, JSON_NUMERIC_CHECK); ?>
        },
        {
            type: "column",
            showInLegend: true,
            legendText: "Air Abilities",
            yValueFormatString: "#,##0.## items",
            dataPoints: <?php echo json_encode($airData, JSON_NUMERIC_CHECK); ?>
        },
        {
            type: "column",
            showInLegend: true,
            legendText: "Land Abilities",
            yValueFormatString: "#,##0.## items",
            dataPoints: <?php echo json_encode($landData, JSON_NUMERIC_CHECK); ?>
        }
    ],
});
chart.render();

}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



</body>
</html>