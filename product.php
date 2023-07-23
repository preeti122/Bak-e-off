<!-- NAME - PREETI PALLAVI 20BCE1828 and Shubhangi Agrawal 20BCE1161-->
<!-- BAKOFF is an e-commerce website that delivers hand made baked goods to
people across the country--> 
<?php
require_once "config.php";
session_start();
$name=$_SESSION['username'];
if($name!="admin"){
    echo "<script>alert('Only admins can access it');</script>";
    header("location:adminlogin.php");
}
?>
<!DOCTYPE html>
<head>
        <title> Insert Products </title>
        <link rel="stylesheet" href = "style/signup.css">
        <link rel="stylesheet" href = "style/footer.css">
        <link rel="stylesheet" href="style/netsc.css">
  

    </head>
    <body>

    <div id="form">
        <form action="product.php" method="post" align="center" class ="signup-form">
        <h2 class ="title"> Enter details of the product you wish to insert.</h2>
            <table>
                <tr>
                    <td>Product Name</td>
                    <td><input type="text" name="product_name" required></td>
                </tr>
                <tr>
                    <td>Date of Manufacture</td>
                    <td><input type="date" name="manf_date" required></td>
                </tr>
                <tr>
                    <td>Date of Expiry</td>
                    <td><input type="date" name="exp_date" required></td>
                </tr>
                <tr>
                    <td>Product Price</td>
                    <td><input type="number" name="product_price" required></td>
                </tr>
                <tr>
                    <td>Product Description</td>
                    <td><input type="text" name="product_description" required></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><input type="submit" name="insert_product" value="Insert Product"></td>
                </tr>
            </table>
        </form>
</div>
        <?php
        

        //insert
        if(isset($_POST['insert_product'])){
            $product_name=$_POST['product_name'];
            $manf_date=$_POST['manf_date'];
            $exp_date=$_POST['exp_date'];
            $product_price=$_POST['product_price'];
            if(isset($_POST['product_description'])){
                $product_description=$_POST['product_description'];
            }
            else{
                $product_description=" ";
            }
            $sql="INSERT INTO products VALUES (NULL,'$product_name','$manf_date','$exp_date','$product_price','$product_description')";
            if(mysqli_query($link,$sql)){
                echo "<script>alert('Product inserted successfully');</script>;";
            }
            else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
        ?>
    </body>
    <footer class = "footers" align="center">
        Developed by Preeti Pallavi (20BCE1828) and Shubhangi Agrawal (20BCE1161)
    </footer>
</html>