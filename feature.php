<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("config.php");

if (!isset($_SESSION['uemail'])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="images/logo/logo-house.svg">
        <link rel="stylesheet" href="style/feature.css">

        <title>Real Estate Portal</title>
    </head>
    <body>
        <?php include("include/header.php"); ?>
        <div class="title">
        <h2>User Listed Property</h2>
        <?php
        if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        }else if (isset ($_GET['error'])){
            echo $_GET['error'];
        }
        ?>
        </div>
        <table class="items-list">
            <thead>
                <tr class="bg-primary">
                    <th>Properties</th>
                    <th>Numer of rooms</th>
                    <th>Type</th>
                    <th>Added Date</th>
                    <th>Rent/Sale</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $uid = $_SESSION['uid'];
                $query = mysqli_query($con, "SELECT * FROM `property` WHERE uid='$uid'");

                while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td>
                            <img src="images/property/<?php echo htmlspecialchars($row['12']); ?>" alt="Property Image" style="width: 380px; height: auto;">
                            <div class="property-info">
                                <h5 class="text-secondary">
                                    <a href="propertydetail.php?pid=<?php echo $row['0']; ?>"><?php echo htmlspecialchars($row['1']); ?></a>
                                </h5>
                                <span>
                                    <?php echo htmlspecialchars($row['11']); ?>
                                </span>
                                <div class="price">
                                    <span>$<?php echo htmlspecialchars($row['9']); ?> EUR</span>
                                </div>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($row['4']); ?></td>
                        <td><?php echo htmlspecialchars($row['3']); ?></td>
                        <td><?php echo htmlspecialchars($row['19']); ?></td>
                        <td>For <?php echo htmlspecialchars($row['5']); ?></td>
                        <td>
                            <a class="btn btn-primary" href="submitpropertyupdate.php?id=<?php echo $row['0']; ?>">Update</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="submitpropertydelete.php?id=<?php echo $row['0']; ?>" 
                               onclick="return confirm('Are you sure you want to delete this ad?');">Delete</a>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>            

        <?php include("include/footer.php"); ?>

    </body>
</html>
