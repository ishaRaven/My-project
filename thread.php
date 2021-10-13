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
  <?php include 'basics/nav.php' ?>
  <?php include 'basics/connect.php' ?>
  <?php
    $id = $_GET['catid'];
    $showResult = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
      $thread_title = $_POST['title'];
      $thread_desc = $_POST['desc'];
      $sqli = "INSERT INTO `thread` ( `thread_name`, `thread_desc`, `thread_cat_id`, `date`) VALUES ( '$thread_title', '$thread_desc', '$id', current_timestamp())";
      $result1 = mysqli_query($conn, $sqli);
      $showResult = true;
    };
    if ($showResult) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Success!</strong> Your thread has been successfully added!
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
    }; 
    ?>
  <?php
  // $id = $_GET['catid'];
  $sql = "SELECT * FROM `categories` WHERE cat_id = $id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $title = $row['cat_name'];
    $desc = $row['cat_desc'];
    echo '
    <div id="main">
        <h1>' . $title . '</h1>
        <p>' . $desc . '</p>
        <hr>
       <button type="submit"> <a href="https://en.wikipedia.org/wiki/Python_(programming_language)">see more...</a></button>
    </div>';
  }
  ?>
  
 
  <div id="ques">
    <h3>Start a discussion</h3>
    <hr>
    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Thread Title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Thread Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"></textarea>
      </div>
      <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
    </form>
    <h4 class="my-3">Browse Questions</h4>
    <hr>
    
    <?php
    $sql = "SELECT * FROM `thread` WHERE thread_cat_id = $id";
    $result = mysqli_query($conn, $sql);
    $noresult = true;
    while ($row = mysqli_fetch_assoc($result)){
      $thread_title = $row['thread_name'];
      $noresult = false;
      $thread_desc = $row['thread_desc'];
      $comment_id = $row['sno'];
      $time = $row['date'];
      echo '
      <div id="show">
  <div class="d-flex">
  <div class="flex-shrink-0">
    <img src="https://pbs.twimg.com/profile_images/789138937574981632/Us7EZG3q_400x400.jpg" alt="...">
  </div>
  <div class="flex-grow-1 ms-3">
  <h6 style="float: right;">By Anonymus on '.$time.'</h6>
    <a id="thread_tit" href="comments.php?comment_id='.$comment_id.'"><h6>' . $thread_title . '</h6></a>
    <p style="font-size: 10px;">' . substr($thread_desc, 0, 60) . '...</p>
  </div>
  </div>';
    }
    if ($noresult) {
      echo '<div id="noresult">
      <h4>No Discussion</h4>
      <hr>
      <p>Be the first one to start a discussion!!</p>     
      </div>';
    }
    ?>
  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>