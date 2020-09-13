<?php

session_start();
include 'partials/_dbconnect.php';

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/stuck overflow">Stuck Overflow</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/stuck overflow">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Top Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

      // LIMIT in sql to limit the queries that number of times
      $sql = "SELECT category_name, category_id FROM `category` LIMIT 6";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result)){
        echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row["category_name"].'</a>';
        
      }
      echo '</div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact</a>
    </li>
  </ul>
  <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
  </form>';
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']!==null && $_SESSION['loggedin']==true){
      echo '<p class="text-light my-0 mx-2"> Welcome '.$_SESSION['useremail'].'</p>\
      <a href="partials/_logout.php" role="button" class="btn btn-outline-success" data-target="#loginModal">Logout</a>
      '; 
  }
  else{
    echo '
    <div class="mx-2">
    <button class="btn btn-outline-success"  data-toggle="modal" data-target="#loginModal">Login</button>
    <button class="btn btn-outline-success"  data-toggle="modal" data-target="#signupModal">Signup</button>';
  }

  echo'</div>
</div>
</nav>';


include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess'])){
  if($_GET['signupsuccess']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You can now login...
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
  }
  else{
    $warn = "Warning Error : ";
    echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
            <strong>'.$warn.'</strong>'.$_GET['error'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
}

else if(isset($_GET['loginsuccess'])){
  if($_GET['loginsuccess']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You are logged in. Welcome.....!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
  }
  else{
    $warn = "Invalid Credentials : ";
    echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
            <strong>'.$warn.'</strong>'.$_GET['error'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
}


?>