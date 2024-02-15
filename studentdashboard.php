<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
  die("Connection Failed");
}

$user = $_SESSION['name'];
if (!isset($_SESSION['name']) ||(trim ($_SESSION['name']) == '')) {
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Student Dashboard</title>
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
  background-color:  black;
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
  margin-left:50px;
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
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
  margin-left: 70px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
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

.detail{
  margin-top: 20px;
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
  <div>
    <h1 style="text-align: center;">STUDENT DASHBOARD</h1>
  </div><br><br>
  <div class="row">
  <div class="column">
    <div class="card">
      <h3> Total Students</h3>
      <p>
          <?php
           $count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM student")); 
           echo $count[0]; 
  ?>

      </p>
    </div>
  </div>

 <div class="column">
    <div class="card">
      <h3>Total Rooms</h3>
      <p>
               <?php
           $count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM room")); 
           echo $count[0]; 
  ?>
      </p>

    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <h3>Additional Services</h3>
      <p>
                   <?php
           $count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM service")); 
           echo $count[0]; 
  ?>
      </p>
    </div>
  </div><br>
</div>
<div class="detail">
<div class="column">
    <div class="card">
      <h3>Total Booked Rooms</h3>
      <p>
               <?php
           $count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM detail")); 
           echo $count[0]; 
  ?>
      </p>

    </div>
  </div>

  <div class="column">
    <div class="card">
      <h3>Total Booked Services</h3>
      <p>
               <?php
           $count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM servicebook")); 
           echo $count[0]; 
  ?>
      </p>

    </div>
  </div>

  <div class="column">
    <div class="card">
      <h3>Shifts</h3>
      <p>
               <?php
           $count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM shift")); 
           echo $count[0]; 
  ?>
      </p>

    </div>
  </div>

  </div>
    

</body>
</html>