<?php
session_start();
$user = $_SESSION['name'];
if (!isset($_SESSION['name']) ||(trim ($_SESSION['name']) == '')) {
    header('location:login.php');
    exit();
}
$conn=mysqli_connect('localhost','root','','project');
$sql="SELECT * FROM room order by room_id desc";
$result=mysqli_query($conn,$sql);
$data=[];
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    array_unshift($data,$row);
    
}
}


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

    <h1 style="text-align: center;">Book Available Rooms</h1>

  <div class="manage">
  <center>
  <table border="1" style="width:100%" id="table" >
    <thead>
      <tr>
        <th style="width:5%; padding-left:20px;">Room ID</th>
        <th style="width:7%; padding-left:20px;">Number of Beds</th>
        <th style="width:7%; padding-left:20px;">Floor Number</th>          
        <th style="width:5%; padding-left:5px;">Price</th>
        <th style="width:5%; padding-left:5px;">Status</th>
        <th style="width:5%; padding-left:30px;">Book A Room</th>
      </tr>
    </thead>
    <?php 
    foreach($data as $d){
    ?>
    <tbody>
      <tr>
        <td style='padding-left: 20px;'><?php echo $d['room_id']; ?></td>
        <td><?php echo $d['no_of_beds']; ?></td>
            <td><?php echo $d['floor_number']; ?></td>
            <td style='padding-left: 18px;'><?php echo $d['price']; ?></td>
            <td style='padding-left: 18px;'>
            <?php if($d['no_of_beds'] <= 0){
                echo "Unavailable";
            }
            else{
              echo "Available";
            }
            ?></td>
            <td style='padding-left: 20px;'>
              <?php if($d['no_of_beds'] <= 0){
                echo "Booked";
            }
            else{
              $query= "SELECT * from student where username = '$user'";
              $res_stud= mysqli_query($conn,$query);
              $row_stud = mysqli_fetch_assoc($res_stud);
              $student_id = $row_stud['student_id'];

              $query1= "SELECT * from detail where student_id = '$student_id'";
              $res_stud1= mysqli_query($conn,$query1);
              $row_stud1 = mysqli_fetch_assoc($res_stud1);
              if(is_array($row_stud1)){
                  echo '<a href="managebookroom.php" onClick="return confirm(\'You have already booked a room.\')"><button style="padding: 5px 10px;">BOOK</button></a>';
              }
              else{
                echo '<a href="editroom.php?id=' . $d['room_id'] . '"><button style="padding: 5px 10px;">BOOK</button></a>';
              }
     
                
            
          
       }

          ?></td>
           </tr>
    </tbody>
    <?php } ?>
  </table>
</center>
</div>
</div>
</body>
</html>