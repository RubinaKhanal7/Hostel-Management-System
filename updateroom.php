<?php 
session_start();
$id=$_GET['id'];
$Error = $error = ""; 
$user = $_SESSION['staffname'];
if (!isset($_SESSION['staffname']) ||(trim ($_SESSION['staffname']) == '')) {
    header('location:login.php');
    exit();
}

$conn=mysqli_connect('localhost','root','','project');
if(isset($_POST['submit'])){
	$room_id=$_POST['room_id'];
  $select_bed=$_POST['select_bed'];

$queries= "SELECT * from detail where booking_number = '$id'";
$res= mysqli_query($conn,$queries);
$rows = mysqli_fetch_assoc($res);
$room=$rows['room_id'];

$sel = mysqli_query($conn, 'SELECT * FROM room ORDER BY room_id DESC LIMIT 1');
$sel_row = mysqli_fetch_array($sel);
$rooms=$sel_row['room_id'];
  if($room_id>$rooms || $room_id<=0){
        $error="This room id doesn't exits.";
  }

      elseif($room_id==$room){
            $Error="Enter another room id.";
}
else{


 $sql2="UPDATE detail SET room_id=$room_id where booking_number=$id";

        if(mysqli_query($conn,$sql2)){
          $sql= "UPDATE room set no_of_beds= no_of_beds - $select_bed where room_id=$room_id";
          mysqli_query($conn,$sql);

          $sqli="UPDATE shift set status='Updated' where status='Approved'";
          mysqli_query($conn,$sqli); 
          header('location:manageroom.php');
        }

      }
    }
      


$query= "SELECT * from detail where booking_number = '$id'";
$res_stud= mysqli_query($conn,$query);
$row_stud = mysqli_fetch_assoc($res_stud);
$student_id=$row_stud['student_id'];

$sqll= "SELECT * from shift where student_id=$student_id";
$result= mysqli_query($conn,$sqll);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<title>Book Room</title>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

	<style type="text/css">
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

/* Style the side navigation */
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

.row {
  display: flex;
  margin: 0 -20px;
  
}

.col-50 {
  flex: 55%;
}

.col-75 {
  width: 99%;
}

.col-50,
.col-75 {
  padding: 8px 16px 0px;
}

.container {
  background-color: #f2f2f2;
  padding: 15px 50px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  margin-left:30px;
}

input {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}


label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  border: none;
  width: 10%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
  margin-left:45%;
}

.btn:hover {
  background-color: #45a049;
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

.error {
  color: #FF0001;
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

	</style>
</head>
<body>
	
   <div class="sidenav">
                  
    <a href="staffdashboard.php" class="active"><i class="fa fa-home" style="font-size:20px;"></i> HOME</a>
    <a href="manageroom.php"><i class="fa fa-hotel" style="font-size:20px;"></i> ROOM</a>
    <a href="managestudent.php"><i class="fa fa-user" style="font-size:20px;"></i> STUDENT</a>
    <a href="managepayments.php"><i class="fa fa-money" style="font-size:20px;"></i> PAYMENT</a>
    <a href="staffmanagebook.php"><i class="fa fa-far fa-bell-slash" style="font-size:27px;"></i> BOOKED ROOM</a>
    <a href="service.php"><i class="fa fa-cogs" style="font-size:20px;"></i> SERVICES</a>
    <a href="manageshift.php"><i class="fa fa-exchange" style="font-size:20px;"></i> SHIFT Details</a>
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

 <h2 style="text-align: center;">Shift Rooms</h2>
  
	<form method="post">

<div class="row">
  <div class="col-75">
    <div class="container">
      <form  method="post">
        <div class="row">
          <div class="col-50">
            <?php
            if(mysqli_num_rows($result)>0){
              if($row['status']=="Updated"){
                echo "Already shifted room.";
              }

              elseif($row['status']=="Pending"){
                echo "Cannot shift until approved.";

              }

              elseif($row['status']=="Approved"){

            ?>
            <label>Booking Number</label>
            <input type="text" placeholder="Enter Booking Number" name="booking_number" readonly='readonly' value="<?php echo $row_stud['booking_number'] ?>">
            <label>Start Date</label>
    		<input type="date" id="startdate" placeholder="Enter Start Date" name="start_date" value="<?php echo $row_stud['start_date']?>" readonly="readonly">
           <label>End Date</label>
        <input type="text" id="date" placeholder="Enter End Date" name="end_date" value="<?php echo $row_stud['end_date']?>" readonly="readonly">
           <label>Student ID</label>
    			<input type="text" placeholder="Enter Student Id" name="student_id" value="<?php echo $row_stud['student_id']?>" readonly="readonly">
             <label>Name</label>
    		<input type="text" name="fullname" value = "<?php echo $row_stud['fullname']?>" readonly="readonly">
             <label>Floor Number</label> 
	 <input type="text" name="floor_number" value="<?php echo $row_stud['floor_number']?>" readonly="readonly">
            <label>Room ID</label> 
	 <input type="text" name="room_id" value="<?php echo $row_stud['room_id']?>" required>
   <span class="error"><?php echo $Error;?> </span>  <br>
   <span class="error"><?php echo $error;?> </span>  <br>
    <label>Number of Beds</label>
	<input type="text" name="no_of_bed" value="<?php echo $row_stud['no_of_beds'];?>" readonly="readonly">
	<label>Price</label> 
	<input type="text" name="price" value="<?php echo $row_stud['price']?>" readonly="readonly">
	<label>Select No. of Bed</label> 
	 <input type="text" name="select_bed" required value = "<?php echo $row_stud['select_bed']?>" readonly>
          </div>
          
        </div>
        <input type="submit" name="submit" value="Book"  class="btn" onclick="return confirm('Are you sure you wanna book room?')"> 
        <?php } 
         }
        else{
            echo "Room shift not requested.";
          }
        ?> 
        
      </form>
    </div>
  </div>
 </div>
</div>
</body>
</html>