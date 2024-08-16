<?php
include("conn.php");

if (isset($_POST['submit'])) {
    $breed = $_POST['breed'];
    $img = $_FILES['image']['name'];
    
    if(empty($breed)) {
        $message[] = 'Please fill out the field';
    } else {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($img);
        
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $insert = $conn->prepare("INSERT INTO db_category (img, breed) VALUES (?, ?)");
            $insert->bind_param("ss", $img, $breed);
            
            if($insert->execute()) {
                echo "<script>alert('successfully inserting category');window.location.href='inventory-category.php'</script>";
            } else {
                echo "<script>alert('Failed to add category');window.location.href='inventory-category.php'</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamefowl</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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
    padding-left: 60px;
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
                <li><a href="inventory-availability.php">Stock</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="con" style="margin-top: 27px">
    <div class="row" >
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                <h5 class="mb-0" style="font-weight: bold; display: inline;">Manage Categories</h5>
                </div>
                <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="height: 40px; width: 150px; margin-bottom: 10px; font-size: 18px">
            Add Category
        </button> </div>
            </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Categories</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Breed Name</label>
                                        <input type="text" class="form-control" name="breed" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Category Image</label>
                                        <input type="file" class="form-control inpt-img" id="img" name="image" accept=".jpg, .jpeg, .png" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
                <table class="table table-bordered table-striped">            <tr>
                <th>Number</th>
                <th>Breed</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php 
                $get_data = "SELECT * FROM db_category";
                $get_data_qry = mysqli_query($conn, $get_data);
                $number = 1;
                while ($rows = mysqli_fetch_array($get_data_qry)) {
            ?>
                <tr>
                    <td><?php echo $number ?></td>
                    <td><?php echo $rows['breed'] ?></td>
                    <td style="font-size: 15px; text-align: center;"><img src='uploads/<?php echo $rows['img']; ?>' height="100" alt=""></td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $rows['id'] ?>">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $rows['id'] ?>">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php
                    include 'category-delete-modal.php';
                    include 'category-edit-modal.php';
                    $number++;
                }
            ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>