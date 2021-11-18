<?php
session_start();
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

$id = $_SESSION['id'];

$shugo_data = $Controller->select_shugodata_where_user_id($id);
$jutugo_data = $Controller->select_jutugodata_where_user_id($id);


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
    <link rel="stylesheet" type="text/css" href="css/myword.css">

    <title>ワードツイート</title>
</head>
<body>
    <?php include('nav.php'); ?>

    <div class="container css-bg">
        <h1 class="pt-5 text-center">自分のワード</h1>
        <h2 class="pt-5 pb-3 text-center">主語</h2>
        <div class="mx-auto col-8 p-2 border border-dark">
            <?php
            if(isset($shugo_data)){
                $count = 1;
                foreach($shugo_data as $row){
                    echo "<a class='text-dark' href='edit_delete_shugo.php?id=$row[id]'>$count : $row[text] 　</a>";
                    $count += 1;
                }
            }
            ?>
        </div>
        <h2 class="pt-5 pb-3 text-center">述語</h2>
        <div class="mx-auto col-8 p-2 border border-dark">
            <?php
            if(isset($jutugo_data)){
                $count = 1;
                foreach($jutugo_data as $row){
                    echo "<a class='text-dark' href='edit_delete_jutugo.php?id=$row[id]'>$count : $row[text] 　</a>";
                    $count += 1;
                }
            }
            ?>
        </div>
        <div class="mx-auto col-2 mt-5"><button type="button" onclick="history.back();" id="button" class="btn btn-outline-primary btn-block">戻る</button></div>
    </div>

    <?php include('footer.php'); ?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <?php if(isset($_GET['delete'])): ?>
        <script>
            alert('削除が完了しました。');
            location.href = 'myWord.php';
        </script>
    <?php endif; ?>

    <script>
        $(function(){
            <?php if(isset($_GET['edit'])): ?>
                alert('編集が完了しました。');
                location.href = 'myWord.php';
            <?php endif; ?>
        })
    </script>
</body>
</html>
