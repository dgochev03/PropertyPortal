<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("config.php");
if (!isset($_SESSION['uemail'])) {
    header("location:login.php");
}

if (isset($_POST['add'])) {
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


    $sql = "insert into property (title,pcontent,type,number_of_rooms,stype,bathroom,floor,size,price,location,city,pimage,pimage1,pimage2,pimage3,pimage4,uid,totalfloor)
	values('$title','$content','$ptype','$number_of_rooms','$stype','$bath','$floor','$asize','$price',
	'$loc','$city','$aimage','$aimage1','$aimage2','$aimage3','$aimage4','$uid','$totalfloor')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $msg = "<p class='alert-success'>Property Inserted Successfully</p>";
    } else {
        $error = "<p class='alert-warning'>Property Not Inserted Some Error</p>";
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
            <?php if (isset($msg))
                echo $msg;
            else if (isset($error))
                echo $error;
            ?>

            <form method="post" enctype="multipart/form-data">

                <h5>Property Details</h5><hr>
                <table>
                    <tr>
                        <td>
                            <label>Title</label>
                            <input type="text" name="title" required placeholder="Enter Title">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Content</label>
                            <textarea name="content" rows="10" cols="30"></textarea>
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
                            <input type="number" name="number_of_rooms" required placeholder="Enter number of rooms (only no 1 to 10)">                    
                        </td>
                        <td>
                            <label>Bathroom</label>
                            <input type="number" name="bath" required placeholder="Enter Bathroom (only no 1 to 10)">
                        </td>
                    </tr>
                </table>

                <h5>Price & Location</h5><hr>
                <table>
                    <tr>
                        <td>
                            <label>Floor</label>
                            <input type="text" name="floor" required placeholder="Enter Floor">
                        </td>
                        <td>
                            <label>Total Floor</label>
                            <input type="text" name="totalfl" required placeholder="Enter Total Floors">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                            <input type="text" name="price" required placeholder="Enter Price in EUR">
                        </td>
                        <td>
                            <label>Area Size</label>
                            <input type="text" name="asize" required placeholder="Enter Area Size (in sq.m.)">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>City</label>
                            <input type="text" name="city" required placeholder="Enter City">
                        </td>
                        <td>
                            <label>Address</label>
                            <input type="text" name="loc" required placeholder="Enter Address">
                        </td>
                    </tr>
                </table>

                <h5>Images</h5><hr>
                <table>
                    <tr>
                        <td>
                            <label>Image</label>
                            <input name="aimage" type="file" required>
                        </td>
                        <td>
                            <label>Image 1</label>
                            <input name="aimage1" type="file" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Image 2</label>
                            <input name="aimage2" type="file" required>
                        </td>
                        <td>
                            <label>Image 3</label>
                            <input name="aimage3" type="file" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Image 4</label>
                            <input name="aimage4" type="file" required>
                        </td>
                    </tr>
                    <tr>
                    </tr>
                </table>

                <input type="submit" value="Submit" name="add" style="margin-left:650px;">

            </form>
        </div>

        <?php include("include/footer.php"); ?>

    </body>
</html>