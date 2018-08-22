<?php

// 설정
$uploads_dir = "upload/";
$file_rename =  $_FILES['myfile']['tmp_name'];
// 변수 정리
$name = $_FILES['myfile']['name'];
$target_file = $uploads_dir . basename($_FILES["myfile"]["name"]);
$tmp_name = $_FILES['myfile']['tmp_name'];

// 파일 이동
if(move_uploaded_file($tmp_name, $target_file)){

}
print_r($_FILES);


?>