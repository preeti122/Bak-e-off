<?php
session_start();
require_once "config.php";
// $conn = mysqli_connect('localhost','root','');
if(! $link ) {
    die('Could not connect: ' . mysql_error());
}
mysqli_select_db($link,"bakeoff");
$id=$_SESSION["id"];
$query = "SELECT * FROM customers WHERE cust_id = '$id'";
$result = $link->query($query);
// while($row = mysqli_fetch_array($result))
// {
//     echo "<table><tr>
//             <td>$row[0]</td>
//             <td>$row[1]</td>
//             <td>$row[2]</td>
//             <td>$row[3]</td>
//             <td>$row[4]</td>
//          </tr>
//          </table>";
// }
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Details already added!');
        window.location.href='profile.php';</script>";
        exit;
    }
    // } else {
    //     header("location: add_details.php");
    //     exit;
    // }
} else {
    //header("location: add_details.php");
    echo 'Error: ' . mysqli_error();
}
?>
<!DOCTYPE html>
    <head>
        <TITLE>My profile</TITLE>
        <link rel="stylesheet" href = "style/signup.css">
        <link rel="stylesheet" href = "style/footer.css">
    </head>
    <body>
        <div id="form">
            <form align="center" class ="signup-form" name="Form1" action="add_details.php"  method="POST">
                <h2 class ="title"> Welcome to add details page!</h2>
                <p class = "join" >Kindly enter your details to update your account and stay connected to us.</p>
                <input type="text" placeholder="First Name" name="fname" required>
                <input type="text" placeholder="Last Name" name="lname" required>
                <input type="number" placeholder="Phone number" name="mobno" required>
                <!-- giving type as text instead of email to check for regex -->
                <input type="text" placeholder="Email address" name="email" required>
                <input type="text" placeholder="Address" name="addr" required>
                <!-- <input type="password" placeholder="Password" name="pwd" minlength="8" maxlength="16" required> -->
                <br>
                <!-- <p id="id1"> Thank you for registering!</p> -->
                <br>
                <p class="terms" >By submitting this form, you agree to our <a href="" target="_blank">Terms of Use</a></p>
                <br>
                <!-- <button  onclick="displayForm()"> Register to create your account</button> -->
                <input type="submit" value="Add details" name="add">
            </form>
        </div>
            
</body>
<?php
                    
                    if(isset($_POST['add'])) {
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $name = $fname.$lname;
                        $email = $_POST['email'];
                        $phone = $_POST['mobno'];
                        $addr = $_POST['addr'];
                        
                        // auto increment customer id
                       
                    $sql = "INSERT INTO customers (Cust_ID,Cust_name, mail_id,Phone,Address) VALUES ('$id', '$name','$email','$phone','$addr')";
                   
                    $retval = mysqli_query($link,$sql,);
                    if(! $retval ) {
                    die('Could not enter data: ' . mysql_error());
                    }
                    else
                    echo "Entered data successfully\n";
                    $res = mysqli_query($link,'select * from customers');
                    echo "<table border=1>
                          <tr>
                            <td>Cust No</td>
                            <td>Customer Name</td>
                            <td>Mail id</td>
                            <td>Phone No</td>
                            <td>Address</td>
                         </tr>";
                    while($row = mysqli_fetch_array($res))
                    {
                        echo "<tr>
                                <td>$row[0]</td>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                             </tr>";
                    }
                        echo "</table>";
                    mysqli_close($link);
                    echo "<script>alert('Details added successfully!');
                     window.location.href='profile.php';</script>";
                }
                
                
    ?>

</html>