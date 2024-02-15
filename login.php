<?php
session_start();
$Err="";

$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
    die("Connection Failed");
}

  if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $hash = md5($password);
        if(empty($username) || empty($password)){
            echo "Don't leave any empty field!!";
        }
          else{
            $conn=mysqli_connect('localhost','root','','project');
            if(!$conn){
            die("Connection Failed:");
        }
            
        }
        if(!empty($username) && !empty($password)){
            $sql1="SELECT * FROM student WHERE username='$username'";
            $result1=mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_array($result1);

            $sql2="SELECT * FROM admin WHERE username='$username'";
            $result2=mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2);

            if(is_array($row1)){
              if($hash==$row1['password']){
                $_SESSION["name"] = $row1['username'];

              }
              else{
                
                $Err = "Incorrect Username or Password";;
            }
                
            }
            if(is_array($row2)){
              if($hash==$row2['password']){
                $_SESSION["staffname"] = $row2['username'];
            }
             else{
                
                $Err = "Incorrect Username or Password";;
            }
            
            }
          }
           
            
    }
if(isset($_SESSION["name"])){
    header("Location:studentdashboard.php");

}

if(isset($_SESSION["staffname"])){
    header("Location:staffdashboard.php");

}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.input-container {
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
  background: #f7ba5b ;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 80%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
.btn {
  background-color: dodgerblue;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 50%;
  opacity: 0.9;
  margin-left: 15px;
}

.btn:hover {
  opacity: 1;
}

.user_card {
            width: 350px;
            margin-top: 10%;
            margin-bottom: auto;
            background: #74cfbf;
            position: relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            border-radius: 5px;

        }

.signin {
  text-align: center;
  margin-top: 10px;
}

.error {
  color: black;
}  
</style>
</head>
<body>
<center>
 <div class="user_card">
<form method="post" style="max-width:500px;margin:auto">
  <h2>Login</h2>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Username" name="username" required>
  </div>

  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="password" required>
  </div>
        <span class="error"><?php echo $Err;?> </span>  
           <br>
  <button type="submit" name="submit" class="btn"><center>Login</center></button> 
</form>

<div class="signin">
    <p>Don't have an account? <a href="NewStudent.php">Sign Up</a>.</p>
  </div>
</div>
</center>
</body>
</html>
