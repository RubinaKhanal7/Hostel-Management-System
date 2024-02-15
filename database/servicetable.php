<?php
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn=mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
    die("Connection Failed");
}
                                                                                 
$sql="CREATE TABLE service(
   service_id INT(6) PRIMARY KEY, 
   service_type VARCHAR(30) NOT NULL,
   price INT NOT NULL
 )";
if(mysqli_query($conn,$sql)){
echo "Table service created successfully";
}
else{
    echo "Error creating table";
}

?>