




<?php

 include 'config.php';
 $name = '';
 $password = '';
 $email = '';
 $namealert = '';
 $passwordalert = '';
 $emailalert = '';
 $useralert = '';
 $signupalert = '';



if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $name = $_POST['name'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if(empty($name)){
    $namealert = 'ENTER NAME';
  }elseif(empty($password)){
    $passwordalert = 'ENTER PASSWORD';
  }elseif(empty($email)){
    $emailalert = 'ENTER EMAIL';
  }else{
    $check = "SELECT * FROM `mycrud` WHERE name = '$name'";
    $checkresult = mysqli_query($conn,$check);
    if(mysqli_num_rows($checkresult) > 0){
      $useralert = 'THIS USER ALREADY EXISTS';
    }else{
      $sql = "INSERT INTO `mycrud` (`email`, `password`, `datetime`, `name`) VALUES ('$email', '$password', current_timestamp(), '$name')";
      $result = mysqli_query($conn,$sql);
      if($result){
        $signupalert = 'SIGNUP SUCCESSFULLY';
        $name = '';
        $password = '';
        $email = '';
      }else{
        echo 'ERROR IN INSERING DATA' . mysqli_error($conn);
      }
    }
  }

}






?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <form action="create.php" method="post">
    <div class="alert-success bg-success text-white text-center">
        <?php echo $signupalert;  ?>
      </div>
      <div class="alert-danger bg-danger text-white text-center">
        <?php echo $useralert;  ?>
      </div>
    <div class="mb-3">
  <label for="username" class="form-label">Name </label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="name" 
  value='<?php echo $name ?>'>
  <div class='alert-danger bg-danger text-white text-center'>
    <?php  echo $namealert;   ?>
  </div>
</div>
  <!-- </div> -->
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" name="email" 
  value='<?php echo $email ?>'>
  <div class='alert-danger bg-danger text-white text-center'>
    <?php  echo $emailalert;   ?>
  </div>
</div>
<div class="mb-3">
  <label for="inputPassword" class="form-label">Password</label>
  <input type="password" name="password" class="form-control" id="inputPassword" 
  value='<?php echo $password ?>'>
  <div class='alert-danger bg-danger text-white text-center'>
    <?php  echo $passwordalert;   ?>
  </div>
</div>

  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</body>
</html>



