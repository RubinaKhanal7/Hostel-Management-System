<?php
session_start();
$user = $_SESSION['staffname'];
if (!isset($_SESSION['staffname']) ||(trim ($_SESSION['staffname']) == '')) {
    header('location:login.php');
    exit();
}

$conn=mysqli_connect('localhost','root','','project');
$sql="SELECT * FROM payments order by payment_id desc";
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
	<title>Manage Payments</title>
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
  padding: 40px 8px 8px 32px;
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

.button {
  background-color: #f44336;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin-left: 250px;
}

</style>
</head>
<body>
	 
<div class="sidenav">
        
    <a href="staffdashboard.php" class="acitve"><i class="fa fa-home" style="font-size:20px;"></i> HOME</a>
    <a href="manageroom.php"><i class="fa fa-hotel" style="font-size:20px;"></i> ROOM</a>
    <a href="managestudent.php"><i class="fa fa-user" style="font-size:20px;"></i> STUDENT</a>
    <a href="managepayments.php"><i class="fa fa-money" style="font-size:20px;"></i> PAYMENT</a>
    <a href="staffmanagebook.php"><i class="fa fa-far fa-bell-slash" style="font-size:20px;"></i> BOOKED ROOMS</a>
    <a href="service.php"><i class="fa fa-cogs" style="font-size:20px;"></i> SERVICES</a>
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
    <h1 style="text-align: center;">PAYMENT DETAILS</h1>
	<div class="manage">
      <div class="ro">
        <div class="columns">
           <form method="POST" action="">
            <label>Date:</label>
            <input type="date" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
            <label>To</label>
            <input type="date" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
            <button name="search"><i class="fa fa-search"></i></button>
            <a href="managepayments.php"><button><i class="fa fa-refresh"></i></button></a>
        </form>
          </div>

        <div class="columns">
          <a href="paymentexport.php" onclick="return confirm('Are you sure you wanna download?')" class="button"><i class="dwn"></i> Export Payment Details</a>
      </div>
    </div>
        <br /><br />

	<center>
	 <table border="1" style="width:100%" id="table">
        <thead>
            <tr>
                <th style="width:10% ; padding-left: 30px;">Payment ID</th> 
                <th style="width:10% ; padding-left: 30px;">Payment Date</th>            
                <th style="width:10%; padding-left: 30px;">Fullname</th>
                <th style="width:10%; padding-left: 30px;">Room ID</th>
                <th style="width:7%; padding-left: 30px;">Price</th>  
                <th style="width:10%;">Amount Paid</th>                 
                <th style="width:10%; padding-left: 30px;">Status</th>
            </tr>
        </thead>

        <tbody>
            
<?php
    if(ISSET($_POST['search'])){
        $date1 = date("Y-m-d", strtotime($_POST['date1']));
        $date2 = date("Y-m-d", strtotime($_POST['date2']));
        $query=mysqli_query($conn, "SELECT * FROM payments WHERE date(payment_date) BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
        $row=mysqli_num_rows($query);
        if($row>0){
            while($fetch=mysqli_fetch_array($query)){
?>
    <tr>
        <td><?php echo $fetch['payment_id']?></td>
        <td><?php echo $fetch['payment_date']?></td>
        <td><?php echo $fetch['fullname']?></td>
        <td><?php echo $fetch['room_id']?></td>
        <td><?php echo $fetch['price']?></td>
        <td><?php echo $fetch['amount_paid']?></td>
         <td  style='padding-left: 30px;'> Paid
                </td>
    </tr>
<?php
        }
        }

    }else{
        $query=mysqli_query($conn, "SELECT * FROM payments") or die(mysqli_error());
        while($fetch=mysqli_fetch_array($query)){
?>
    <tr>
         <td><?php echo $fetch['payment_id']?></td>
        <td><?php echo $fetch['payment_date']?></td>
        <td><?php echo $fetch['fullname']?></td>
        <td><?php echo $fetch['room_id']?></td>
        <td><?php echo $fetch['price']?></td>
        <td><?php echo $fetch['amount_paid']?></td>
         <td  style='padding-left: 30px;'> Paid
                </td>
    </tr>
<?php
        }
    }
?>
        </tbody>
        
   	</table>
</center>
</div>
</div>
</body>
</html>