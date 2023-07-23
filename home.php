<?php
//include config
require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
    <head>
        <title> BAK-E-OFF </title>
        <link rel="stylesheet" href = "style/home.css">
        <link rel="stylesheet" href = "style/footer.css">
        <!-- INTERNAL STYLING-->
        <style>
            #heading1 {
                color:rgb(20, 32, 207); 
                text-align: center
            }
            #heading2 {
                color: rgb(36, 36, 151);
                text-align: left;
                font-size:200%
            }
            h5 {
                font-family:times new roman; 
                font-size: larger; 
                font-size: 26px; 
                font-weight: 800; 
                color: rgb(10, 6, 15);
            }</style>
    </head>
    <body>
        <div class="navbar" >
            <img id="logo" src="image/OurLogo2.png" alt = "BAK-E-OFF Logo">
            <br>
            <a href="#search">Search</a>
            <a href="contact.php">Contact Us</a>
            <a href="logout.php">Sign Out</a>
            <a href="bill.php">Cart</a>
            <a href="profile.php">My Profile</a>
        </div>
        <!-- ----------------------------------------------------------------------------------------------------- -->
        <div class="slideshow-container">
            <div class="mySlides fade">
              <div class="numbertext">1 / 3</div>
              <img src="image/sliding1.webp" style="width:158%">
              <div class="text">Caption Text</div>
            </div>
            
            <div class="mySlides fade">
              <div class="numbertext">2 / 3</div>
              <img src="image/sliding2.webp" style="width:158%">
              <div class="text">Caption Two</div>
            </div>
            
            <div class="mySlides fade">
              <div class="numbertext">3 / 3</div>
              <img src="image/sliding3.webp" style="width:158%">
              <div class="text">Caption Three</div>
            </div>
            
            </div>
            <br>
            
            <div style="text-align:center">
              <span class="dot"></span> 
              <span class="dot"></span> 
              <span class="dot"></span> 
            </div>
            <script>
                let slideIndex = 0;
            showSlides();
    
            function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
    }
            </script>
            
        <br><br>
        <h2 id = "heading2"> Here are the best-selling cookies!</h4>
        <table border="1" align="center">
            <tr>
            <th>Sl No.</th>
            <th>Cookie</th>
            <th>Date of manufacture</th>
            <th>Date of expiry</th>
            <th>Price</th>
            <th>Add to cart</th>
            </tr>
                <?php
                mysqli_select_db($link,"bakeoff");
                $sel='select * from products';
                $sq=mysqli_query($link,$sel);
                while ($row=mysqli_fetch_array($sq))
                {
            echo "<form name='cart_form' action='home.php' method='POST'>
            <tr>
            <td name='pid' value='$row[0]'>$row[0]
            <input type='hidden' name='pid' value=$row[0]>
            </td>
            <td class='cookie' name='pname'>$row[1]</td>
            <td class = 'price'>$row[2]</td>
            <td class = 'price'>$row[3]</td>
            <td class = 'price' name='Price'>$row[4]</td>
            <td style='font-size: large'><input type='submit' value='Add to cart' name='add' ></td>
           
            </tr>
            </form>";
                }
                $cid=$_SESSION["id"];
                
                if(isset($_POST['add'])){
                    $pid=$_POST['pid'];
                    $sql = "INSERT INTO cart VALUES ('$cid','$pid' );";
                    $retval =$link->query($sql);
                    if(! $retval ) {
                        // die('Could not enter data: ' . mysql_error());
                        echo "<script>alert('Go to ur profile n Add details to add items in cart')</script>";
                        }
                        
                }
                mysqli_close($link);
                ?>
        </table>
        <br><br>
        <div>
        <h5 > List of combo packs</h5>
        <!--definition list-->
        <dl style="font-family:times new roman; font-size: larger; font-size: 26px; font-weight: 800; color: rgb(114, 31, 248); ">
            <dt> ASSORTED COOKIES</dt>
            <dd> Box of assorted Cookies containing 5 different flavors of cookies like
            nutella cookies, choco chip cookies, cinnamon cookies, caramel cookies, red
            velvet cookies </dd>
            <br>
            <dt> MINI WAFFLE COOKIES</dt>
            <dd> Box of MINI WAFFLE cookies contains tiny WAFFLE cookies like of
            different flavors </dd>
        </dl>
        <br><br>
        <!-- inline styling-->
        <!-- pseudo element-->
        <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 30px; font-weight: 600; font-style:italic; color: rgb(124, 218, 124); text-align:center; padding:50px;"> 
            These handmade cookies are baked with love and warmth! Delivered to people all over the country within 5-7 business days. We would like to thank
        you for stepping in and making our day. Hope to see you again soon!</p>
        <br>
        <div class="navbar" >
            <img id="logo" src="image/OurLogo2.png" alt = "BAK-E-OFF Logo">
            <br>
            <a href="#search">Search</a>
            <a href="contact.php">Contact Us</a>
            <a href="logout.php">Sign Out</a>
            <a href="bill.php">Cart</a>
            <a href="profile.php">My Profile</a>
        </div>
        <!-- semantic element-->
        <footer class = "footers" align="center">
            Developed by Preeti Pallavi (20BCE1828) and Shubhangi Agrawal (20BCE1161)
        </footer>
    </body>
</html>