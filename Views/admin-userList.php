<?php
// $referer = $_SERVER['HTTP_REFERER'];
// $myUrl = 'index.php';
// $bacUrl = 'login.php';

// if(empty($referer)){
//   header("location: login.php");
//   exit();
// }elseif(!strstr($referer,$myUrl) && !strstr($referer,$bacUrl)){
//   header("location: login.php");
//   exit();
// }

require_once('/word/Contorollers/Controller.php');
$Controller = new Controller();

$result = $Controller->all_user();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/admin-userList.css">

    <title>ワードツイート</title>
</head>
<body>
    <?php include('admin-nav.php'); ?>

    <div class="container css-bg pb-5">
        <h1 class="pt-5 text-center">ユーザー一覧</h1>
        <?php foreach($result as $value): ?>
            <div class="user col-4 mx-auto mt-5">
                <a href="admin-user.php?user_id=<?=$value['id'] ?>" class="btn btn-outline-primary btn-block" style="height: 60px;">
                    <?=$value['name']?>さん
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include('footer.php'); ?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
        $(function(){
            $(".btn").click(function(){
                window.location.href = "admin-user.php";
            });
        });
    </script>
</body>
</html>
