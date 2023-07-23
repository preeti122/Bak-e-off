<?php
session_start();
    require_once "config.php";
    // if(!isset($_SESSION['admin'])){
    //     header("location:adminlogin.php");
    // }
    

?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href = "style/home.css">
        <link rel="stylesheet" href = "style/footer.css">
        <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/netsc.css">
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

</head>
<body>


<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large"
    onclick="w3_close()">Close &times;</button>
    <!-- <a href="#" class="w3-bar-item w3-button">Link 1</a>
    <a href="#" class="w3-bar-item w3-button">Link 2</a> -->
    <a href="adminprofile.php" class="w3-bar-item w3-button">Go Home</a>
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
    <h2>List of Orders</h2>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Order Date</th>
            <th scope="col">Customer ID</th>
            <th scope="col">Order Address</th>
            <th scope="col">Order Total </th>
            <th scope="col">Order Status</th>
          </tr>
        </thead>





<!-- <div class="orders">
        <h2 align="left">Orders</h2>
        <table>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Customer ID</th>
            <th>Order Address</th>
            <th>Order Total</th>
            <th>Order Status</th>
        </tr> -->
        
        <?php
                mysqli_select_db($link,"bakeoff");
                $id=$_SESSION["id"];
                $sel="select * from orders;";
                $i=1;
                $sq=mysqli_query($link,$sel);
                // print_r($sq);

                while ($row=mysqli_fetch_array($sq))
                {
            echo "<form method='post' action='orders.php'><tr>
            <input type='hidden' name='id' value='$row[0]'>
            <td>$row[0]</td>
            <td class='price' >$row[1]</td>
            <td>$row[5]</td>
            <td class = 'price'>$row[2]</td>
            <td class = 'price'>Rs $row[4]</td>
            <td>
            <select name='statuss'>
            <option selected>$row[3]</option>
            <option value='Dispatched'>Dispatched</option>
            <option value='Delivered'>Delivered</option>
            </select>
            </td>
            <td>
           <button name='update' type='submit' class='btn btn-primary'>Update</button>
            </tr>    </form>";
            // <td class = 'cookie'>$row[3]</td>

            $i++;
                    if(isset($_POST['update']))
                    {
                        $status=$_POST['statuss'];
                        $id=$_POST['id'];
                        $sql="UPDATE orders SET Status='$status' WHERE Order_ID='$id'";
                        $result=mysqli_query($link,$sql);
                        if($result)
                        {
                            echo "<script>alert('Status Updated')</script>";
                            echo "<script>window.open('orders.php','_self')</script>";
                        }
                        else
                        {
                            echo "<script>alert('Status Not Updated')</script>";
                            echo "<script>window.open('orders.php','_self')</script>";
                        }
                    }
                }
                mysqli_close($link);
                ?>
            
                </table>
    </div>
            </body>
            <footer class = "footers" align="center">
            Developed by Preeti Pallavi (20BCE1828) and Shubhangi Agrawal (20BCE1161)
        </footer>
            </html>