<?php
require "boardDAO.php";
require "page.php";
$bno = $_POST["bno"];
$title = $_POST["title"];
$writer = $_POST["writer"];
$content = $_POST["content"];
$page = $_POST["page"];
$dao = new BoardDAO();
$dao->updateBoard($title, $content, $bno);
$cri = new Criteria();
Criteria::setPostParam($cri);
header("Location:read.php" . Criteria::mkSearchUrl($url) . "&bno={$bno}");
?>