<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>게시판만들기</title>
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
</head>
<?php

require "boardDAO.php";
$boardDAO = new BoardDAO();
$list = $boardDAO->getBoardListAll();
?>
<body>
    <div class="container">
        <header></header>
        <section>
            <div class="page-header">
                <h1>게시판만들기</h1>
            </div>
            <table class="table">
                <colgroup>
                <col width="10%">
                <col width="40%">
                <col width="20%">
                <col width="10%">
                </colgroup>
                <tr>
                    <th class='text-center'>작성자</th>
                    <th class='text-center'>제목</th>
                    <th>작성일</th>
                    <th>조회수</th>
                </tr>
                <?php
foreach ($list as $vo) {
    $date=date('m-d H:i', strtotime($vo['regdate']));
    $writer = $vo['writer'];
    $title = $vo['title'];
    $viewcnt = $vo['viewcnt'];
    ?>
                <tr>
                    <td><?=$writer?></td>
                    <td><a class="titleLink" href=<?=$vo['bno']?>><?=$title?></a></td>
                    <td><?=$date?></td>
                    <td><?=$viewcnt?></td>
                </tr>
                <?php
}
?>
            </table>
            <div class="btn-area text-right">
                <button type="button" class="btn btn-primary writeBtn">글쓰기</button>
            </div>
            <nav class="text-center">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>


        </section>

   



    </div>
<script>
$(function(){
    $(".writeBtn").click(function(){
        location.href = "write.html";

    });

    $(".titleLink").click(function (e) { 
        e.preventDefault();
        var bno = $(this).attr("href");
        location.href = "read.php?bno="+bno;
    });


});




</script>


</body>

</html>