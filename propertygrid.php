<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="images/logo/logo-house.svg">
        <link rel="stylesheet" href="style/property.css">
        <title>Real Estate Portal</title>
    </head>
    <body>
        <?php include("include/header.php"); ?>
        <h2 class="title">Property Listings</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Published By</th>
                    <th>Rent/Sale</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_REQUEST['filter'])) {
                    $type = $_REQUEST['type'];
                    $stype = $_REQUEST['stype'];
                    $city = $_REQUEST['city'];

                    $query = "SELECT property.*, user.uname FROM property JOIN user ON property.uid = user.uid WHERE type='{$type}' and stype='{$stype}' and city='{$city}'";
                }


                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><img src="images/property/<?php echo $row['12']; ?>" alt="Property Image" width="100"></td>
                            <td><a href="propertydetail.php?pid=<?php echo $row['0']; ?>"><?php echo $row['1']; ?></a></td>
                            <td><?php echo $row['10']; ?></td>
                            <td><?php echo $row['9']; ?> EUR</td>
                            <td><?php echo $row['uname']; ?></td>
                            <td><?php echo $row['5']; ?></td> 
                        </tr>
                    <?php
                    }
                } else {
                    echo "<h1><center>No Property Available</center></h1>";
                }
                ?>
            </tbody>
        </table>

        <?php include("include/footer.php"); ?>
    </body>
</html>

