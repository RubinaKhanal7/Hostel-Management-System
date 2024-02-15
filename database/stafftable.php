<?php
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
    die("Connection Failed");
}
                                                                                 
$sql1="CREATE TABLE admin(
   admin_id INT(6) PRIMARY KEY, 
   username VARCHAR(30) NOT NULL,
   password VARCHAR(60) NOT NULL,
   confirm_password  VARCHAR(60) NOT NULL
 )";
if(mysqli_query($conn,$sql1)){
echo "Table staff created successfully";
}
else{
    echo "Error creating table";
}

?>