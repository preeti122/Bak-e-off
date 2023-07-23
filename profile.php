<?php
// Initialize the session
session_start();
require_once "config.php";

$name=$_SESSION['username'];
if($name=="admin"){
    // echo "<script>alert('Only admins can access it');</script>";
    header("location:adminprofile.php");
}

$id=$_SESSION['id'];
// get customer details from database
$sql = "SELECT * FROM customerS WHERE cust_id='$id'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$fullname="";
$email="";
$phone="";
$address="";

if($row){
    $fullname=$row['Cust_Name'];
    $email=$row['mail_id'];
    $phone=$row['Phone'];
    $address=$row['Address'];
    
}


?>

 
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Customer profile </title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" src="style/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href = "style/home.css">
        <link rel="stylesheet" href = "style/footer.css">
        <link rel="stylesheet" href="style/style.css">
    <style>
          navbar a {
        float: left;
        margin-left: 160px;
        margin-right: 10px;
        display: block;
        text-align: center;
        padding: 18px 16px;
        text-decoration: none;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 22px;
    }
    .edit-btn-info {
        background-color: rgb(95, 68, 155);
        border: none;
        border-radius: 5px;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    navbar a:hover {
    background: #ddd;
    color: black;
    }
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<navbar>
    <img id="logo" src="image/OurLogo2.png" alt = "BAK-E-OFF Logo">
    <a href="#search">Search</a>
    <a href="contact.php">ABOUT US</a>
    <a href="bill.php">CART</a>
    <a href="logout.php">Logout</a>
    <a href="home.php">Home</a>
 </navbar>
<body>

        
<div class="container-fluid mt-5 pt-3" style="min-height: 100%;  ">
        <div class="main-body" >
          <div>
            <h3 align="left" style="margin-right:80%"> Hi <?php echo "$name"; ?>! </h3>
        </div>
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card" style="height:22.3rem;">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <img src="https://freesvg.org/img/abstract-user-flat-4.png" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">

                          <h4><br><br> <?php 
                          echo "$name"
                           ?> </h4>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div class="col-md-8">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?php
                            if($fullname==""){
                                echo "Not updated";
                            }
                            else{
                                echo "$fullname";
                            }
                            ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?php
                            if($email==""){
                                echo "Not updated";
                            }
                            else{
                                echo "$email";
                            }
                              ?>
                        </div>
                      </div>
                      <hr>
            
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Mobile</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?php 
                            if($phone==""){
                                echo "Not updated";
                            }
                            else{
                                echo "$phone";
                            }
                            ?>
                        </div>
                      </div>
                      <hr>
                       <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?php
                            if($address==""){
                                echo "Not updated";
                            }
                            else{
                                echo "$address";
                            }
                            ?>
                            
                        </div>
                      </div>
                      <hr> 
                       <!-- add details button-->
                       <div class="row">
                           <div class="col-sm-12">
                               <a class="edit-btn-info" target="__blank" href="add_details.php">Add details</a>
                            </div>
                        </div>
                        <br>
                        <div class="btn-group">
                          <!-- reset password button-->
                          <div class="row">
                              <div class="col-sm-12">
                                  <a class="edit-btn-info" target="__blank" href="reset-password.php">Reset your password</a>
                              </div>
                          </div>
                          
                        </div>
                    </div>
                  </div>

    
                </div>
              </div>
            <br><br>
            <h1>List of Orders</h1>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">S. No.</th>
                  <th scope="col">Order Date</th>
                  <th scope="col">Order Address</th>
                  <th scope="col">Order Total </th>
                  <th scope="col">Order Status</th>
                </tr>
              </thead>
              <?php
                mysqli_select_db($link,"bakeoff");
                $id=$_SESSION["id"];
                $sel="select * from orders where Cust_ID='$id'";
                $i=1;
                $sq=mysqli_query($link,$sel);
                // print_r($sq);
                while ($row=mysqli_fetch_array($sq))
                {
            echo "<tr>
            
            <td>$i</td>
            <td class='price' >$row[1]</td>
            <td class = 'price'>$row[2]</td>
            <td class = 'price'>Rs $row[4]</td>
            <td class = 'cookie'>$row[3]</td>

           
            </tr>";
            $i++;
                }
                mysqli_close($link);
                ?>
            </table>
            </div>

            
        </div>
        <!-- <div>    {% include 'Donate/Footer.html' %} -->
        </div>
        <!-- <script> w3.includeHTML();</script> -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <footer class = "footers" align="center">
            Developed by Preeti Pallavi (20BCE1828) and Shubhangi Agrawal (20BCE1161)
        </footer>
  </body>






<!-- 
    <p>
        <a href="add_details.php" class="btn btn-primary">Add details</a><br><br>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
   
</body>
</html>
