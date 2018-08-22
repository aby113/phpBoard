<?php

require "boardDAO.php";
try{
    $dao = new BoardDAO();
    $dao->insertBoard($_POST["title"], $_POST["writer"], $_POST["content"], $_POST["file"]?? null);             
}catch(Exception $e){
   print $e->getMessage();
}

header("Location: list.php");

?>