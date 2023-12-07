
<?php

 include 'config.php';

 $deleteerror = '';
 $deletesuccess = '';

 if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $delete = $_POST['delete'];

  $sql = "DELETE FROM mycrud WHERE `mycrud`.`id` = '$delete'";
  $result = mysqli_query($conn,$sql);
  if($result){
    $deletesuccess = 'DATA DELETED SUCCESSFULLY';
  }else{
    $deleteerror = 'FACING SOME ISSUES';
  }
 }



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>READ YOUR INFO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<?php if($deleteerror) : ?>
    <div class='container alert alert-danger'>
        <?php echo $deleteerror; ?>
    </div>
<?php endif; ?>

    <?php if($deletesuccess) : ?>
    <div class='container alert alert-success'>
        <?php echo $deletesuccess; ?>
    </div>
<?php endif; ?>



<table class="table container text-center bg-light">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">EMAIL</th>
      <th scope="col">PASSWORD</th>
      <th scope="col">ACTIONS</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $sql = "SELECT * FROM `mycrud`";
     $result = mysqli_query($conn,$sql);
     while($row = mysqli_fetch_assoc($result)){?>
    <tr>
      <th scope="row"><?php echo $row ['id'];?></th>
      <td><?php echo $row ['name'];?></td>
      <td><?php echo $row ['email'];?></td>
      <td><?php echo $row ['password'];?></td>
      <td>
        <form action="" method='post'>
          <input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>


</body>
</html>