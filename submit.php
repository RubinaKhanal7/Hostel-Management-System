<?php
require("config.php");

session_start();

$user = $_SESSION['name'];
if (!isset($_SESSION['name']) ||(trim ($_SESSION['name']) == '')) {
    header('location:login.php');
    exit();
}


$query= "SELECT fullname from student where username = '$user'";
$res_stud= mysqli_query($conn,$query);
$row_stud = mysqli_fetch_assoc($res_stud);
$fullname = $row_stud['fullname'];

$sql="SELECT * FROM detail where fullname = '$fullname' ORDER BY booking_number DESC";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$total_price = $row['total_price'];


\Stripe\Stripe::setVerifySslCerts(false);

$token= $_POST['stripeToken'];
$fullname=$_POST['fullname'];
$room_id=$_POST['room_id'];
$payment_date=$_POST['payment_date'];
$price=$_POST['price'];
$payment_id=$_POST['payment_id'];

$data=\Stripe\Charge::create(array(
	"amount"=>$total_price,
	"currency"=>"usd",
	"description"=>"MCPS Desc",
	"source"=>$token,

));
// Process the charge response
if ($data->status == 'succeeded') {
  // Payment successful

  // Prepare and execute the SQL statement
  $stmt = $conn->prepare("INSERT INTO payments (payment_id,fullname,room_id,payment_date,price) VALUES (?,?,?,?,?)");
  $stmt->bind_param("dsdsd", $payment_id,$fullname,$room_id,$payment_date,$price);
  $stmt->execute();

  // Close the statement and connection
  $stmt->close();
  $conn->close();

  echo "Payment successful! Payment data inserted into the database.";
} else {
  // Payment failed
  echo "Payment failed: " . $data->failure_message;
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>submit</title>
 </head>
 <body>
 <a href="studentdashboard.php"><button style="padding: 5px 10px; background-color: #E67E22;border: none;color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
 cursor: pointer;">GO TO DASHBOARD</button></a>
 </body>
 </html>