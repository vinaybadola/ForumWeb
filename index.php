<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
          #ques{
              min-height: 433px;
          }
      </style>
    <title>OnlyCodes - Coding Forums</title>
</head>

<body>
    
    <?php include 'partials/_dbconnect.php' ?> <!--- (_dbconnect)underscore use here for private files-->
    <?php include 'partials/_header.php' ?>
    <!----slider---->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://i.postimg.cc/5t6jn6r9/iDiscuss.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://i.postimg.cc/y8NN8Dsh/php-IDiscuss.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://i.postimg.cc/NFgcCn08/error-3060993-1280.png" height ="300"  alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <!-----Categories container starts here------>
        <div class="container my-3" id = "ques">
            <h2 class="text-center my-3"> OnlyCodes - Browse Categories</h2>
            <!.... for centering text....>
                <div class="row my-3">
                   <!------Fetch all the categories----->
                   <?php
                    $sql = "SELECT * FROM `categories`";
                    $result = mysqli_query($conn , $sql);
                    while($row = mysqli_fetch_assoc($result)){
                      //echo $row['category_id'];
                      //echo $row['category_name'];
                      $id = $row['category_id'];
                      $cat = $row['category_name']; // declaring $cat var for category name
                      $desc = $row['category_description'];
                      echo'<div class="col-md-4 my-2">
                      <div class="card" style="width: 18rem;">
                          <img src="https://source.unsplash.com/500x400/?' . $cat .' ,CODING" class="card-img-top"
                              alt="">
                          <div class="card-body">
                              <h5 class="card-title"> <a href ="threadlist.php?catid= ' . $id . '">' . $cat . '</a> </h5>
                              <p class="card-text"> ' . substr($desc,0,90) . '........</p>
                              <a href="threadlist.php?catid= ' . $id . ' "" class="btn btn-primary"> view threads</a>
                          </div>
                      </div>
                  </div>';


                    }

                   ?>

                    




                </div>
        </div>

        <?php include 'partials/_footer.php' ?> 
       


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
</body>

</html>