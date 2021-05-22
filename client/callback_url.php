<?php
include('functions.php');
 
$callbackJSONData = file_get_contents('php://input');  
// $logFile = "stkPush.json";
// $log = fopen($logFile, "a");
// fwrite($log, $callbackJSONData);
// fclose($log);

$callbackData = json_decode($callbackJSONData);


$resultCode = $callbackData->Body->stkCallback->ResultCode;
$merchantRequestID = $callbackData->Body->stkCallback->MerchantRequestID;
$checkoutRequestID = $callbackData->Body->stkCallback->CheckoutRequestID;
$amount = $callbackData->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$mpesaReceiptNumber = $callbackData->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$transactionDate = $callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value; 
$phone = $callbackData->Body->stkCallback->CallbackMetadata->Item[4]->Value; 

if($resultCode == '1032'){

    /**If user cancelled transaction
     * Insert into payments 'cancelled' payment status
     * Delete booking made from bookings
     */
    mysqli_query($db, "INSERT INTO payments (checkoutRequestID, merchantRequestID, paymentStatus) 
        VALUES('$checkoutRequestID', '$merchantRequestID', 'cancelled')");
    mysqli_query($db, "DELETE FROM bookings WHERE checkoutRequestID='$checkoutRequestID'");

}else if($resultCode == '1037'){

    /**If transaction timed out
     * Insert into payments 'timed out' payment status
     * Delete booking made from bookings
     */
    mysqli_query($db, "INSERT INTO payments (checkoutRequestID, merchantRequestID, paymentStatus) 
        VALUES('$checkoutRequestID', '$merchantRequestID', 'timed out')");
    mysqli_query($db, "DELETE FROM bookings WHERE checkoutRequestID='$checkoutRequestID'");
    
}else if($resultCode == '0'){

    /**If transaction is successful
     * Insert into payments 'complete' payment status
     * Update booking status from bookings
     */
    mysqli_query($db, "INSERT INTO payments (checkoutRequestID, merchantRequestID, amount, mpesaReceiptNumber, phone, transactionDate, paymentStatus) 
        VALUES('$checkoutRequestID', '$merchantRequestID', '$amount', '$mpesaReceiptNumber', '$phone', '$transactionDate', 'complete')");
    mysqli_query($db, "UPDATE bookings SET status='complete' WHERE checkoutRequestID='$checkoutRequestID'");

}else{}

?>