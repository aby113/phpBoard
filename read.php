<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>게시판</title>
    <link rel="shortcut icon" type="image⁄x-icon" href="images/board.png">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>



    <style>
        button {
            float: right;
        }
        section{
    margin-top: 100px;
}
    </style>
</head>
<?php
Session_start();
require "boardDAO.php";
require "page.php";
$dao = new BoardDAO();
$vo = $dao->getBoard($_GET["bno"]);

$title = $vo['title'];
$content = $vo['content'];
$writer = $vo['writer'];
$fileURL = $vo['file_url'];
$cri = new Criteria();
Criteria::setParam($cri);
$nickname = "";
if (isset($_SESSION["login"])) {
    $nickname = $_SESSION["login"]['0']['nickname'];
}
?>
<body>
    <?php
    include_once("include/header.php");
    
    
    ?>
    <div class="container">
        <header>
            <div class="page-header">
                <h1>글쓰기</h1>
            </div>

        </header>


        <section>
                <div class="form-group">
                    <label for="">제목</label>
                    <input class="form-control" type="text" name="title" value='<?= $title ?>' readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="">작성자</label>
                    <input class="form-control" type="text" name="writer" value='<?=$writer?>' readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="" style="
                        vertical-align: top;">내용</label>
                    <textarea class="form-control" name="content" id="summernote" cols="30" rows="10" readonly="readonly"><?php 
                    echo "<img src='{$fileURL}'>\n";
                    echo $vo['content']; ?>
                    </textarea>
                </div>
<?php
if ($writer === $nickname) { // 본인이 쓴 글일 경우에만 글삭제 글수정버튼이 보임
    ?>
                <button type="button" class="btn btn-danger rmBtn">글삭제</button>
                <button type="button" class="btn btn-success modBtn">글수정</button>
<?php
}
?>
                <button type="button" class="btn btn-primary listBtn">글목록</button>
     
        </section>


        <form action="">
            <input type="hidden" name="bno" value=<?=$vo['bno']?>>
            <input type="hidden" name="page" value=<?=$cri->page?>>
            <input type="hidden" name="period" value=<?=$cri->period?>>
            <input type="hidden" name="searchType" value=<?=$cri->searchType?>>
            <input type="hidden" name="keyword" value=<?=$cri->keyword?>>
        </form>
    </div>
    <script>
    $(document).ready(function () {
        var page = '<?= $cri->page ?>';
        var searchQString = '<?= Criteria::mkSearchUrl($cri) ?>';

        $("#summernote").summernote('disable');

        $(".listBtn").click(function (e) { 
            e.preventDefault();
            location.href = "list.php"+searchQString;
        });

        $(".rmBtn").click(function (e) { 
            e.preventDefault();
            var $frm = $("form");
            $frm.attr("method", "post");
            $frm.attr("action", "remove.php");
            $frm.submit();
        });

        $(".modBtn").click(function (e) { 
            e.preventDefault();
            var $frm = $("form");
            $frm.attr("method", "get");
            $frm.attr("action", "update.php");
            $frm.submit();
        });

    });
    
    </script>
</body>

</html>