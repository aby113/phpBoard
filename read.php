<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>게시판</title>
    <link rel="shortcut icon" type="image⁄x-icon" href="images/board.png">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <style>
        button {
            float: right;
        }
    </style>
</head>
<?php
require "boardDAO.php";
$dao = new BoardDAO();
$vo = $dao->getBoard($_GET["bno"]);

$title = $vo['title'];
$content = $vo['content'];
$writer = $vo['writer'];
$page = $_GET["page"];
?>
<body>
    <div class="container">
        <header>
            <div class="page-header">
                <h1>글쓰기</h1>
            </div>

        </header>


        <section>
                <div class="form-group">
                    <label for="">제목</label>
                    <input class="form-control" type="text" name="title" value=<?= $title ?> readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="">작성자</label>
                    <input class="form-control" type="text" name="writer" value=<?=$writer?> readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="" style="
                        vertical-align: top;">내용</label>
                    <textarea class="form-control" name="content" id="" cols="30" rows="10" readonly="readonly"><?php echo $vo['content'] ?></textarea>
                </div>
                <button type="button" class="btn btn-danger rmBtn">글삭제</button>
                <button type="button" class="btn btn-success modBtn">글수정</button>
                <button type="button" class="btn btn-primary listBtn">글목록</button>
        </section>


        <form action="">
            <input type="hidden" name="bno" value=<?=$vo['bno']?>>
            <input type="hidden" name="page" value=<?=$page?>>
        </form>
    </div>
    <script>
    $(document).ready(function () {
        var page = '<?= $page ?>';
        $(".listBtn").click(function (e) { 
            e.preventDefault();
            location.href = "list.php?page="+page;
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