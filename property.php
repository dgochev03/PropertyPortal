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

        <div class="title">
        <h2>Property Listings</h2>

        <form method="GET">
            <table id="filter">
                <th>
                    <select name="sort">
                        <option value="">Sort By</option>
                        <option value="price_asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') echo 'selected'; ?>>Price (Low to High)</option>
                        <option value="price_desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') echo 'selected'; ?>>Price (High to Low)</option>
                        <option value="date_new" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'date_new') echo 'selected'; ?>>Date (Newest)</option>
                        <option value="date_old" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'date_old') echo 'selected'; ?>>Date (Oldest)</option>
                    </select>
                </th>
                <th>
                    <select name="type">
                        <option value="">Filter by sale or rent</option>
                        <option value="sale" <?php if (isset($_GET['type']) && $_GET['type'] == 'sale') echo 'selected'; ?>>Sale</option>
                        <option value="rent" <?php if (isset($_GET['type']) && $_GET['type'] == 'rent') echo 'selected'; ?>>Rent</option>
                    </select>
                </th>
                <th>
                    <button type="submit">Apply</button>
                </th>

            </table>
        </form>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Rent/Sale</th>
                    <th>Published By</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT property.*, user.uname FROM property JOIN user ON property.uid = user.uid";

                if (isset($_GET['type']) && !empty($_GET['type'])) {
                    $type = $_GET['type'];
                    $query .= " WHERE property.stype = '$type'";
                }

                if (isset($_GET['sort'])) {
                    $sort = $_GET['sort'];
                    switch ($sort) {
                        case 'price_asc':
                            $query .= " ORDER BY property.price ASC";
                            break;
                        case 'price_desc':
                            $query .= " ORDER BY property.price DESC";
                            break;
                        case 'date_new':
                            $query .= " ORDER BY property.date DESC";
                            break;
                        case 'date_old':
                            $query .= " ORDER BY property.date ASC";
                            break;
                        default:
                            $query .= " ORDER BY property.date DESC";
                    }
                } else {
                    $query .= " ORDER BY property.date DESC";
                }

                $result = mysqli_query($con, $query);

                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><img src="images/property/<?php echo $row['12']; ?>" alt="Property Image" width="100"></td>
                        <td><a href="propertydetail.php?pid=<?php echo $row['0']; ?>"><?php echo $row['1']; ?></a></td>
                        <td><?php echo $row[11]. ", ". $row['10']; ?></td>
                        <td><?php echo $row['9']; ?> EUR</td>
                        <td><?php echo $row['5']; ?></td> 
                        <td><?php echo $row['uname']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php include("include/footer.php"); ?>
    </body>
</html>

