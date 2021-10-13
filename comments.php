<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iQues</title>
    <style>
    #main {
      margin: auto;
      padding: 20px;
      width: 50%;
      border: 4px solid grey;
      margin-top: 40px;
    }
    #noresult {
      margin: auto;
      padding: 20px;
      width: 100%;
      background-color: lightgrey;
    }

    #ques {
      margin: auto;
      padding: 20px;
      width: 50%;
    }

    a {
      text-decoration: none;
      color: white;
    }

    button {
      background-color: black;
    }

    img {
      height: 50px;
      width: 50px;
      border-radius: 50%;
    }
    #show{
      width: 100%;
    }
    #thread_tit{
      color: black;
    }
    #thread_tit:hover{
      color: green;
    }
    </style>
  </head>
  <body>
    <?php 
      include "basics/nav.php";
      include "basics/connect.php";
    ?>

<?php
    $com_id = $_GET['comment_id'];
    $showResult = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
      $comment_title = $_POST['title'];
      $comment_desc = $_POST['desc'];
      $sqli = "INSERT INTO `comment` ( `comment_name`, `comment_desc`, `com_id` , `date`) VALUES ( '$comment_title', '$comment_desc', $com_id , current_timestamp())";
      $result1 = mysqli_query($conn, $sqli);
      $showResult = true;
    };
    if ($showResult) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Success!</strong> Your comment has been successfully added!
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
    }; 
    ?>

    <?php 
    $sql="SELECT * FROM `thread` WHERE sno = $com_id";
    $result = mysqli_query($conn , $sql);
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_name'];
        $desc = $row['thread_desc'];
        echo '
    <div id="main">
        <h1>' . $title . '</h1>
        <hr>
        <p>' . $desc . '</p>
        </div>';
    };
    ?>
    
 
  <div id="ques">
    <h3>Write a solution</h3>
    <hr>
    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Comment Title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Comment Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"></textarea>
      </div>
      <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
    </form>
    <h4 class="my-3">Browse Solutions</h4>
    <hr>
    
    <?php
    $sql = "SELECT * FROM `comment` WHERE com_id = $com_id";
    $result = mysqli_query($conn, $sql);
    $noresult = true;
    while ($row = mysqli_fetch_assoc($result)) {
      $comment_title = $row['comment_name'];
      $noresult = false;
      $comment_desc = $row['comment_desc'];
      echo '
      <div id="show">
  <div class="d-flex">
  <div class="flex-shrink-0">
    <img src="https://pbs.twimg.com/profile_images/789138937574981632/Us7EZG3q_400x400.jpg" alt="...">
  </div>
  <div class="flex-grow-1 ms-3">
  <h6 style="float: right;">By Anonymus</h6>
    <h6>' . $comment_title . '</h6>
    <p style="font-size: 10px;">' .$comment_desc. '</p>
  </div>
  </div>';
    }
    if ($noresult) {
      echo '<div id="noresult">
      <h4>No Solutions</h4>
      <hr>
      <p>Be the first one to write a Solution!!</p>     
      </div>';
    }
    ?>
  </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>