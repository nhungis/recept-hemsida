<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
   <link rel="stylesheet" type="text/css" href="style.css">
=======
   <link rel="stylesheet" type="text/css" href="main.css">
>>>>>>> origin/master
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">

    <title>Recept</title>
</head>
 <header class="site-header">
    <nav class="site-nav">
        <ul>
            <li><p class="fish-logga">bread.</p></li>
<<<<<<< HEAD
            <li> <a href="index.php">Home</a></li>   
            <li> <a href="favouriteRecipes.php">Favourites</a></li>
=======
            <li> <a href="index.html">Home</a></li>   
            <li> <a href="#">Favourites</a></li>
>>>>>>> origin/master
            <li> <a href="#">My recipes</a></li>
            <li> <a href="#">Contact</a></li>
        </ul>
    </nav>
<<<<<<< HEAD
  </header> 
    
  <div id="fish">
    <h1 class="fish-title">fish&seafood</h1> 

    <div class="wrap">
      <p class="search-title">Search recipe</p>
        <div class="search">
        <form action="fisk.php" method="POST">
          <label for="searchtitle">Search after recipe</label>
          <input type="text" class="searchTerm" id="searchtitle" name="searchtitle">
          <button type="submit" class="searchButton">
            <img src="img/magnifying.png" class="magnify"/>
          </button>
        </form>
    </div>

    <div class="search">
        <form action="fisk.php" method="POST">
          <label for="searchingredients">Search after ingredients</label>
          <input type="text" class="searchTerm" id="searchingredients" name="searchingredients">
          <button type="submit" class="searchButton">
            <img src="img/magnifying.png" class="magnify"/>
          </button>
        </form>
    </div>
  </div>
=======
     </header> 
    
    <div id="fish">
    <h1 class="fish-title">fish&seafood</h1> 
  <div class="wrap">

  <p class="search-title">Search recipe</p>
   <div class="search">
    <form action="browse.php" method="POST">
   <!---<label for="searchtitle">Title</label>--->
      <input type="text" class="searchTerm" id="searchtitle" placeholder="Search recipes">
      <button type="submit" class="searchButton">
        <!--<i class="fa fa-search"></i>-->
        <img src="img/magnifying.png" class="magnify"/>
     </button>
   </div>
</div>
>>>>>>> origin/master
</div><!---end fish-->

<body>
  <h1 class="fish-recipe">Recipes</h1>

  <div class="bigfish-container">

  <div class="fish-container">
  <img img src="img/bg/fisk1.jpg" class="fish-image">
    <!--<div class="fish-text"><a href="fisk.html">Fishy fish</a></div>-->
  <p class="fish-rubrik">Titel</p>
</div><!--end container-->

<div class="fish-container">
  <img img src="img/bg/fisk2.jpg" class="fish-image">
    <!--<div class="fish-text"><a href="stek.html">Steak</a></div>-->
  <p class="fish-rubrik">Titel</p>
</div><!--end container-->

<div class="fish-container">
  <img img src="img/bg/fisk3.jpg" class="fish-image">
    <!--<div class="fish-text"><a href="kyckling.html">Chicken</a></div>-->
    <p class="fish-rubrik">Titel</p>
</div><!--end container-->

</div><!--end bigfish-container-->

<?php

$searchtitle = "";
$searchingredients = "";

if (isset($_POST) && !empty($_POST)) {
    $searchtitle = trim($_POST['searchtitle']);
    $searchingredients = trim($_POST['searchingredients']);
}

//  if (!$searchtitle && !$searchauthor) {
//    echo "You must specify either a title or an author";
//    exit();
//  }

$searchtitle = addslashes($searchtitle);
$searchingredients = addslashes($searchingredients);
#lägga in htmlentities här

# Open the database
@ $db = new mysqli('localhost:8889', 'root', 'root', 'bread');

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

# Build the query. Users are allowed to search on title, author, or both

$query = " select * from fish";
if ($searchtitle && !$searchingredients) { // Title search only
    $query = $query . " where title like '%" . $searchtitle . "%'";
}
<<<<<<< HEAD
if (!$searchtitle && $searchingredients) { // Author search only
=======
if (!$searchtitle && $searchauthor) { // Author search only
>>>>>>> origin/master
    $query = $query . " where ingredients like '%" . $searchingredients . "%'";
}
if ($searchtitle && $searchingredients) { // Title and Author search
    $query = $query . " where title like '%" . $searchtitle . "%' and ingredients like '%" . $searchingredients . "%'";
    echo "Running the $query <br/>:";
        
}



  # Here's the query using an associative array for the results
//$result = $db->query($query);
//echo "<p> $result->num_rows matching books found </p>";
//echo "<table border=1>";
//while($row = $result->fetch_assoc()) {
//echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
//}
//echo "</table>";
 

# Here's the query using bound result parameters
    //echo "we are now using bound result parameters <br/>";
    $stmt = $db->prepare($query);
<<<<<<< HEAD
    $stmt->bind_result($fishid, $title, $ingredients, $onloan);
=======
    $stmt->bind_result($fishid, $title, $ingredients); #tagit bort $borrowerid
>>>>>>> origin/master
    $stmt->execute();


    echo '<table bgcolor="#dddddd" cellpadding="6">';
<<<<<<< HEAD
    echo '<tr><b> <td>ID</td> <td>Title</td> <td>Ingredients</td> <td>Added?</td> <td>Add to favourites</td> </b> </tr>';
    while ($stmt->fetch()) {
      if($onloan == 0)
            $onloan='No';
        else $onloan='Yes';
        echo "<tr>";
        echo "<td> $fishid </td> <td> $title </td> <td> $ingredients </td> <td> $onloan </td>";
        echo '<td><a href="addRecipe.php?fishid=' . urlencode($fishid) . '"> Add </a> </td>';
=======
    echo '<tr><b> <td>ID</td> <td>Title</td> <td>Ingredients</td> </b> </tr>';
    while ($stmt->fetch()) {
        echo "<tr>";
        echo "<td> $fishid </td> <td> $title </td><td> $ingredients </td>";
        echo '<td><a href="fish.php?fishid=' . urlencode($fishid) . '"></td>';
>>>>>>> origin/master
        echo "</tr>";
    }
    echo "</table>";
    ?>
    
  </main>
  </div>

</body>
</html>
    
<footer>
    <p> Copyright, Ellinor Ek, Fannie Pihl, Nhung Vu, 2017.</p>
</footer>