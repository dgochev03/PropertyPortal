<?php
session_start();
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Real Estate Portal">
        <link rel="shortcut icon" href="images/logo/logo-house.svg">
        <link rel="stylesheet" href="style/propertydetail.css">
        <title>Real Estate Portal</title>
    </head>
    <body>

        <div id="page-wrapper">
            <?php include("include/header.php"); ?>

            <div class="container">
                <?php
                $id = $_REQUEST['pid'];
                $query = mysqli_query($con, "SELECT property.*, user.* FROM property JOIN user ON property.uid = user.uid WHERE pid='$id'");
                $row = mysqli_fetch_array($query);
                ?>

                <div class="property-details">
                    <div class="status">For <?php echo $row['5']; ?></div>
                    <h3><?php echo $row['1']; ?></h3>

                    <div class="property-images">
                        <div class="slide"><img src="images/property/<?php echo $row['12']; ?>" alt="Property Image" /></div>
                        <div class="slide"><img src="images/property/<?php echo $row['13']; ?>" alt="Property Image" /></div>
                        <div class="slide"><img src="images/property/<?php echo $row['14']; ?>" alt="Property Image" /></div>
                        <div class="slide"><img src="images/property/<?php echo $row['15']; ?>" alt="Property Image" /></div>
                        <div class="slide"><img src="images/property/<?php echo $row['16']; ?>" alt="Property Image" /></div>
                    </div>

                    <p class="main-info"> <?php echo $row['11'].", ". $row['10']; ?></p>
                    <p class="main-info"> <?php echo $row['9']; ?> EUR</p>

                    <h4>Description</h4>
                    <p><?php echo $row['2']; ?></p>

                    <h5>Summary</h5>
                    <table>
                        <tr><td>Size:</td><td><?php echo $row['8']; ?> sq.m.</td></tr>
                        <tr><td>Number of rooms:</td><td><?php echo $row['4']; ?></td></tr>
                        <tr><td>Number of bathrooms:</td><td><?php echo $row['6']; ?></td></tr>
                        <tr><td>Property Type:</td><td><?php echo $row['3']; ?></td></tr>
                        <tr><td>Floor:</td><td><?php echo $row['7']; ?></td></tr>
                        <tr><td>Total Floor:</td><td><?php echo $row['18']; ?></td></tr>
                        <tr><td>City:</td><td><?php echo $row['11']; ?></td></tr>
                        <tr><td>Published:</td><td><?php echo $row['19']; ?></td></tr>
                    </table>

                    <h5>Contact <?php if($row['utype'] == "user") echo "private seller"; else echo "agent";?></h5>
                    <div class="agent">
                        <div>
                            <h6><?php echo $row['uname']; ?></h6>
                            <p>tel: <?php echo $row['uphone']; ?><br>email: <?php echo $row['uemail']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("include/footer.php"); ?>
        </div>

    </body>
</html>