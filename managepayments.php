<?php
session_start();
$user = $_SESSION['staffname'];
if (!isset($_SESSION['staffname']) ||(trim ($_SESSION['staffname']) == '')) {
    header('location:login.php');
    exit();
}

$conn=mysqli_connect('localhost','root','','project');
$sql="SELECT * FROM detail ORDER BY booking_number DESC";
$result=mysqli_query($conn,$sql);
$data=[];
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    array_unshift($data,$row);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Payments</title>
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
  padding: 45px 8px 8px 32px;
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
  margin-left: 250px;
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

.button {
  background-color: #f44336;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin-left: 80%;
}

</style>
</head>
<body>
   
<div class="sidenav">
        
    <a href="staffdashboard.php" class="acitve"><i class="fa fa-home" style="font-size:20px;"></i> HOME</a>
    <a href="manageroom.php"><i class="fa fa-hotel" style="font-size:20px;"></i> ROOM</a>
    <a href="managestudent.php"><i class="fa fa-user" style="font-size:20px;"></i> STUDENT</a>
    <a href="managepayments.php"><i class="fa fa-money" style="font-size:20px;"></i> PAYMENT</a>
    <a href="staffmanagebook.php"><i class="fa fa-far fa-bell-slash" style="font-size:20px;"></i> BOOKED ROOMS</a>
    <a href="service.php"><i class="fa fa-cogs" style="font-size:20px;"></i> SERVICES</a>
    <a href="manageshift.php"><i class="fa fa-exchange" style="font-size:20px;"></i> SHIFT DETAILS</a>
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
              <a href="logout.php"><button class="topbtn">LOGOUT</button></a>

        </div>
      </div>
    </div>
    <hr style="color">
<br><br>
    <h1 style="text-align: center;">PAYMENT DETAILS</h1><br>
  <div class="manage">
      <div class="ro">

  <center>
   <table border="1" style="width:100%" id="table">
        <thead>
            <tr>
                <th style="width:10%; padding-left:20px;">Booking Number</th>
                <th style="width:9%; padding-left:20px;">Booking Date</th>
                <th style="width:7%; padding-left:20px;">Student ID</th>       
                <th style="width:10%; padding-left:20px;">Fullname</th>
                <th style="width:8%; padding-left:20px;">Floor Number</th>
                <th style="width:10%; padding-left:20px;">Room ID</th>
                <th style="width:7%; padding-left:20px;">Selected Bed</th>
                <th style="width:10%; padding-left:20px;">Total Price</th> 
            </tr>
        </thead>

        <tbody>
            
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
                <td style='padding-left: 20px;'><?php echo $d['total_price']; ?><br>
                  <a href="staffpaymentdetail.php?id=<?php echo $d['booking_number']?>"><button>Check Details</button></a></td>
      </tr>
    </tbody>
    <?php } ?>
  </table>

</center>
</div>
</div>
</body>
</html>