<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>iQues - SignUp</title>
  <style>
    body {
      background-image: url("https://source.unsplash.com/1365x900/?gradients,dark");
    }

    form {
      margin: auto;
      width: 50%;
      border: 3px solid black;
      padding: 10px;
      margin-top: 30px;
      color: white;
      background-color: black;
      opacity: 0.5;
      font-family: cursive;
    }

    h1 {
      text-align: center;
      font-size: 80px;
    }

    button {
      width: 650px;
    }

    button a {
      text-decoration: none;
      color: white;
    }

    button a:hover {
      color: black;
    }

    h6 {
      text-align: center;
    }
  </style>
</head>

<body>
  <?php 
  include "basics/connect.php";
  ?>  

<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'basics/connect.php';
    $user_name = $_POST['username'];
    $user_email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];

    // Check whether this email exists
    $existSql = "select * from `people` where email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email already in use";
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> The user already exists! Please log in to use iQues!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `people` ( `username`, `email`, `password`, `date`) VALUES ( '$user_name', '$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                $showAlert = true;
                session_start();
                $_SESSION['username'] = $user_name;
                $_SESSION['password'] = $pass;
                header("Location: /forum/welcome.php?signupsuccess=true");
                exit();
            }

        }
        else{
            $showError = "Passwords do not match"; 
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> The passwords do not match!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }

}
?>

  <form method="post" action="signup.php">
    <h1>iQues</h1>
    <div class="mb-3">
      <label for="user" class="form-label">Username</label>
      <input type="text" class="form-control" id="user" aria-describedby="emailHelp" name="username">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <label for="inputPassword5" class="form-label">Password</label>
    <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="password">
    <div id="passwordHelpBlock" class="form-text">
      Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </div>
    <label for="pass" class="form-label my-3">Confirm Password</label>
    <input type="password" id="pass" class="form-control" aria-describedby="passwordHelpBlock" name="cpassword">
    <button type="submit" class="btn btn-primary my-3">Sign Up</button>
    <hr>
    <div style="text-align: center; ">
      <a href="login.php" >Log in</a>
    </div>
  </form>

 

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
