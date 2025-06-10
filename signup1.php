<?php

  $showAlert=false;
  $showError=false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  include 'partials/_dbconnect.php';
  $username=$_POST["username"];
  $password=$_POST["password"];
  $cpassword=$_POST["cpassword"]; 
  // $exists=false;



  //check whether this username exists
  $existSql= "SELECT * FROM `users` where username='$username'";
  $result=mysqli_query($conn,$existSql);
  $numExistRows=mysqli_num_rows($result);

  if($numExistRows>0){
    $exists=true;
    $showError="username is already exists";

  }else{
    $exists=false;
  
        if(($password == $cpassword)){
          $hash=password_hash($password,PASSWORD_DEFAULT);
          $sql= "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
          $result = mysqli_query($conn,$sql);
          if($result){
            $showAlert=true;
          }
        }
        else{
          $showError="password does not match!";
        }
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>SignUp!</title>
<!-- 
    <style>
    .after-navbar-bg {
    background-image: url('bg.jpg'); /* Replace with your image path */
    background-size: cover;
    background-position: center;
    height: 300px; /* Adjust the height */
    width: 100%;
  } -->
</style>
    
  </head>
  <body >


    <?php
      require 'partials/_nav.php';
    ?>

    <?php

    if($showAlert){
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your account has been created!! now you have to login.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';}

    if($showError){
      echo '
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';}
    ?>

    <div class="after-navbar-bg  my-4 ">
        <h1 class="text-center">Signup to our website</h1>

        <form action="/loginsystem/signup1.php" method="post" style="width:905px; margin-left:380px;">
            <div class="form-group">
                <label for="username">username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" maxlength="23" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm-Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            
            <button type="submit" class="btn btn-primary ">Signup</button>
        </form>

      

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>