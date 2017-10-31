<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">

    <title>My favourite recipes</title>
</head>
 <header class="site-header">
    <nav class="site-nav">
        <ul>
            <li> <a href="index.php">Home</a></li>   
            <li> <a href="#">Favourites</a></li>
            <li> <a href="#">My recipes</a></li>
            <li> <a href="#">Contact</a></li>
        </ul>
    </nav>
  </header>
<main>
    <h1 class="browse-title">My favourite recipes</h1>
    <br>
 	<h3>My favourite recipes</h3>
 	<hr>

<?php
# This is the mysqli version

$searchtitle = "";
$searchauthor = "";

if (isset($_POST) && !empty($_POST)) {
# Get data from form
    $searchtitle = trim($_POST['searchtitle']);
    $searchauthor = trim($_POST['searchauthor']);
}


//	if (!$searchtitle && !$searchauthor) {
//	  echo "You must specify either a title or an author";
//	  exit();
//	}

$searchtitle = addslashes($searchtitle);
$searchauthor = addslashes($searchauthor);

# Open the database
@ $db = new mysqli('localhost:8889', 'root', 'root', 'bread');

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

# Build the query. Users are allowed to search on title, author, or both

$query = " select title, author, onloan, bookid from books where onloan is true";
if ($searchtitle && !$searchauthor) { // Title search only
    $query = $query . " and title like '%" . $searchtitle . "%'";
}
if (!$searchtitle && $searchauthor) { // Author search only
    $query = $query . " and author like '%" . $searchauthor . "%'";
}
if ($searchtitle && $searchauthor) { // Title and Author search
    $query = $query . " and title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
     echo "Running the $query <br/>:";
}


 # Here's the query using an associative array for the results
$result = $db->query($query);
//echo "<p> $result->num_rows matching books found </p>";
//echo "<table border=1>";
while($row = $result->fetch_assoc()) {
//echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
}
//echo "</table>";
 
    $stmt = $db->prepare($query);
    $stmt->bind_result($title, $author, $onloan, $bookid);
    $stmt->execute();

    echo '<table bgcolor="dddddd" cellpadding="6">';
    echo '<tr><b> <td>ID</td> <td>Title</td> <td>Author</td> <td>Reserved?</td> <td>Return</td> </b></tr>';
    while ($stmt->fetch()) {
        if($onloan==0)
            $onloan='No';
        else $onloan='Yes';
        echo "<tr>";
        echo "<td> $bookid </td><td> $title </td><td> $author </td><td> $onloan </td>";
        echo '<td><a href="returnBook.php?bookid=' . urlencode($bookid) . '">Return</a></td>';
        echo "</tr>";      
    }
    echo "</table>";

    $stmt2 = $db->prepare("update onloan set 0 where bookid like ". $bookid);
    $stmt2->bind_result($onloan, $bookid);
    $stmt2->execute();
    ?>

</main>
<?php include("footer.php"); ?>
</body>
</html>