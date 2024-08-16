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
        height: 50px;
        text-decoration: none;
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
</body>
</html>