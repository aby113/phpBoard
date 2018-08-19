<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>게시판만들기</title>
    <link rel="shortcut icon" type="image⁄x-icon" href="images/board.png">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<style>
section{
    margin-top: 50px;
}
.btn-area{
    margin-bottom:10px;
}
.selectBox{
    float:left;
}
</style>
</head>
<?php
require "pageMaker.php";
require "page.php";
require "boardDAO.php";

$cri = new Criteria();
$boardDAO = new BoardDAO();
if (isset($_GET["page"])) {
    $cri->setPage($_GET["page"]);
}
$pageMaker = new PageMaker($cri, $boardDAO->getBoardCnt());
$list = $boardDAO->getBoardList($cri);

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
                <col width="10%">
                <col width="40%">
                <col width="20%">
                <col width="10%">
                </colgroup>
                <tr>
                    <th class='text-center'>번호</th>
                    <th class='text-center'>작성자</th>
                    <th class='text-center'>제목</th>
                    <th>작성일</th>
                    <th>조회수</th>
                </tr>
                <?php
foreach ($list as $vo) {
    $bno = $vo["bno"];
    $date = date('m-d H:i', strtotime($vo['regdate']));
    $writer = $vo['writer'];
    $title = $vo['title'];
    $viewcnt = $vo['viewcnt'];
    ?>
                <tr>
                    <td><?=$bno?></td>
                    <td><?=$writer?></td>
                    <td><a class="titleLink" href=<?=$vo['bno']?>><?=$title?></a></td>
                    <td><?=$date?></td>
                    <td><?=$viewcnt?></td>
                </tr>
                <?php
}
?>
            </table>

            <!-- 글쓰기버튼 -->
            <div class="btn-area text-right">
                <div class="selectBox">

                    <select name="" id="">
                        <option value="">전체기간</option>
                        <option value="">1일</option>
                        <option value="">1주</option>
                        <option value="">1개월</option>
                        <option value="">6개월</option>
                        <option value="">1년</option>
                    </select>
                    <select name="" id="">
                        <option value="">제목+내용</option>
                        <option value="">제목</option>
                        <option value="">작성자</option>
                    </select>
                    <input type="text" name="" id="">
                    <button class="btn btn-primary searchBtn">검색</button>
                </div>
            <button type="button" class="btn btn-success writeBtn">글쓰기</button>
            </div>


            <!-- 페이지네이션 시작 -->
            <nav class="text-center">
            <ul class="pagination justify-content-center">
                <?php
if ($pageMaker->prev) {
    ?>
                    <li class="page-item">
                        <a class="page-link" href=<?=$pageMaker->startPage - 1?> aria-label="Previous">
                            &laquo;
                        </a>
                    </li>
                <?php
}
for ($i = $pageMaker->startPage; $i <= $pageMaker->endPage; $i++) {
    ?>

                   <li class='<?=$i==$cri->page?'page-item active':'page-item'?>'><a class="page-link" href=<?=$i?>><?=$i?></a></li>
                   
<?php
}

if ($pageMaker->next) {
    ?>
                    <li class="page-item">
                        <a class="page-link" href=<?=$pageMaker->endPage+1?> aria-label="Next">
                            &raquo;
                        </a>
                    </li>
<?php
}

?>
                </ul>
            </nav>


        </section>





    </div>
<script>
$(function(){
    var page = '<?= $cri->page ?>';
    $(".writeBtn").click(function(){
        location.href = "write.php";

    });

    $(".titleLink").click(function (e) {
        e.preventDefault();
        var bno = $(this).attr("href");
        location.href = "read.php?bno="+bno+"&page="+page;
    });

    $(".page-link").click(function (e) { 
        e.preventDefault();
        var page = $(this).attr("href");
        location.href = "list.php?page="+page;
    });




});




</script>


</body>

</html>