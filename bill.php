<!-- This code is contributed by Shubhangi Agrawal 20BCE1161 -->
<?php
    // Include config file
    session_start();
    require_once "config.php";
?>
<!DOCTYPE html>
<head>
    <title>BakeOff</title>
    <link rel="stylesheet" href="style/cart.css">
    <link rel="stylesheet" src="style/footer.css">
    <style>
        hr{
            width: 50%;
        }
    </style>
</head>
<body align="center">
    <div align="center">
    <form name="cartform" action="bill.php" method="POST">
    <table>
    <?php
                mysqli_select_db($link,"bakeoff");
                $id=$_SESSION["id"];
                $sel="select * from cart where cust_id=$id;";
                // $sel="select * from cart";
                $sq=$link->query($sel);
                // $sq=mysqli_query($link,$sel);
                // echo "$sq->num_rows";
                $total=0;
                $products_ordered=array();
                $i=0;
                while ($row=mysqli_fetch_array($sq))
                {

                    $sel="select * from products where prod_id=$row[1];";
                    $sq_p=$link->query($sel);

                    while ($row_p=mysqli_fetch_array($sq_p)){
                        $total+=($row_p[4]);
                        $products_ordered[$i]=$row_p[0];
                        $i++;
                        echo "<tr>
                        <td><img src='https://cdn.shopify.com/s/files/1/0464/2045/9669/products/ChocofilledMilkchoco2_600x.png?v=1632212333'  width='100' height='100'></td>
                        <input type='hidden' name='price' value='$row_p[4]'>
                        
                        <td>$row_p[1]</td>
                        <td>₹$row_p[4]</td>
                        <td><input type='hidden' name='pid' value='$row_p[0]'></td>
                        <td><input type='submit' name='remove' value='Remove'></td>
                        </tr>";
                    }
            
                }
                if(isset($_POST['remove']))
                {
                    $pid=$_POST['pid'];
                    //delete first entry from cart where prod_id=$pid

                    $sel="delete from cart where prod_id=$pid LIMIT 1 ;";
                    $sq=$link->query($sel);
                    // echo "<script>alert('Deleted from cart!')</script>";
                    header("location:bill.php");
                }
              //  print_r($products_ordered);

                //
                ?>
    </table>
    <hr class="line"  align="center"   style="width:50%">
        <table>
            <tr>
                <td ><input type="text" style="width:280px;" placeholder="Discount code"></td>
                <td><button style="width: 90px;" value="">Apply</button></td>
            </tr>
        </table>
    <hr class="line"  align="center"  style="width:50%" >
    <table id="">
        <tr>
            <td> Subtotal</td>
            <td style="margin-left: 100px; padding-left: 400px;"> ₹ <?php echo"$total" ?></td>
        </tr>
        <tr style="margin-left: 320px;">
            <td>Shipping</td>
            <td style="color: grey; padding-left: 280px;">₹50</td>
        </tr>
    </table>
    <hr class="line"  align="center"  style="width:50%">
    <table>
        <tr style="padding-left: 970px;">
            <td >
                <dl>
                    <dt>
                        Total
                    </dt><br>
                    <dd style="color:grey;">(Including taxes)</dd>
                </dl>
            </td>
            <td style=" padding-left: 300px;">
                <?php
            if($total==0){
                echo "0";
            }
            else{
                echo $total+50;
            }
            
            ?>
            </td>
        </tr>
        <tr>
            
        <th>Enter delivery information</th>
        <tr>
            
            <td ><input type="text"  placeholder="Phone number"></td>

        </tr>
        <tr>
            
        <td><input type="text"  name="area" placeholder="Locality"></td>        
            </tr>
        <tr>
            <td><input placeholder="Country" list="country" name="country">
            <datalist id="country">
                <option value="India">
                    <option value="Spain">
                        <option value="Italy">
                            <option value="China">
                                </datalist>
                            </td>
                        </tr>
     <tr>
     <td><input type="submit" style="width: 90px;" value="Place Order" name="add"></td>
        </tr>
 
    </table>
        </form>
        <?php

if(isset($_POST['add'])){
    $area=$_POST['area'];
    $country=$_POST['country'];
    $addr=$_POST['area'].",".$_POST['country'];
    // $phone=$_POST['phone'];
    $total=$total+50;
    $today=date("Y-m-d");
    echo $today;
    // $sql="insert into orders values ($total,'$area','$country','$phone');";
    $sql="INSERT INTO orders(DOO,Address,Status,Total_Cost,Cust_ID) VALUES ('$today', '$addr', 'OrderPlaced','$total', '$id');";
    $retval=mysqli_query($link,$sql);
    // if(!$retval){
    //     die('Could not enter data obp: ' . mysql_error());
    // }
        $sql="select max(order_id) from orders;";
        $sq=$link->query($sql);
            $row=mysqli_fetch_array($sq);
            $order_id=$row[0];
            foreach($products_ordered as $prod_id){
                $sql="insert into order_by_prod values($order_id,$prod_id);";
                $retval=mysqli_query($link,$sql);
                // if(!$retval){
                //     die('Could not enter data obp: ' . mysql_error());
                // }
            }
            $sql="delete from cart where cust_id=$id;";
            $link->query($sql);
            echo "<script>alert('Order placed successfully!')</script>";
            echo "<script>window.location.href='home.php'</script>";

         }
        ?>
    <!-- <div align="center">
        <video   autoplay controls>
            <source src="thankyou.mp4" type="video/mp4">
   
        </video>
    </div>
    -->
        </div>
</body>
<footer class = "footers" align="center">
            Developed by Preeti Pallavi (20BCE1828) and Shubhangi Agrawal (20BCE1161)
        </footer>
</html>
