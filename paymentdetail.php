
<?php
  require("config.php");
 session_start();
$user = $_SESSION['name'];
if (!isset($_SESSION['name']) ||(trim ($_SESSION['name']) == '')) {
    header('location:login.php');
    exit();
}
$conn=mysqli_connect('localhost','root','','project');

$query= "SELECT fullname from student where username = '$user'";
$res_stud= mysqli_query($conn,$query);
$row_stud = mysqli_fetch_assoc($res_stud);
$fullname = $row_stud['fullname'];

$sql="SELECT * FROM detail where fullname = '$fullname' ORDER BY booking_number DESC";
$result=mysqli_query($conn,$sql);
$data=[];
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    array_unshift($data,$row);
  $select_bed = $row['select_bed'];
   $price = $row['price'];
    }

}
else{
  $select_bed = 0;
  $price = 0;
}

$sql2="SELECT sum(price) as totals FROM servicebook where fullname = '$fullname'";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result2);

$sql3="SELECT * FROM payments where fullname = '$fullname'";
$result3 = mysqli_query($conn,$sql3);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Make Payment</title>
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <style type="text/css">
    
        
    * {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
}


/* Side navigation links */
.sidenav a {
  color: white;
 padding: 50px 8px 8px 32px;
  text-decoration: none;
  display: block;

}

/* Change color on hover */
.sidenav a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the content */
.content {
  margin-left: 200px;
  padding-left: 20px;
  padding-top: 10px;
  padding-right: 30px;
}

.logout{
  margin-left: 50px;
  padding: 0;
  display: inline;
}

.topbtn {
  background-color: #E67E22;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.topbtn:hover {
  background-color: #F08080;
}

.manage{
    margin-top: 30px;
    }

#table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#table td, #table th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
}

#table th {
  padding-top: 12px;
  padding-bottom: 12px;
  background-color:#6495ED;
  color: white;
  text-align: center;
}

.columns {
  float: left;
  width: 50%;
  display: flex;
  
}

/* Clearfix (clear floats) */
.ro::after {
  content: "";
  clear: both;
  display: table;
}

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 230px; /* Location of the box */
  padding-left: 100px; 
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  color: blue;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
</head>
<body>
  <div class="sidenav">
       
      <a href="studentdashboard.php"><i class="fa fa-home" style="font-size:20px;"></i> HOME</a>
      <a href="addroom.php"><i class="fa fa-hotel" style="font-size:20px;"></i> BOOK ROOM</a>
      <a href="bookservice.php"><i class="fa fa-cogs" style="font-size:20px;"></i> SERVICES</a>
      <a href="paymentdetail.php"><i class="fa fa-money" style="font-size:20px;"></i> MAKE PAYMENT</a>
      <a href="managepayment.php"><i class="fa fa-money" style="font-size:20px;"></i> PAYMENT DETAIL</a>
      <a href="managebookroom.php"><i class="fa fa-bell-slash" style="font-size:20px;"></i> BOOKED ROOM</a>
      <a href="shift.php"><i class="fa fa-exchange" style="font-size:20px;"></i> SHIFT</a>

    </div>
    <div class="content">
        <div class="ro">
        <div class="columns">
           <img src="img/logo.jpg" width="100px">
          </h1>
          </div>

        <div class="columns">
          <div class="logout">               
            <input type="text" placeholder="Username" name="username" value = "<?php echo $user;?>" style="height: 45px; margin-top: 5px;text-align: center;width: 100px;" disabled>
              <a href="update.php"><button class="topbtn"><i class="fa fa-user" style="color:white; font-size:18px;"></i> Update Profile</button></a>
              <a href="logout.php"><button class="topbtn">LOGOUT</button></a>

        </div>
      </div>
    </div>
    <hr style="color">
<br><br>
    <h1 style="text-align: center;"> Make Payment</h1>
  <div class="manage">
  <center>
   <table style="width:100%" id="table">
        <thead>
            <tr>
                <th style="width:10%; padding-left:20px;">Booking Number</th>
                <th style="width:9%; padding-left:20px;">Booking Date</th>
                <th style="width:7%; padding-left:20px;">Student ID</th>       
                <th style="width:10%; padding-left:20px;">Fullname</th>
                <th style="width:10%; padding-left:20px;">Floor Number</th>
                <th style="width:10%; padding-left:20px;">Room ID</th>
                <th style="width:7%; padding-left:20px;">Selected Bed</th> 
                <th style="width:10%; padding-left:20px;">Total Room Price</th>     
            </tr>
        </thead>
        <?php 
        foreach($data as $d){
        ?>
        <tbody>
            <tr>
                <td style='padding-left: 45px;'><?php echo $d['booking_number']; ?></td>
                <td style='padding-left: 5px;'><?php echo $d['start_date']; ?></td>
                <td style='padding-left: 4px;'><?php echo $d['student_id']; ?></td>
                <td style='padding-left: 20px;'><?php echo $d['fullname']; ?></td>
                <td style='padding-left: 30px;'><?php echo $d['floor_number']; ?></td>
                <td style='padding-left: 20px;'><?php echo $d['room_id']; ?></td>
                <td style='padding-left: 20px;'><?php echo $d['select_bed']; ?></td>
                <td style='padding-left: 20px;'><?php echo $d['select_bed'] * $d['price']; ?></td>
      </tr>
    </tbody>
    <?php } ?>
  </table><br><br>
     <table style="width:50%;margin-left: 50%;" id="table">
      <thead>
            <tr>
                <th style="width:10%; padding-left:20px;background-color: white;color: black;">Service Type</th>
                <th style="width:3%;padding-left:20px;background-color: white;color: black;">Service Price</th> 
            </tr>
        </thead>
        <?php 
        $sql1="SELECT * FROM servicebook where fullname = '$fullname' ORDER BY service_number DESC";
        $result1=mysqli_query($conn,$sql1);
        $data1=[];
        if(mysqli_num_rows($result1) > 0){
          while($row1 = mysqli_fetch_assoc($result1)){
          array_unshift($data1,$row1);
          }
        foreach($data1 as $d1){
        ?>
        <tbody>
            <tr>
                <td style='padding-left: 45px;'><?php echo $d1['service_type']; ?></td>
                <td style='padding-left: 5px;'><?php echo $d1['price']; ?></td>
            </tr>
    </tbody>
    <?php }} else { ?>
      <tbody>
            <tr>
                <td style='padding-left: 45px;'><?php echo 'None'; ?></td>
                <td style='padding-left: 5px;'><?php echo 0; ?></td>
            </tr>
    </tbody>
  <?php } ?>
  </table><br>
  <table style="width:50%;margin-left: 50%;" id='table'>
     <tbody>
    <tr>
      <td><b>Total amount to be paid</b></td>
      <td style="width:30%;"><b><?php echo $select_bed * $price + $row2['totals'] ?></b></td>
    </tr>
    </tbody>
</table>

 <?php 
      if(mysqli_num_rows($result3) > 0){
     echo  '<button style="padding: 5px 10px; margin-left:900px; width:100px;">PAID</button>';
   }
   else{
   echo '<a href="editpayment.php?id=' . $d['booking_number'] . '"><button style="padding: 5px 10px; margin-left:900px; width:100px;">PAY</button></a>';
 }
 ?>
</center>
</div>
</div>
</body>
</html>