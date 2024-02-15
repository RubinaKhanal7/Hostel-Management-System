<?php
$conn=mysqli_connect('localhost','root','','project');
$sql="SELECT * FROM detail order by booking_number desc";
$result=mysqli_query($conn,$sql);
$data=[];
if(mysqli_num_rows($result) > 0){ 
    $delimiter = ","; 
    $filename = "Booked Room Details" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('Booking Number', 'Booking Date', 'Student ID', 'Fullname','Floor Number','Room ID', 'No. of selected bed'); 
    fputcsv($f, $fields, $delimiter);
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($result)){ 
        $lineData = array($row['booking_number'], $row['start_date'], $row['student_id'], $row['fullname'], $row['room_id'], $row['select_bed']); 
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



 
