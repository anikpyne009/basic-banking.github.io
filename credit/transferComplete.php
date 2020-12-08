<?php
include('navbar.php');
include('connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container final center">
        
        <?php

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $sender = $_POST['Sname'];
                $receiver = $_POST['Rname'];
                $amount = $_POST['amount'];
            }

            if( $sender != $receiver && $amount>0){
                $sender_query = "SELECT * FROM allusers WHERE name ='$sender'";
                $sCon = mysqli_query($con,$sender_query);
                $sResult=mysqli_fetch_assoc($sCon);
                $sBalance=$sResult['balance'];
                
                if($amount<$sBalance){
                    $receiver_query = "SELECT * FROM allusers WHERE name ='$receiver'";
                    $rCon = mysqli_query($con,$receiver_query);
                    $sResult = mysqli_fetch_assoc($rCon);
                    $rBalance = $sResult['balance'];

                    echo "<h1 class='success'>Transaction Successful!</h1>
                    <p>Rs $amount has been deducted from your account and successfully transfered to $receiver.</p> <br>";

                    $sBalance-=$amount;
                    $rBalance+=$amount;
                    
                    $sUpdate = "UPDATE `allusers` SET `balance` = '$sBalance' WHERE `allusers`.`name` = '$sender';";
                    $senderLogUpdate=mysqli_query($con,$sUpdate);

                    $rUpdate = "UPDATE `allusers` SET `balance` = '$rBalance' WHERE `allusers`.`name` = '$receiver';";
                    $recevierLogUpdate=mysqli_query($con,$rUpdate);

                    $history_query = "INSERT INTO `transfer_history` (`sender`, `receiver`, `amount`, `time`) VALUES ('$sender', '$receiver', '$amount', current_timestamp())";
                    $history = mysqli_query($con,$history_query);
                    
                }
                else echo "<h1 class='error'>Transaction Failed!</h1>
                <p>Insufficient balance. Please recharge your account to proceed furthur.</p>";
            }
            else if($sender == $receiver){
                echo "<h1 class='error'>Transaction Failed!</h1>
                <p>Sender and receiver cannot be same. Please select a different user.</p>";
            }
        ?>
        <a href='./transfer.php' class="btn">Back</a>
        <a href='./transfer_history.php' class="btn">Transaction History</a>
    </div>
</body>
</html>