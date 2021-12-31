<!doctype html>
<html lang="en">

<head>
<script>
function validateForm() {
  var x = document.forms["myForm"]["title"].value;
  if (x == "" || x == null) {
    alert("Please enter the valid statement!");
    return false;
  }
}
</script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
    <title>iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/_header.php' ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE  category_id =$id";
    $result= mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //Insert into thread db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<" , "&lt;", $th_title);
        $th_title = str_replace(">","&gt",$th_title);



        $th_desc = str_replace("<" , "&lt;", $th_desc);
        $th_desc = str_replace(">","&gt",$th_desc);




        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result= mysqli_query($conn,$sql);
        $showAlert = true;
        if($showAlert){
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>SUCCESS!</strong>  Your thread has been added . Please wait for community to respond.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
            
        }

    }


       
    ?>


    <!----Category container starts here--->

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname;?></h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
     echo '<div class="container">
    <h1 class="py-3">Start a Discussion</h1>
    <form name ="myForm"  action = "' .  $_SERVER["REQUEST_URI"] . '"  onsubmit = "return validateForm()"method = "post" required>
            <div class="form-group">
                <label for="exampleInputEmail1"> ProblemTitle</label>
                <input type="text" class="form-control" id="title" name = "title" aria-describedby="title"
                    placeholder="title">
                <small id="emailHelp" class="form-text text-muted">Keep Your title as short and crisp as
                    possible.</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborate your problem</label>
                <textarea class="form-control" id="desc" name = "desc" rows="3"></textarea>
                <input type = "hidden" name="sno" value="' .$_SESSION["sno"].'">
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    } 
    else{
        echo '<div class="container">
        <h1 class="py-3">Start a Discussion</h1>
        <p class = "lead"> You are not logged in . Please login to be able to start a Discussion</p>
    </div>';
    }

    ?>


    <div class="container " id="ques">
        <h1 class="py-3">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $noResult = true;
        $result= mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc= $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id']; 
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
       
        
        
        
         echo'<div class="media my-3">
  <img class="mr-3" src="https://i.postimg.cc/TPXD0BC8/Men-Profile-Image-PNG.png" width = "44px" alt="Generic placeholder image">
  <div class="media-body">' .
  
   ' <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $id .'">'.   $title . '</a></h5>
    '. $desc . '</div>' .' <div class = "font-weight-bold my-0">  Asked By: '.  $row2['user_email'] . ' at '.  
    $thread_time . '</div> '.
 '</div>';

}
   // echo var_dump($noResult);
   if($noResult){
       echo' <div class="jumbotron jumbotron-fluid">
       <div class="container">
         <p class="display-4">No Threads Found</p>
         <p class="lead">Be the first person to ask a question</p>
       </div>
     </div>';
   }
 ?>


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