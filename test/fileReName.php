<?php
//$tmpfName = tempnam("upload/","hi");
//echo $tmpfName;
//print_r(basename($tmpfName, ".tmp"));
$f = "a.png";
print_r(array_pop(explode(".", $f)));
?>