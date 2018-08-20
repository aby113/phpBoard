<?php

require "boardDAO.php";
require "page.php";
$dao = new BoardDAO();
$dao->deleteBoard($_POST["bno"]);
$cri = new Criteria();
Criteria::setPostParam($cri);
header("Location:list.php" . Criteria::mkSearchUrl($url));

?>