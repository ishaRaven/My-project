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
        body {
            background: black;
            font-family: cursive;
        }

        h1 {
            text-align: center;
            color: white;
        }

        .cardIn {
            margin: 70px;
            display: grid;
            grid-template-columns: auto auto auto;
            grid-gap: 10px;
        }

        .cards {
            background-color: white;
            color: black;
        }
        h2{
            margin-top: 50px;
            text-align: center;
            color: white;
        }
    </style>
</head>

<body>
    <?php include "basics/nav.php" ?>
    <?php include "basics/connect.php" ?>
    <?php  
    session_start();
    echo '<h1 class="my-3">Welcome to iQues '.$_SESSION['username'].'</h1>'
    ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1365x500/?code,python" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1365x500/?code,java" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1365x500/?code,php" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1365x500/?code,javascript" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div style="width: 50%; margin:auto; padding:20px;">
    <h2>Browse Here</h2>
    <hr style="color: white;">
    </div>
    <div class="cardIn">
        <?php 
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['cat_name'];
            $desc = $row['cat_desc'];
            $id = $row['cat_id'];
        echo '<div class="card my-5" style="width: 18rem;">
            <img src="https://source.unsplash.com/300x200/?code,'.$title.'" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">'.$title.'</h5>
                <p class="card-text">'.substr($desc , 0 , 80).'...</p>
                <a href="thread.php?catid='.$id.'" class="btn btn-primary">Browse</a>
            </div>
        </div>';
        };
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
