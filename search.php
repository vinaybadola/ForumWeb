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
    #maincontainer {
        min-height: 100vh;
    }
    </style>
    <title>iDiscuss - Coding Forums</title>
</head>

<body>

    <?php include 'partials/_dbconnect.php' ?>
    <!--- (_dbconnect)underscore use here for private files-->
    <?php include 'partials/_header.php' ?>


    <!--- search results------>

    <div class="container my-3" id="maincontainer">
        <h1 class="py-3">Search results for <em>"<?php echo $_GET['search']?>"</em></h1>


        <!--- logic for pulling search results . Basically first we declare $noresults = true then we select * from threads table where match ( thread-title, thread_desc)
            then we fetch results from our database table. If we are getting results from our database in while loop then we called $noresults = false and exit form our loop
            and display results otherwise it will show no results found.----->
        <?php
        $noresults = true;
        $querry = $_GET["search"];

    $sql =  $sql = "select * from threads where match (thread_title, thread_desc) against ('$querry')"; 
    $result= mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
    $title = $row['thread_title'];
    $desc = $row['thread_desc'];
    $thread_id = $row['thread_id'];
    $url = "thread.php?threadid=" . $thread_id ; // so our comments and thread are shown in thread.php page so we use that page url and we also use thread_id which we take
                                                    //  from our database table to make that error clickable so that user can click on that and directly check the full 
                                                    // error description in thread.php page.
                                                                    
    $noresults = false;

    
   // Display the search result
   echo ' <div class="result">
   <h3><a href="'. $url. '" class="text-dark">'. $title. '</a> </h3>
   <p>'. $desc .'</p>
</div>
</div>';
 
}
if ($noresults){
    echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p class="display-4">No Results Found</p>
                <p class="lead"> Suggestions: <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords. </li></ul>
                </p>
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