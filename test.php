<?php
print_r($_GET);
if(!isset($_GET["a"])) echo "a is set\n";
if(empty($_GET["a"])) echo "a is not empty";
?>
?>