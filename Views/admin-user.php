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

$id = $_GET['user_id'];
$shugo_result = $Controller->select_shugodata_where_user_id($id);
$jutugo_result = $Controller->select_jutugodata_where_user_id($id);
$userName = $Controller->select_name($id);

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
    <link rel="stylesheet" type="text/css" href="css/admin-user.css">
    <title>ワードツイート</title>
</head>
<body>
    <?php include('admin-nav.php'); ?>

    <div class="container css-bg pb-5">
        <h1 class="pt-5 text-center"><?= $userName ?>さん</h1>
        <h2 class="pt-5 pb-3 text-center">主語</h2>
        <div class="mx-auto col-8 p-2 border border-dark">
            <?php $count1 = 1;?>
            <?php foreach($shugo_result as $value): ?>
                <?= $count1.':'.$value['text']?>
                <?php $count1 += 1;?>
            <?php endforeach; ?>
        </div>
        <h2 class="pt-5 pb-3 text-center">述語</h2>
        <div class="mx-auto col-8 p-2 border border-dark">
            <?php $count = 1;?>
            <?php foreach($jutugo_result as $value){
                echo "$count:$value[text]　";
                $count += 1;
            }
            ?>
        </div>
        <div class="mx-auto col-2 mt-5">
            <button type="button" onclick="history.back();" id="button" class="btn btn-outline-primary btn-block">
            戻る
            </button>
        </div>
        <div class="mx-auto col-2 mt-5 mb-5">
            <button type="button" id="delete-user" class="btn btn-outline-danger btn-block">
            ユーザー削除
            </button>
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
        $(function(){
            $("#delete-user").click(function(){
                if(!confirm('ユーザーを削除しますか？')){
                /*キャンセルの時の処理 */
                return false;
                }else{
                    window.location.href = 'admin-index.php?delete_id=<?= $id ?>';
                }
            });
        });
    </script>
</body>
</html>
