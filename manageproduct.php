<?php
 session_start();
 $name=$_SESSION['username'];
 if($name!="admin"){
     echo "<script>alert('Only admins can access it');</script>";
     header("location:adminlogin.php");
 }

?>



<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/netsc.css">
    <link rel="stylesheet" href="style/footer.css">
    <style>
        .container { 
            height: 200px;
            position: relative; 
        }
            .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
  
        .manage {
            background-color: rgb(169, 146, 218);
            font-family: "Libre Caslon Text", serif;
            font-size: 20px;
            font-weight: bold;
            width: 420px;
            border-radius: 10px
        }
        button:hover {
            background-color: rgb(237, 234, 240);
            box-shadow: 1px 1px 2px Grey;
            cursor: pointer;
        }
    </style>
    <body>

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large"
    onclick="w3_close()">Close &times;</button>
    <a href="adminprofile.php" class="w3-bar-item w3-button">Go Back</a>
    </div>

    <div id="main">

    <div class="w3-teal">
    <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
    <div class="w3-container">
        <h1>Welcome to admin home page</h1>
    </div>
    </div>

    </div>

    <script>
    function w3_open() {
    document.getElementById("main").style.marginLeft = "25%";
    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
    }
    function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
    }
    </script>

    <br><br>
    <div class="container">
        <div class="center">

            <button class="manage"><a href="product.php">Insert Product</a> <img src="image/add-btn-img.png" style="width: 50px;"></button><br><br>
            <button class="manage"><a href="editproduct.php">Update Product details</a> <img src="image/add-btn-img.png" style="width: 50px;"></button><br><br>
            <button class="manage"> <a href="stock.php">Manage product availability</a> <img src="image/edit-btn-img.png" style="width: 50px;"></button>
        </div>
    </div>
</body>
<footer class = "footers" align="center">
            Developed by Preeti Pallavi (20BCE1828) and Shubhangi Agrawal (20BCE1161)
        </footer>
</html>

<!-- 
<html>
    <body>
        <h4><a href="product.php">Insert Product</a></h4>
        <h4><a href="stock.php">Manage product availability</a></h4>
        //go back page
        <h4><a href="javascript:history.back()">Go Back</a></h4>
    

    </body>
</html> -->