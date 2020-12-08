<?php
include('navbar.php');
include('connect.php');

//selecting data to show
$sql = "SELECT * FROM `allusers`";
$result = mysqli_query($con, $sql);
// mysqli_close($con);
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
    <div class="container sender">
        <?php
        session_start();
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $sender = $_POST['name'];
                $_SESSION["name"] = $sender;
                $query = "SELECT * FROM allusers WHERE name ='$sender'";
			    $result = mysqli_query($con,$query);
			    $customer = mysqli_fetch_assoc($result);
                echo "<h1>Sender's Details</h1><br><br><br><br><br><br>
                <h2> Name: " .$sender. "</h2><br><br>
                <h2> Email: " .$customer['email']. "</h2><br><br>
                <h2> Current Balance(in Rs.) : " .$customer['balance']. "</h2><br>";
            }
        ?>

        <div class="container center">
		<a href="transfer.php" class="btn">Transfer to &rarr;</a>
		<a href="selectUser.php" class="waves-effect waves-light btn black z-depth-2">Back</a>
	<div>

    </div>
</body>
</html>