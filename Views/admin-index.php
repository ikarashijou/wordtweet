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

if(isset($_GET['delete_id'])){
    $Controller->user_delete($_GET['delete_id']);
    $Controller->shugo_delete_user_id($_GET['delete_id']);
    $Controller->jutugo_delete_user_id($_GET['delete_id']);
}

$shugo_word = $Controller->shugodata_all_select();
$jutugo_word = $Controller->jutugodata_all_select();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/admin-index.css">
    <title>ワードツイート</title>
</head>
<body>
    <?php include('admin-nav.php'); ?>

    <div class="container css-bg css-pb">
        <h1 class="pt-5 text-center">登録ワード</h1>
        <h2 class="pt-5 pb-3 text-center">主語</h2>
        <div class="mx-auto col-8 p-2 border border-dark">
            <?php foreach($shugo_word as $value): ?>
                <a class="text-dark" href="admin-user.php?user_id=<?=$value['user_id']?>"><?=$value['text']?>、</a>
            <?php endforeach; ?>
        </div>
        <h2 class="pt-5 pb-3 text-center">述語</h2>
        <div class="mx-auto col-8 p-2 border border-dark">
            <?php foreach($jutugo_word as $value): ?>
                <a class="text-dark" href="admin-user.php?user_id=<?=$value['user_id']?>"><?=$value['text']?>、</a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include('footer.php'); ?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
        <?php if(isset($_GET['delete_id'])): ?>
            alert('削除が完了しました。');
            location.href = 'admin-index.php';
        <?php endif; ?>
    </script>
</body>
</html>
