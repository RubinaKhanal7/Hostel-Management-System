<?php
session_start();
$user = $_SESSION['staffname'];
if (!isset($_SESSION['staffname']) ||(trim ($_SESSION['staffname']) == '')) {
    header('location:login.php');
    exit();
}
$Err = '';

$id=$_GET['id'];
$conn=mysqli_connect('localhost','root','','project');
if(isset($_POST['submit'])){
  $fullname=$_POST['fullname'];
   if(!preg_match("/[s-zA-Z]{1,30}/", $fullname)){
          echo "Error: Letters and Space is only allowed in fullname";
          exit();
      }
  $phone=$_POST['phone'];
   if(strlen($phone) != 10 || !ctype_digit($phone) || strpos($phone, '0') === 0){
          echo"Error: Phone Number should be of 10 digit and shouldn't start with 0.";
          exit();
        }
  $dob=$_POST['dob'];
  $gender=$_POST['gender'];
  $class=$_POST['class'];
  $address=$_POST['address'];
  $gname=$_POST['gname'];
   if(!preg_match("/[s-zA-Z]{1,30}/", $gname)){
          echo "Error: Letters and Space is only allowed";
          exit();
      }
  $gphone=$_POST['gphone'];
  if(strlen($gphone) != 10 || !ctype_digit($gphone) || strpos($gphone, '0') === 0){
          echo"Error: Phone Number should be of 10 digit and shouldn't start with 0.";
          exit();
        }
  $id=$_POST['id'];

  $sql="UPDATE student set fullname='$fullname',phone='$phone',date_of_birth='$dob',gender='$gender',class='$class',address='$address',guardian_name='$gname',guardian_phone='$gphone' where student_id='$id'";
  mysqli_query($conn,$sql);
  header('location:managestudent.php');

}
$sql1="select * from student where student_id = $id";
$res= mysqli_query($conn,$sql1);
$data=mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html>
<head>
  <title>form</title>
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <style>
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
  width: 20%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
  margin-left:40%;
}

.btn:hover {
  background-color: #45a049;
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

<h2 style="text-align:center;">Edit Student Registration Details</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form  method="post">
        <div class="row">
          <div class="col-50">
            <label><i class="fa fa-user"></i> Student ID</label>
            <input type="text" name="id" value="<?php echo $data['student_id']?>" readonly='readonly'>
            <label><i class="fa fa-user"></i> Full Name</label>
            <input type="text" name="fullname" value="<?php echo $data['fullname'];?>" >
            <label><i class="fa fa-phone"></i> Phone Number</label>
            <input type="number" name="phone" value="<?php echo $data['phone']?>" ><br>
            <label><i class="fa fa-calendar"></i> Date of Birth</label>
           <input type="text" name="dob" value="<?php echo $data['date_of_birth']?>" max="<?php echo (new DateTime())->format('Y-m-d'); ?>">
            <label><i class="fa fa-user"></i> Gender</label>
             <input type="text" name="gender" value="<?php echo $data['gender']?>">
              <label><i class="fa fa-address-card-o"></i> Class</label>
            <input type="number" name="class" value="<?php echo $data['class']?>"  >
            

          </div>

          <div class="col-50">
           <div class="row">
              <div class="col-50">
                <label><i class="fa fa-user"></i> Guardian's Name</label>
                <input type="text" name="gname" value="<?php echo $data['guardian_name'];?>" >
              </div>
              <div class="col-50">
                <label><i class="fa fa-phone"></i> Guardian's Phone Number</label>
                <input type="number" name="gphone" value="<?php echo $data['guardian_phone'];?>" >
              </div>
            </div>
             <label><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" name="address" value="<?php echo $data['address'];?>" >
             <span class="error"><?php echo $Err;?> </span>  <br>
          </div>
          
        </div>
         <button type="submit" name="submit" class="btn" onclick="return confirm('Are you sure you wanna edit?')">Edit Student</button><br><br>
      </form>
    </div>
  </div>
 </div>
  </div>
</body>
</html>