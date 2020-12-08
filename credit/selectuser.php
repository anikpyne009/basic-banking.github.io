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
    <section class="container">
        <form action="single_user.php" method="POST">
            <section>

                <div>
                    <table class="center">
                        <tr>
                            <th>Sno.</th>
                            <th>Name</th>
                            <th>Current Balance</th>
                        </tr>
                        <?php 
                            $sno = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $sno = $sno + 1;
                                echo "<tr>
                                <td scope='row'>". $sno . "</td>
                                <td>". $row['name'] . "</td>
                                <td>". $row['balance'] . "</td>
                                </tr>";
                            }
                                
                        ?>
                    </table>
                </div>
            </section>
            <section class="container drop-down">
                <label for="names">Select a user to start transaction : </label><br>
                <select name="name" id="name">
                    <option value="" disabled selected>Select User</option>
                    <?php
                        $query = "SELECT * FROM `allusers` ORDER BY `allusers`.`name` ASC";
                        $query_run = mysqli_query($con, $query);
            
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            echo "<option value='".$row['name']."'>".$row['name']."</option>";
                        }
                        mysqli_close($con);
                    ?>
                </select>
                <div class="container">
                    <button type="submit" class="btn submit-btn">Submit</button>
                    <a href="index1.php" class="home">Home</a> 
                </div>
            </section>
        </form>
    </section>
</body>
</html>

