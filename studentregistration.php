<?php
session_start();
$user = $_SESSION['staffname'];
$Err = $Error = $Errors = $err ="";

$conn=mysqli_connect('localhost','root','','project');

if(!isset( $_SESSION['staffname']) ||  $_SESSION['staffname'] == ""){
   header("Location: login.php");
}

 
if(isset($_POST['submit'])){
      $id=$_POST['id'];
        $fullname=$_POST['fullname'];
        $phone=$_POST['phone'];
        $dob=$_POST['dob'];
        $gender=$_POST['gender'];
        $class=$_POST['class'];
        $address=$_POST['address'];
        $gname=$_POST['gname'];
        $gphone=$_POST['gphone'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $confirm=$_POST['confirm'];

        
        if(empty($id) || empty($fullname) || empty($phone) ||  empty($dob) || empty($gender) || empty($class) ||  empty($address) ||   empty($gname) || empty($gphone) ||  empty($username) || empty($password) || empty($confirm)){
      echo "Don't leave any empty field"; 
    }

    if(($confirm)!=($password)){
         $Error = "Password and confirm password must be same.";
    }

          $sel = mysqli_query($conn, "SELECT * FROM student WHERE username = '$username' OR phone = '$phone' OR guardian_phone = '$gphone'");
      if (mysqli_num_rows($sel) > 0) {
           $Err = "Phone number or Username already exists.";
        }
       
     /* $sel1 = mysqli_query($conn, "SELECT * FROM student WHERE phone = '$phone'");
        if (mysqli_num_rows($sel1) > 0) {
           $err = "This phone number already exists.";
        }

      $sel2 = mysqli_query($conn, "SELECT * FROM student WHERE guardian_phone = '$gphone'");
        if (mysqli_num_rows($sel2) > 0) {
           $Errors = "This phone number already exists.";
        }*/
        
        else{
           $hash = md5($password);
          $sql2= mysqli_query($conn, "INSERT INTO student (student_id,fullname,phone,date_of_birth,gender,class,address,guardian_name,guardian_phone,username,password,confirm_password) VALUES ('$id','$fullname','$phone','$dob','$gender','$class','$address','$gname','$gphone','$username','$hash','$hash')");

          if(mysqli_affected_rows($conn)==1){
          header('location:managestudent.php');
          }

      }
    }
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Student Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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


<h2 style="text-align:center;">Student Registration Form</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form  method="post">
        <div class="row">
          <div class="col-50">
             <?php
              $sql1="SELECT student_id from student ORDER BY student_id DESC LIMIT 1;";
              $result1= mysqli_query($conn,$sql1);
              $row1= mysqli_fetch_assoc($result1);

              if(mysqli_num_rows($result1) > 0){
                  $val = $row1['student_id'] + 1;
                }

                else {
                  $val = 1 ;
                }

            ?>
            <label><i class="fa fa-user"></i> Student ID</label>
            <input type="text" name="id" placeholder="" value="<?php echo $val?>" readonly="readonly">
            <label><i class="fa fa-user"></i> Full Name</label>
            <input type="text" name="fullname" placeholder=""  pattern="[A-Za-z ]{1,32}" required value = "<?php echo $_POST['fullname']??''; ?>">
            <label><i class="fa fa-phone"></i> Phone Number</label>
            <input type="number" name="phone" placeholder="" pattern="[0-9]{10}" required value = "<?php echo $_POST['phone']??''; ?>"><br>
               <span class="error"><?php echo $Error;?> </span>  
           <br>
            <label><i class="fa fa-calendar"></i> Date of Birth</label>
            <input type="date" name="dob" placeholder="" max="<?php echo (new DateTime())->format('Y-m-d'); ?>" required value = "<?php echo $_POST['date_of_birth']??''; ?>">
           <label><i class="fa fa-user"></i> Gender</label>
       <div class="row">
              <div class="col-50">
               <label>Male
             <input type="radio" name="gender" class="radio" value="Male" required value = "<?php echo $_POST['gender']??''; ?>">
              </label>
              </div>
              <div class="col-50">
                <label>Female
               <input type="radio" name="gender" class="radio" value="Female" required value = "<?php echo $_POST['gender']??''; ?>">
                </label>

              </div>
            </div>


              <label><i class="fa fa-address-card-o"></i> Class</label>
            <input type="number" name="class" placeholder=""  required value = "<?php echo $_POST['class']??''; ?>">
            

          </div>


           <div class="col-50">
           <div class="row">
              <div class="col-50">
                <label><i class="fa fa-user"></i> Guardian's Name</label>
                <input type="text" name="gname" placeholder=""  pattern="[A-Za-z ]{1,32}" required value = "<?php echo $_POST['gname']??''; ?>">
              </div>
              <div class="col-50">
                <label><i class="fa fa-phone"></i> Guardian's Phone Number</label>
                <input type="number" name="gphone" placeholder="" pattern="[0-9]{10}" required value = "<?php echo $_POST['gphone']??''; ?>">
                   <span class="error"><?php echo $Errors;?> </span>  
           <br>
              </div>
            </div>
            <label><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" name="address" placeholder="" required value = "<?php echo $_POST['address']??''; ?>">
            <label><i class="fa fa-user icon"></i> Username</label>
            <input type="text" name="username" placeholder="" required value = "<?php echo $_POST['username']??''; ?>">
               <span class="error"><?php echo $Err;?> </span>  
           <br>
            <label><i class="fa fa-key icon"></i> Password</label>
            <input type="password" name="password" placeholder="" required>
            <label><i class="fa fa-key icon"></i> Confirm Password</label>
            <input type="password" name="confirm" placeholder="" required>
            <span class="error"><?php echo $Error;?> </span>  
           <br>
          </div>
          
        </div>
         <button type="submit" name="submit" class="btn">Register</button><br><br>
      </form>
    </div>
  </div>
 </div>
  </div>
</body>
</html>

