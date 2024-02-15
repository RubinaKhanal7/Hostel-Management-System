<?php
$conn=mysqli_connect('localhost','root','','project');
$sql="SELECT * FROM student order by student_id desc";
$result=mysqli_query($conn,$sql);
$data=[];
if(mysqli_num_rows($result) > 0){ 
    $delimiter = ","; 
    $filename = "Student Details" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('Student ID', 'Fullname', 'Phone No.', 'Gender','Class','Date of birth', 'Address', 'Guardian name', 'Guardian phone'); 
    fputcsv($f, $fields, $delimiter);
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($result)){ 
        $lineData = array($row['student_id'], $row['fullname'], $row['phone'], $row['gender'], $row['class'], $row['date_of_birth'], $row['address'], $row['guardian_name'], $row['guardian_phone']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 

?>



 
