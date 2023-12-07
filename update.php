
<?php


 include 'config.php';
 $invalid = '';
 $name = '';
 $password = '';
 $namealert = '';
 $passwordalert = '';

 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $password = $_POST['password'];
    if(empty($name)){
        $namealert = 'ENTER USERNAME';
    }elseif(empty($password)){
        $passwordalert = 'ENTER PASSWORD';
    }else{

    $sql = "SELECT * FROM `mycrud` WHERE name = '$name' AND password = '$password'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) == 1){
        session_start();
        $row = mysqli_fetch_assoc($result);
        $_SESSION['name'] = $row['name'];
        $_SESSION['password'] = $row['password'];
        header ("location: update2.php"); 
        exit();
    }else{
        $invalid = "Invalid username or password";
    }
}
 }





?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE YOUR INFO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>


      <div class="container bg-success text-white text-center rounded">
        <h1>LOGIN TO CHANGE YOUR INFORMATION</h1>
      </div>



    <form action="update.php" method="post" class="container mt-5">
    <div class="alert-danger bg-danger text-white text-center">
        <?php echo $invalid;  ?>
      </div>


    <div class="mb-3">
  <label for="username" class="form-label">Username</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="name" 
  value = "<?php echo $name; ?>">
  <div class='alert-danger bg-danger text-white text-center'>
    <?php  echo $namealert;   ?>
  </div>
</div>

<div class="mb-3">
  <label for="inputPassword" class="form-label">Password</label>
  <input type="password" name="password" class="form-control" id="inputPassword"
  value = "<?php echo $password; ?>">
  <div class='alert-danger bg-danger text-white text-center'>
    <?php  echo $passwordalert;   ?>
  </div>
</div>

<button type="submit" class="btn btn-primary">GO NEXT</button>




    </form>
</body>
</html>