<?php
session_start();
$user = $_SESSION['staffname'];
if (!isset($_SESSION['staffname']) ||(trim ($_SESSION['staffname']) == '')) {
    header('location:login.php');
    exit();
}
$conn=mysqli_connect('localhost','root','','project');

?>

<!DOCTYPE html>
<html>
<head>
  
  <title>ADMIN Dashboard</title>
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
  background-color:#f1f1f1;
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
    <a href="staffmanagebook.php"><i class="fa fa-far fa-bell-slash" style="font-size:20px;"></i> BOOKED ROOM</a>
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
    <hr>
<br><br>
    <h1 style="text-align: center;">ADMIN DASHBOARD</h1>

     <div class="row">
  <div class="column" >
    <div class="card">
      <h3>Total No. of Students</h3>
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
      <h3>Total Service Provided</h3>
      <p>
          <?php
           $count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM service")); 
           echo $count[0]; 
  ?>

      </p>
    </div>
  </div>
  <div class="column">
    <div class="card">
      <h3>Total No. of Rooms</h3>
        <p>
          <?php
           $count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM room")); 
           echo $count[0]; 
  ?>

      </p>
    </div><br>
  </div>
  
  <div class="column" >
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
      <h3>Total Payments Made</h3>
      <p>
          <?php
           $count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM payments")); 
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

</div>
</body>
</html>