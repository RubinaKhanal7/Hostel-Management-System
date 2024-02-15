<?php
session_start();
$user = $_SESSION['staffname'];
if (!isset($_SESSION['staffname']) ||(trim ($_SESSION['staffname']) == '')) {
    header('location:login.php');
    exit();
}
$Err= '';
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
	die("Connection Failed");
}
 
if(isset($_POST['submit'])){
      $service_id=$_POST['service_id'];
      $service_type=$_POST['service_type'];
      $price=$_POST['price'];
    if(empty($service_id) || empty($service_type) || empty($price)){
      echo "Don't leave any empty field"; 
    }

    if(($price!=5000)) {  
            $Err="Price of services should be Rs 5000";  
          } 

    else{
        $conn=mysqli_connect('localhost','root','','project');
        if(!$conn){
            die("Connection Failed:");
        }
            $sql2="INSERT INTO service(
            service_id,service_type,price)
            VALUES('$service_id','$service_type','$price')";
            if(mysqli_query($conn,$sql2)){
                 header('location:service.php');
            }
          
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Service Details</title>
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

.error {
  color: #FF0001;
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
    <hr>
<br><br>

<h2 style="text-align:center;">Add Service Details</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form  method="post">
        <div class="row">
          <div class="col-50">
            <?php  
              $sel = mysqli_query($conn, 'SELECT * FROM service ORDER BY service_id DESC LIMIT 1');
              $sel_row = mysqli_fetch_array($sel);
              if (mysqli_num_rows($sel) > 0){
                $var = $sel_row['service_id'] + 1;
              }

              else {
                $var = 1;
              }
            ?>
            <label>SERVICE ID</label>
            <input type="text" name="service_id" placeholder="" required readonly='readonly' value="<?php echo $var ?>">
            <label>SERVICE TYPE</label>
            <input type="text" name="service_type" placeholder="" required value = "<?php echo $_POST['service_type']??''; ?>">
             <label>PRICE</label>
            <input type="text" name="price" placeholder="" required value = "<?php echo $_POST['price']??''; ?>">
            <span class="error"><?php echo $Err;?> </span>  
           <br>
          </div>
          
        </div>
         <input type="submit" name="submit" value="Add Service" class="btn">
      </form>
    </div>
  </div>
 </div>
  </div>
</body>
</html>


