<?php
$a = "가";
switch($a){
    case "나":echo '나';
    break;
    case '0':echo "0";
    break;
    case "가":echo "가";
}

?>

<?php 
$browserName = 'mozilla'; 
switch ($browserName) { 
  case 'opera': 
    echo 'opera'; 
  break; 
  case "mozilla": 
    echo "1"; 
  break; 
  case 'konqueror': 
    echo 'Konqueror'; 
  break; 
  default: 
    echo 'Default'; 
  break; 
} 
?> 