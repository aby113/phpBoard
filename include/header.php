<?php
require_once "C:\workspace\board\member\memberDAO.php";
// 로그인 버튼을 눌렀을경우
session_start();
if (isset($_POST["mod"])) {
    $result = getMember($_POST["email"]);
    $pwHash = $result['0']['pw'];
    // 검증된 경우
    if (password_verify($_POST["pw"], $pwHash)) {
       
        $_SESSION["login"] = $result;
    } else {
        echo "<script>alert('아이디 또는 비밀번호가 맞지않습니다.');</script>";
    }
}

   // 세션만료
    if(isset($_GET["mod"])){
      session_destroy();
      header("Location:{$_SERVER['PHP_SELF']}");
    } 

?>

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="http://www.toyproject.me">Toyproject</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/board/list.php">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="\board\member\join.php">회원가입
            <span class="sr-only"></span>
          </a>
        </li>

      </ul>
      <?php
if (!$_SESSION['login']) {?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" name="email" placeholder="이메일" aria-label="Search">
          <input class="form-control mr-sm-2" type="text" name="pw" placeholder="비번" aria-label="Search">
          <input type="hidden" name="mod" id="login">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">로그인</button>
        </form>
        <?php
}else{
  $vo = $_SESSION["login"]['0'];
  echo "
  <ul class='navbar-nav'>
      <li class='nav-item'>
        <a class='nav-link' href='#'>{$vo['nickname']}님 환영합니다.</a>
      </li>
      <li class='nav-item'>
      <a class='nav-link logout' href='#'>로그아웃</a>
    </li>
  </ul>
  ";
}
?>
    </div>
  </nav>
<script>
$(document).ready(function () {
  // 로그아웃
  $(".logout").click(function (e) { 
    e.preventDefault();
    if(confirm("로그아웃 하시겠습니까?"))location.href = "<?= $_SERVER['PHP_SELF'] ?>?mod=out";
  });
});



</script>