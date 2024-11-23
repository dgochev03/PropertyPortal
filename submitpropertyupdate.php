<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("config.php");
if (!isset($_SESSION['uemail'])) {
    header("location:login.php");
}

if (isset($_POST['add'])) {
    $pid = $_REQUEST['id'];

    $title = $_POST['title'];
    $content = $_POST['content'];
    $ptype = $_POST['ptype'];
    $number_of_rooms = $_POST['number_of_rooms'];
    $stype = $_POST['stype'];
    $bath = $_POST['bath'];
    $floor = $_POST['floor'];
    $price = $_POST['price'];
    $city = $_POST['city'];
    $asize = $_POST['asize'];
    $loc = $_POST['loc'];
    $uid = $_SESSION['uid'];
    $totalfloor = $_POST['totalfl'];

    $aimage = $_FILES['aimage']['name'];
    $aimage1 = $_FILES['aimage1']['name'];
    $aimage2 = $_FILES['aimage2']['name'];
    $aimage3 = $_FILES['aimage3']['name'];
    $aimage4 = $_FILES['aimage4']['name'];

    $temp_name = $_FILES['aimage']['tmp_name'];
    $temp_name1 = $_FILES['aimage1']['tmp_name'];
    $temp_name2 = $_FILES['aimage2']['tmp_name'];
    $temp_name3 = $_FILES['aimage3']['tmp_name'];
    $temp_name4 = $_FILES['aimage4']['tmp_name'];

    move_uploaded_file($temp_name, "images/property/$aimage");
    move_uploaded_file($temp_name1, "images/property/$aimage1");
    move_uploaded_file($temp_name2, "images/property/$aimage2");
    move_uploaded_file($temp_name3, "images/property/$aimage3");
    move_uploaded_file($temp_name4, "images/property/$aimage4");


    $sql = "UPDATE property SET title= '{$title}', pcontent= '{$content}', type='{$ptype}', number_of_rooms='{$number_of_rooms}', stype='{$stype}',
	bathroom='{$bath}', floor='{$floor}', 
	size='{$asize}', price='{$price}', location='{$loc}', city='{$city}',
	pimage='{$aimage}', pimage1='{$aimage1}', pimage2='{$aimage2}', pimage3='{$aimage3}', pimage4='{$aimage4}',
	uid='{$uid}', totalfloor='{$totalfloor}' WHERE pid = {$pid}";

    $result = mysqli_query($con, $sql);
    if ($result == true) {
        $msg = "<p class='alert-success'>Property Updated</p>";
        header("Location:feature.php?msg=$msg");
    } else {
        $error = "<p class='alert-warning'>Property Not Updated</p>";
        header("Location:feature.php?msg=$error");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="images/logo/logo-house.svg">
        <link rel="stylesheet" href="style/submitproperty.css">
        <title>Real Estate Portal</title>
    </head>
    <body>

        <?php include("include/header.php"); ?>

        <div class="container">
            <h2>Submit Property</h2>

            <form method="post" enctype="multipart/form-data">

                <?php
                $pid = $_REQUEST['id'];
                $query = mysqli_query($con, "select * from property where pid='$pid'");
                while ($row = mysqli_fetch_row($query)) {
                    ?>
                    <table>
                        <tr>
                            <td>
                                <label>Title</label>
                                <input type="text" name="title" required value="<?php echo $row['1']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Content</label>
                                <textarea name="content" rows="10" cols="30"><?php echo $row['2']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Property Type</label>
                                <select required name="ptype">
                                    <option value="">Select Type</option>
                                    <option value="appartment">Appartment</option>
                                    <option value="house">House</option>
                                    <option value="commercial property">Commercial property</option>
                                    <option value="office">Office</option>
                                </select>
                            </td>
                            <td>
                                <label>Selling Type</label>
                                <select required name="stype">
                                    <option value="">Select Status</option>
                                    <option value="rent">Rent</option>
                                    <option value="sale">Sale</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Number of rooms</label>
                                <input type="number" name="number_of_rooms" required value="<?php echo $row['4']; ?>">                   
                            </td>
                            <td>
                                <label>Bathroom</label>
                                <input type="number" name="bath" required value="<?php echo $row['6']; ?>">
                            </td>
                        </tr>
                    </table>

                    <h5>Price & Location</h5><hr>
                    <table>
                        <tr>
                            <td>
                                <label>Floor</label>
                                <input type="number" name="floor" required value="<?php echo $row['7']; ?>">
                            </td>
                            <td>
                                <label>Total Floor</label>
                                <input type="number" name="totalfl" required value="<?php echo $row['18']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Price</label>
                                <input type="number" name="price" required value="<?php echo $row['9']; ?>">
                            </td>
                            <td>
                                <label>Area Size</label>
                                <input type="number" name="asize" required value="<?php echo $row['8']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>City</label>
                                <input type="text" name="city" required value="<?php echo $row['11']; ?>">
                            </td>
                            <td>
                                <label>Address</label>
                                <input type="text" name="loc" required value="<?php echo $row['10']; ?>">
                            </td>
                        </tr>
                    </table>

                    <h5>Images</h5><hr>
                    <table>
                        <tr>
                            <td>
                                <label>Image</label>
                                <input name="aimage" type="file" required>
                                <img src="images/property/<?php echo $row['12']; ?>" alt="pimage" height="150" width="180">
                            </td>
                            <td>
                                <label>Image 1</label>
                                <input name="aimage1" type="file" required="">
                                <img src="images/property/<?php echo $row['13']; ?>" alt="pimage" height="150" width="180">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Image 2</label>
                                <input name="aimage2" type="file" required>
                                <img src="images/property/<?php echo $row['14']; ?>" alt="pimage" height="150" width="180">
                            </td>
                            <td>
                                <label>Image 3</label>
                                <input name="aimage3" type="file" required="">
                                <img src="images/property/<?php echo $row['15']; ?>" alt="pimage" height="150" width="180">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label>Image 4</label>
                                <input name="aimage4" type="file" required="">
                                <img src="images/property/<?php echo $row['16']; ?>" alt="pimage" height="150" width="180">
                            </td>
                        </tr>
                        <tr>
                        </tr>
                    </table>
                    <br><input type="submit" value="Submit" name="add" style="margin-left:650px;">
                </form>
                <?php
            }
            ?>
        </div>
        <?php include("include/footer.php"); ?>
    </body>
</html>