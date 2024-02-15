<?php 
session_start();
$id=$_GET['id'];
// echo $id; 
$Err = ""; 
$user = $_SESSION['name'];
if (!isset($_SESSION['name']) ||(trim ($_SESSION['name']) == '')) {
    header('location:login.php');
    exit();
}

$conn=mysqli_connect('localhost','root','','project');

$query= "SELECT * from student where username = '$user'";
$res_stud= mysqli_query($conn,$query);
$row_stud = mysqli_fetch_assoc($res_stud);
$fullname = $row_stud['fullname'];

if(isset($_POST['submit'])){
  $start_date=$_POST['start_date'];
  $end_date=$_POST['end_date'];
  $student_id=$_POST['student_id'];
  $fullname=$_POST['fullname'];
  $room_id=$_POST['room_id'];
  $floor_number=$_POST['floor_number'];
  $no_of_bed=$_POST['no_of_bed'];
  $select_bed=$_POST['select_bed'];
  $price=$_POST['price'];
  $booking_number=$_POST['booking_number'];

if(($select_bed > $no_of_bed) || ($select_bed<=0)) { 
            $Err = "Number of beds did not match";   
 } 
  
else{
      $sql2="INSERT INTO detail(
            booking_number,start_date,end_date,student_id,fullname,room_id,floor_number,no_of_beds,select_bed,price)
            VALUES('$booking_number','$start_date','$end_date','$student_id', '$fullname','$room_id','$floor_number','$no_of_bed','$select_bed','$price')";
            if(mysqli_query($conn,$sql2)){
                $sql3="UPDATE room SET no_of_beds=no_of_beds - $select_bed where room_id=$id";
                 mysqli_query($conn,$sql3); 
                $sql5="UPDATE detail SET total_price=$select_bed * $price where booking_number=$booking_number";
                 mysqli_query($conn,$sql5);
            }

            if(mysqli_affected_rows($conn)==1){
            header('location:managebookroom.php');
  }


}


}

$sql1="select * from room where room_id = $id";
$res= mysqli_query($conn,$sql1);
$data=mysqli_fetch_assoc($res);

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

 <h2 style="text-align: center;">Book Available Rooms</h2>
  
  <form method="post">

<div class="row">
  <div class="col-75">
    <div class="container">
      <form  method="post">
        <div class="row">
          <div class="col-50">
            <?php  
              $sel = mysqli_query($conn, 'SELECT * FROM detail ORDER BY booking_number DESC LIMIT 1');
              $sel_row = mysqli_fetch_array($sel);
              if (mysqli_num_rows($sel) > 0){
                $var = $sel_row['booking_number'] + 1;
              }

              else {
                $var = 1;
              }
            ?>
            <label>Booking Number</label>
            <input type="text" placeholder="Enter Booking Number" name="booking_number" required readonly='readonly' value="<?php echo $var ?>">
            <label>Start Date</label>
        <input type="date" id="startdate" placeholder="Enter Start Date" name="start_date" min="<?php echo (new DateTime())->format('Y-m-d'); ?>" required value = <?php echo $_POST['start_date']??''; ?>>
           <label>End Date
           <button onclick="myFunction()" style="background-color:lightgray;">Click Here to Add End Date</button></label>
        <input type="text" id="date" placeholder="Enter End Date" name="end_date" required onkeydown="return false;" style="caret-color: transparent !important;" value = <?php echo $_POST['end_date']??''; ?>>
           <label>Student ID</label>
          <input type="text" placeholder="Enter Student Id" name="student_id" value="<?php echo $row_stud['student_id']?>" readonly="readonly">
             <label>Name</label>
        <input type="text" name="fullname" value = "<?php echo $row_stud['fullname']?>" readonly="readonly">
             <label>Floor Number</label> 
   <input type="text" name="floor_number" value="<?php echo $data['floor_number']?>" readonly="readonly">
            <label>Room Id</label> 
   <input type="text" name="room_id" value="<?php echo $data['room_id']?>" readonly="readonly">
            <label>Number of Beds</label>
  <input type="text" name="no_of_bed" value="<?php echo $data['no_of_beds'];?>" readonly="readonly">
  <label>Price</label> 
  <input type="text" name="price" value="<?php echo $data['price']?>" readonly="readonly">
  <label>Select No. of Bed</label> 
  <input type="text" name="select_bed" required >
   <span class="error"><?php echo $Err;?> </span>  
    <br>
          </div>
          
        </div>
        <input type="submit" name="submit" value="Book"  class="btn" onclick="return confirm('Are you sure you wanna book room?')">  
      </form>
    </div>
  </div>
 </div>
</div>
<script>
function myFunction() {
  var enddate = document.getElementById("date");
  var startdate = document.getElementById("startdate");
  var nDate = new Date(startdate.value);
  enddate.value = (nDate.getFullYear() + 1) + "-" + (nDate.getMonth() + 1) + "-" + nDate.getDate();
}
</script>
</body>
</html>