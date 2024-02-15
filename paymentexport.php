<?php
$conn=mysqli_connect('localhost','root','','project');
$sql="SELECT * FROM payments order by payment_id desc";
$result=mysqli_query($conn,$sql);
$data=[];
if(mysqli_num_rows($result) > 0){ 
    $delimiter = ","; 
    $filename = "Payment Details" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('Payment ID', 'Payment Date', 'Fullname', 'Room ID', 'Price', 'Amount Paid'); 
    fputcsv($f, $fields, $delimiter);
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($result)){ 
        $lineData = array($row['payment_id'], $row['payment_date'], $row['fullname'], $row['room_id'], $row['price'], $row['amount_paid']); 
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



 
