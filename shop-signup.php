<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Gamefowl</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-...your-integrity-hash-here..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        
    *{
    padding: 0;
    margin: 0;
    text-decoration: none;
    list-style: none;
    box-sizing: border-box;
    }

    body{
        font-family: Arial ;
        background-image: url(bg.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }

    nav{
        background: #45796c;
        height: 70px;
        width: 100%;
        position: relative;
        z-index: 999;
    }

    label.logo{
        color: white;
        font-size: 30px;
        line-height: 80px;
        padding: 0 100px;
        font-weight: bold;
    }

    nav ul{
        float: right;
        margin-right: 20px;
    }

    nav ul li{
        display: inline-block;
        line-height: 80px;
        margin: 0 5px;
        text-decoration: none;
    }

    nav ul li a{
        color: white;
        font-size: 17px;
        padding: 7px 13px;
        border-radius: 3px;
        text-decoration: none;
    }

    nav a.active,
    nav a:hover{
        color: #ffffff;  
        font-weight: 100;
        background : #4EB098;
        transition: .5s; 
        box-shadow: 1px 1px 1px 1px 
        rgba(2, 2, 92, 0.354);
    }

    .checkbtn{
        font-size: 30px;
        color: white;
        float: right;
        line-height: 80px;
        margin-right: 20px;
        cursor: pointer;
        display: none;
    }

    #check{
        display: none;
    }

    @media (max-width: 952px){
    label.logo{
    font-size: 18px;
    padding-left: 50px;
    }

    nav ul li a{
        font-size: 16px;
    }
    }

    @media (max-width: 1070px){
    .checkbtn{
    display: block;
    }

    ul{
        position: fixed;
        width: 100%;
        height: 100vh;
        background: #000000b6;
        top: 70px;
        left: -100%;
        text-align: center;
        transition: all .5s;
    }

    nav ul li{
        display: block;
        margin: 50px 0;
        line-height: 30px;
    }

    nav ul li a{
        font-size: 20px;
    }

    nav a:hover,
    nav a.active{
        background: none;
        color: #0082e6;
    }

    #check:checked ~ ul{
        left: 0;
    }
   
    }
    .wrapper
    {
        position: fixed;
        top: 50%;
        margin-top: 3%;
        right: 4%;
        transform: translateY(-50%);
        width: 350px;
        height: 400px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .5);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 30px rgba(236, 232, 232, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        
    }
   .wrapper .form-box
   {
        width: 100%;
        padding: 40px;
   }
   .form-box h2
   {
        font-size: 2em;
        color: #d7e4ed;
        text-align: center;
   }
   .input-box
   {
    position: relative;
    width: 100%;
    height: 40px;
    border-bottom: 2px solid #d4dce1;
    margin: 10px 0;
   }
   
   .input-box input
   {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    color: white;
    font-weight: 600;
    padding: 0 25px 0 5px;
   }
   .input-box .icon
   {
    position: absolute;
    right: 4px;
    font-size: 1.3em;
    color: white;
    line-height: 40px;
   }
   .remember-forgot
   {
    font-size: .9em;
    color: #162938;
    font-weight: 500;
    margin: 15px 0 15px;
    display: flex;
    justify-content: space-between;
   }
   .remember-forgot label input
   {
    accent-color: #e8ecef;
    margin-right: 3px;
   }
   .remember-forgot a
   {
    color: blue;
    text-decoration: none;

   }
   .remember-forgot label
   {
    color: white;
   }
   .btn
   {
    width: 100%;
    height: 35px;
    background: green;
    border: none;
    outline: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em;
    color: white;
    font-weight: 500;
   }
   .login-register
   {
    font-size: .9em;
    color: white;
    text-align: center;
    font-weight: 500;
    margin: 20px 0;
   }
   .login-register a
   {
    color: blue;
    text-decoration: none;
   }
   
   .wrapper .list
   {
    position: fixed;
    left: 50%;
    top: 20px;
    transform: translateX(-50%);
    width: 80%;
    height:  0;
    display: flex;
    margin: 0;
    padding: 0;
    justify-content: space-between;
   }
   .wrapper .list li
   {
    flex: 1;
   }
   .wrapper .list li a
   {
    display: block;
    text-decoration: none;
    padding: 10px 0;
    text-align: center;
    color: #fff;
    border-radius: 4px;
    border: 1px solid white;
    transition: background-color 0.3s ease;
    position: relative;
    
   }
   .wrapper .list li:first-child
   {
    margin-right: 10px;
   }
   .wrapper .list li a.active
   {
    background-color: #5ca8b7;
   }
   .wrapper .list li a:hover
   {
    background-color: #408a76;
   }
  
  </style>
</head>
  
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>

      <label class="logo">
        <i class="fa fa-braille" aria-hidden="true"></i>
        Gamefowl
        </label>
     
      <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
        <li><a class="active" href="shop-log.php">Login</a></li>
      </ul>
    </nav>

    <div class="wrapper">
        <div class="form-box login">
            <ul class="list">
                <li><a href="shop-log.php" class="active">SHOP</a></li>
                <li><a href="inventory-log.php">Admin</a></li>
            </ul>
        <h2 style="margin-top: 80px;">Shop Signup</h2>
        <form method="POST">
            <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                <input type="text" placeholder="Username" required>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" placeholder="Password" required>
            </div>
            <div class="remember-forgot">
                <label>
                    <input type="checkbox">Remember me
                </label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Signup</button>
            <div class="login-register">
                <p>You have an account? <a href="shop-log.html" class="register-link">Login</a></p>
            </div>
        </form>
        </div>
    </div>
  </body>
</html>