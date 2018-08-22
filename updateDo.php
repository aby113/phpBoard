<?php
require "boardDAO.php";
require "page.php";
$bno = $_POST["bno"];
$title = $_POST["title"];
$writer = $_POST["writer"];
$content = $_POST["content"];
$page = $_POST["page"];
$dao = new BoardDAO();
$dao->updateBoard($title, $content, $bno, $_POST["file_url"]?? null);
$cri = new Criteria();
Criteria::setParam($cri);
header("Location:read.php" . Criteria::mkSearchUrl($cri) . "&bno={$bno}");
?>