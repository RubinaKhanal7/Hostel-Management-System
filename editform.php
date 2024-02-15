<?php
$id=$_GET['id'];
session_start();
$user = $_SESSION['staffname'];
if (!isset($_SESSION['staffname']) ||(trim ($_SESSION['staffname']) == '')) {
    header('location:login.php');
    exit();
}
$Err = $bedError ='';

$conn=mysqli_connect('localhost','root','','project');
if(isset($_POST['submit'])){
	$no_of_bed=$_POST['no_of_bed'];
	$floor_number=$_POST['floor_number'];
	$price=$_POST['price'];
	$status=$_POST['status'];
	$id=$_POST['id'];

  if($price != 3000) {
      $Err = 'Price should be Rs.3000';
    }

  if($no_of_bed != 3) {
      $bedError = 'No. of bed should be 3';
    }
    else{

	$sql="UPDATE room set no_of_beds='$no_of_bed',floor_number='$floor_number',price='$price',status='$status' where room_id='$id'";
	mysqli_query($conn,$sql);
	header('location:manageroom.php');
	}
}
$sql1="select * from room where room_id = $id";
$res= mysqli_query($conn,$sql1);
$data=mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Room Details</title>
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
  width: 15%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
  margin-left:40%;
  margin-top: 10px;
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

.radio {
    width: 20px;
    position: relative;
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
        
    <a href="staffdashboard.php" class="acitve"><i class="fa fa-home" style="font-size:20px;"></i> HOME</a>
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


<h2 style="text-align:center;">Edit Room Details</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form  method="post">
        <div class="row">
          <div class="col-50">
            <label>ROOM ID</label>
            <input type="text" name="id" value="<?php echo $data['room_id']?>" readonly='readonly'>
            <label>NUMBER OF BEDS</label>
            <input type="text" name="no_of_bed" value="<?php echo $data['no_of_beds'];?>">  
          <span class="error"><?php echo $bedError;?> </span>  
          <br>
            <label>FLOOR NUMBER</label>
            <input type="text" name="floor_number" value="<?php echo $data['floor_number']?>">
             <label>PRICE</label>
            <input type="text" name="price" value="<?php echo $data['price']?>">
            <span class="error"><?php echo $Err;?> </span>  
          <br>
            <label for="state">STATUS</label>
          <input type="radio" name="status" class="radio" value="<?php echo $data['status']?>" checked='checked'><?php echo $data['status']?>
          </div>
          
        </div>
         <input type="submit" name="submit" value="Edit Room" class="btn">
      </form>
    </div>
  </div>
 </div>
  </div>
</body>
</html>
