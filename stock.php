<?php
 session_start();
 require_once "config.php";
 $name=$_SESSION['username'];
 if($name!="admin"){
     echo "<script>alert('Only admins can access it');</script>";
     header("location:adminlogin.php");
 }

?>
<html>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style/home.css">
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
    <!-- <a href="#" class="w3-bar-item w3-button">Link 1</a>
    <a href="#" class="w3-bar-item w3-button">Link 2</a> -->
    <a href="adminprofile.php" class="w3-bar-item w3-button">Go Back</a>
    </div>

    <div id="main">

    <div class="w3-teal">
    <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
    <div class="w3-container">
        <h1>Welcome to admin home page</h1>
    </div>
    </div>

    <!-- <div class="w3-container">
        <p>In this example, the sidebar is hidden (style="display:none")</p>
        <p>It is shown when you click on the menu icon in the top left corner.</p>
        <p>When it is opened, it shifts the page content to the right.</p>
        <p>We use JavaScript to add a 25% left margin to the div element with id="main" when this happens. The value "25%" matches the width of the sidebar.</p>
    </div> -->

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
    <!-- <div class="container">
        <div class="center"> -->
            <!-- <input type="submit" value="Manage Products"><br><br>
            <input type="submit" value="Manage Orders"> -->
            <!-- <button class="manage"> Insert Products <img src="add-btn-img.png" style="width: 50px;"></button><br><br>
            <button class="manage"> Manage Orders <img src="edit-btn-img.png" style="width: 50px;"></button> <br><br>
            <button class="manage"> Manage Product Availibity <img src="edit-btn-img.png" style="width: 50px;"></button>
        </div>
    </div> -->
    <h2>Manage stocks</h2>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Product Quantity</th>
            <th scope="col">Update form</th>
            <th scope="col">Update</th>
          </tr>
        </thead>




<?php
    $sql="SELECT * FROM stock";
    $result=mysqli_query($link,$sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$row[0]."</td>";
            echo "<td>".$row[1]."</td>";
            echo "<form action='stock.php' method='POST'>
            <td>  <input type='number' name='quantity'></td>";
            echo "<td><input type='submit'   name='update' value='Update'></td>";
            echo "</form>";
            if(isset($_POST['update'])){
                $quantity=$_POST['quantity'];
                $sql="UPDATE stock SET Quantity='$quantity' WHERE Prod_ID='$row[0]'";
                $result=mysqli_query($link,$sql);
                if($result){
                    echo "<script>alert('Stock updated successfully')</script>";
                    echo "<script>window.location.href='stock.php'</script>";
                }
                else{
                    echo "<script>alert('Stock update failed')</script>";
                }
            }            

            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "No entries in stock";
    }
    ?>
    <footer class = "footers" align="center">
            Developed by Preeti Pallavi (20BCE1828) and Shubhangi Agrawal (20BCE1161)
        </footer>
    </body>
    </html>
    
