<?php

$Err = $Error = $phErr = $gphErr ="";

$conn=mysqli_connect('localhost','root','','project');
 

if(isset($_POST['submit'])){
      $id=$_POST['id'];
      $fullname=$_POST['fullname'];
      if(!preg_match("/[s-zA-Z]{1,30}/", $fullname)){
          echo "Error: Letters and Space is only allowed in fullname.";
          exit();
      }
      $phone=$_POST['phone'];
      $pattern = '/^98\d{8}$/';
        if(strlen($phone) != 10 || !ctype_digit($phone) || !preg_match($pattern, $phone) || strpos($phone, '0') === 0 ){
          echo"Error: Phone Number should be of 10 digit and should start with 98.";
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
      if(strlen($gphone) != 10 || !ctype_digit($gphone) ||  !preg_match($pattern, $phone) ||strpos($gphone, '0') === 0){
          echo"Error: Phone Number should be of 10 digit and should start with 98.";
          exit();
        }
      $username=$_POST['username'];
      $password=$_POST['password'];
      $confirm=$_POST['confirm'];

      $sel = mysqli_query($conn, "SELECT * FROM student WHERE username = '$username'");
      $sel1 = mysqli_query($conn, "SELECT * FROM student WHERE phone = '$phone'");
      $sel2 = mysqli_query($conn, "SELECT * FROM student WHERE guardian_phone = '$gphone'");

      if(($confirm)!=($password)){
         $Error = "Password and confirm password must be same.";
      }

      
      elseif (mysqli_num_rows($sel) > 0) {
           $Err = "This username already exists.";
        }

      elseif (mysqli_num_rows($sel1) > 0) {
           $phErr = "This phone number already exists.";
        }

      elseif (mysqli_num_rows($sel2) > 0) {
           $gphErr = "This guardian phone number already exists.";
        }

      else{
          $hash = md5($password);
          $sql2= mysqli_query($conn, "INSERT INTO student (student_id,fullname,phone,date_of_birth,gender,class,address,guardian_name,guardian_phone,username,password,confirm_password) VALUES ('$id','$fullname','$phone','$dob','$gender','$class','$address','$gname','$gphone','$username','$hash','$hash')");

          if(mysqli_affected_rows($conn)==1){
          header('location:login.php');
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
.radio {
    width: 20px;
    position: relative;
}

.error {
  color: #FF0001;
}  


</style>
</head>
<body>

<h1 style="text-align: center;padding-top:10px;font-family: Arial;">STUDENT REGISTRATION FORM</h1>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form  method="post">
        <div class="row">
          <div class="col-50">
           <?php  
              $sel = mysqli_query($conn, 'SELECT * FROM student ORDER BY student_id DESC LIMIT 1');
              $sel_row = mysqli_fetch_array($sel);
              if (mysqli_num_rows($sel) > 0){
                $var = $sel_row['student_id'] + 1;
              }

              else {
                $var = 1;
              }
            ?>
            <label><i class="fa fa-user"></i> Student ID</label>
            <input type="text" name="id" placeholder="" required readonly='readonly' value="<?php echo $var ?>">
            <label><i class="fa fa-user"></i> Full Name</label>
            <input type="text" name="fullname" required value = "<?php echo $_POST['fullname']??''; ?>">
            <label><i class="fa fa-phone"></i> Phone Number</label>
            <input type="number" name="phone" pattern = "98\d{8}" required value = "<?php echo $_POST['phone']??''; ?>" >
            <span class="error"><?php echo $phErr;?> </span>  
            <br>
            <label><i class="fa fa-calendar"></i> Date of Birth</label>
            <input type="date" name="dob" max="<?php echo (new DateTime())->format('Y-m-d'); ?>" required value = "<?php echo $_POST['dob']??''; ?>">
           <label><i class="fa fa-user"></i> Gender</label>
       <div class="row">
              <div class="col-50">
               <label>Male
             <input type="radio" name="gender" class="radio" value="Male" required>
              </label>
              </div>
              <div class="col-50">
                <label>Female
               <input type="radio" name="gender" class="radio" value="Female" required>
                </label>

              </div>
            </div>

              <label><i class="fa fa-address-card-o"></i> Class</label>
            <input type="number" name="class" placeholder="" required value = "<?php echo $_POST['class']??''; ?>">
            

          </div>


           <div class="col-50">
           <div class="row">
              <div class="col-50">
                <label><i class="fa fa-user"></i> Guardian's Name</label>
                <input type="text" name="gname" placeholder="" required value = "<?php echo $_POST['gname']??''; ?>">
              </div>
              <div class="col-50">
                <label><i class="fa fa-phone"></i> Guardian's Phone Number</label>
                <input type="number" name="gphone" placeholder="" required value = "<?php echo $_POST['gphone']??''; ?>">
                <span class="error"><?php echo $gphErr;?> </span>  
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
         <button type="submit" name="submit" class="btn" onclick="return confirm('Are you sure you wanna register?')">Register</button><br><br>
      </form>
    </div>
  </div>
 </div>
  </div>
</body>
</html>


