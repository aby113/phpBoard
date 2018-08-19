<?php

require "boardDAO.php";
$dao = new BoardDAO();
$dao->deleteBoard($_POST["bno"]);
$page = $_POST["page"];
header("Location:list.php?page=$page");

?>