<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>게시판</title>
    <link rel="shortcut icon" type="image⁄x-icon" href="images/board.png">
    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
   
<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
   
   <style>
   button{
       float: right;
   }
    
    </style>
</head>
<?php

Session_start();
if(isset($_SESSION["login"])){
    $nickname = $_SESSION["login"]['0']['nickname'];
}

?>

<body>
    <div class="container">
        <header>
            <div class="page-header">
                <h1>글쓰기</h1>
            </div>

        </header>


        <section>
            <form action="writeDo.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="">제목</label>
                    <input class="form-control" type="text" name="title">
                </div>
                <div class="form-group">
                    <label for="">작성자</label>
                    <input class="form-control" type="text" name="writer" value="<?=$nickname?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="">파일</label>
                    <input type="file" name="file" id="" class="form-control">
                </div>
                <div class="form-group">
                        <label for="" style="
                        vertical-align: top;">내용</label>
                    <textarea class="form-control" name="content" id="summernote" cols="30" rows="10"></textarea>
                </div>
             <button type="button" class="btn btn-danger canceil">취소</button>
             <button type="submit" class="btn btn-primary">저장</button>
            </form>
        </section>

    </div>



    <script>
    $(function(){
        
        $("#summernote").summernote();

        $(".canceil").click(function(){
            window.history.back();
        });

        



    });
    
    
    </script>
</body>

</html>