<?php
session_start();
include 'config.php';

if(isset($_POST['logout'])){
    session_destroy();
    header("location: update.php");
    exit();
}



$username = $_SESSION['name'];

$sql = "SELECT * FROM `mycrud` WHERE name = '$username'";
$result = mysqli_query($conn, $sql);
$oldinfo = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newname = $_POST['newname'];
    $newemail = $_POST['newemail'];
    $newpassword = $_POST['newpassword'];
    $id = $oldinfo['id'];

    $sql = "UPDATE `mycrud` SET `name` = '$newname', `email` = '$newemail', `password` = '$newpassword' WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $updatesuccess = 'UPDATED SUCCESSFULLY';
    } else {
        $updateerror = 'THERE IS SOME ISSUE' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE HERE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="bg-success text-light p-3">
            WELCOME <?php echo $oldinfo['name']; ?>
        </h1>

        <form action="update2.php" method="post" class="mt-3">
            <div class="mb-3">
                <label for="newname" class="form-label">New Name:</label>
                <input type="text" class="form-control" id="newname" name="newname" value="<?php echo $oldinfo['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="newemail" class="form-label">New Email:</label>
                <input type="email" class="form-control" id="newemail" name="newemail" value="<?php echo $oldinfo['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="newpassword" class="form-label">New Password:</label>
                <input type="password" class="form-control" id="newpassword" name="newpassword" value="<?php echo $oldinfo['password']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Information</button>
            <button class="btn bg-danger text-white" type="submit" name="logout">LOG OUT</button>
        </form>

        <?php
        if (isset($updatesuccess)) {
            echo '<div class="alert-success bg-success text-white text-center mt-3">' . $updatesuccess . '</div>';
        }

        if (isset($updateerror)) {
            echo '<div class="alert-danger bg-danger text-white text-center mt-3">' . $updateerror . '</div>';
        }
        ?>
    </div>
</body>
</html>
