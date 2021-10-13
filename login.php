<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iQues - login</title>
    <style>
        body{
            background-image: url("https://source.unsplash.com/1365x900/?gradients,dark");
        }
        form {
            margin: auto;
            width: 50%;
            border: 3px solid black;
            padding: 10px;
            margin-top: 150px;
            color: white;
            background-color: black;
            opacity: 0.5;
            font-family: cursive;
        }

        h1 {
            text-align: center;
            font-size: 80px;
        }
        button{
            width: 650px;
        }
        button a{
            text-decoration: none;
            color: white;
        }
        button a:hover{
            color: black;
        }
        h6{
            text-align: center;
        }
    </style>
</head>

<body>

   <?php 
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "basics/connect.php";
        $user_name = $_POST['username'];
        $pass = $_POST['password'];

        $sql = " SELECT * FROM `people` WHERE username = '$user_name' ";
        $result = mysqli_query($conn , $sql);
        $numRows = mysqli_num_rows($result);
        if($numRows == 1){
            while($row = mysqli_fetch_assoc($result)){
                $cpass = $row['password'];
                if (password_verify($pass , $cpass)){
                    session_start();
                    $_SESSION['username'] = $user_name;
                    header("Location: /forum/index.php?");
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> The password is incorrect !!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }
            }
            
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> The user does not exist! Please sign up to use iQues!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }  
   ?>
    <form method="post" action="login.php">
        <h1>iQues</h1>
        <div class="mb-3 my-5">
            <!-- <label for="exampleInputEmail1" class="form-label">Username</label> -->
            <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="username">
        </div>
        <div class="mb-3">
            <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="password">
        </div>
        <button type="submit" class="btn btn-primary">Log In</button>
        <hr>
        <h6>Don't have an account? <a href="signup.php">Sign up.</a> </h6>
    </form>
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>