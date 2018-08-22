<?php
// 업로드 패스
define("UPLOAD_DIR", "uploads/");
class FileUtils
{
    // 파일경로, 유일한 파일명, 확장자 를 구해서 새로운 파일명을 만든다음 해당 디렉터리로 옮긴다.
    public static function uploadFile($fileName):string
    {
        
        $fileUName = basename($_FILES[$fileName]['tmp_name'], ".tmp");
        $tmpArr = explode(".", basename($_FILES[$fileName]['name']));
        $ext = "." . array_pop($tmpArr);
        $fileFullName = UPLOAD_DIR . $fileUName . $ext;
        if(!move_uploaded_file($_FILES[$fileName]['tmp_name'], $fileFullName)){
            print_r($_FILES[$filename]);
        }

        return $fileFullName;
    }

}
