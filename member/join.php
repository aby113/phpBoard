<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js" ></script>
    <style>
        section {
            margin-top: 130px;
            padding-left: 100px;
            padding-right: 100px;
        }
        .error{
            color:red;
        }
    </style>


</head>
<?php

require_once "memberDAO.php";
if (isset($_POST["email"])) {
    insertMember($_POST["email"], $_POST["nickname"], $_POST["pw"]);
    header('HTTP/1.1 307 Temporary move');
    header("Location:../list.php");
}
    



?>
<body>
    <?php
require_once "../include/header.php";
?>
        <section>
            <div class="page-header">
                <h1>회원가입</h1>
                <hr>
            </div>
            <form class="joinFrm" action='<?=$_SERVER['PHP_SELF']?>' method="post">
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" name="email" class="form-control required" id="email">
                </div>
                <div class="form-group">
                    <label for="pwd">비밀번호</label>
                    <input type="password" name="pw" class="form-control required" id="pwd">
                </div>
                <div class="form-group">
                    <label for="nick">닉네임</label>
                    <input type="text" name="nickname"  class="form-control required" id="nick">
                </div>
                <button type="submit" class="btn btn-primary">가입하기</button>
            </form>
        </section>

<script>
$(".joinFrm").validate({
    debug:false,
    rules:{
        email:{
            required:true,
            email:true
        },
        pw:{
            required:true,
            minlength:4,
            maxlength:8
        },
        nickname:{
            required:true
        }
    },
    messages:{
        email:{
            required:"필수 항목 입니다.",
            email:"이메일 형식에 맞춰주세요."
        },
        pw:{
            required:"필수 항목 입니다.",
            minlength:"최소 4글자 입니다.",
            maxlength:"최대 8글자 입니다."
        },
        nickname:{
            required:"필수 항목 입니다."
        }
    }

});

</script>


</body>

</html>