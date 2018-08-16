<?php
require "boardDAO.php";
$bno = $_POST["bno"];
$title = $_POST["title"];
$writer = $_POST["writer"];
$content = $_POST["content"];

$dao = new BoardDAO();
$dao->updateBoard($title, $content, $bno);

header("Location:read.php?bno={$bno}");
?>