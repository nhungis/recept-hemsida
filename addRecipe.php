<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include ("config.php");


$fishid = trim($_GET['fishid']);
echo '<INPUT type="hidden" name="fishid" value=' . $fishid . '>';

$fishid = trim($_GET['fishid']);      // From the hidden field
$fishid = addslashes($fishid);

@ $db = new mysqli('localhost:8889', 'root', 'root', 'bread');

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo "You are adding a recipe with the ID:"           .$fishid;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE fish SET onloan=1 WHERE fishid = ?");
    $stmt->bind_param('i', $fishid); #lagt tilll author och title
    $stmt->execute();
    printf("<br>Recipe added!");
    printf("<br><a href=index.php>Search more recipes </a>");
    printf("<br><a href=favouriteRecipes.php>Return to favourite recipes </a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;
    

