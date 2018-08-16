<?php

require "boardDAO.php";
$dao = new BoardDAO();
$dao->deleteBoard($_POST["bno"]);
header("Location:list.php");

?>