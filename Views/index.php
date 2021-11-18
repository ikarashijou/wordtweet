<?php
session_start();
$referer = $_SERVER['HTTP_REFERER'];
$Url = 'sinup.php';
$Url2 = 'admin-index.php';

if(empty($referer)){
  header("location: login.php");
  exit();
}elseif(strstr($referer,$Url) || strstr($referer,$Url2)){
  header("location: login.php");
  exit();
}

require_once('/word/Contorollers/Controller.php');
$Controller = new Controller();


if(isset($_GET['ajax'])){
    $shugo = $_POST['shugo'];
    $jutugo = $_POST['jutugo'];
    $error_shugo = $Controller->word_validate($shugo);
    $error_jutugo = $Controller->word_validate($jutugo);
    $user_id = $_SESSION['id'];

    //もし、文字数にエラーがあったら
    if(!empty($error_shugo)){
        $error_shugo_html = $error_shugo;
    //もし、文字数にエラーが無くて入力内容が空じゃなかったら、
    }elseif(!empty($shugo)){
        //主語重複チェック
        $result = $Controller->shugo_data_duplication_check($_POST['shugo']);
        //重複があったら、
        if(!empty($result)){
            $error_shugo_html = '主語ワードがすでに登録されています。';
        //重複がなかったら、
        }else{
            $Controller->shugo_insert($user_id,$_POST['shugo']);
            $shugo_registar = '主語が登録されました。';
        }
    }else{
    }

    if(!empty($error_jutugo)){
        $error_jutugo_html = $error_jutugo;
    }elseif(!empty($jutugo)){
        //述語重複チェック
        $result = $Controller->jutugo_data_duplication_check($_POST['jutugo']);
        if(empty($result)){
            $Controller->jutugo_insert($user_id,$_POST['jutugo']);
            $jutugo_registar = '述語が登録されました。';
        }else{
            $error_jutugo_html = '述語ワードがすでに登録されています。';
        }
    }else{
    }

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <title>ワードツイート</title>
</head>
<body>
    <?php include('nav.php'); ?>

    <div class="container css-bg">
        <h1 class="pt-5 text-center">ワード投稿</h1>
        <h2 class="pt-5 pb-3 text-center">主語</h2>
        <div class="text-center">
            <?php
            if(isset($error_shugo_html)){
                echo($error_shugo_html);
            }elseif(isset($shugo_registar)){
                echo $shugo_registar;
            }
            ?>
        </div>
        <form method="post" action="index.php?ajax=1">
            <div class="mx-auto col-5"><input class="col-12 form-control input-lg" type="text" name="shugo" placeholder="主語" id="shugo"></div>
            <h2 class="pt-5 pb-3 text-center">述語</h2>
            <div class="text-center">
                <?php
                if(isset($error_jutugo_html)){
                    echo($error_jutugo_html);
                }elseif(isset($jutugo_registar)){
                    echo $jutugo_registar;
                }
                ?>
            </div>
            <div class="mx-auto col-5 mb-5"><input class="col-12 form-control input-lg" type="text" name="jutugo" placeholder="述語" id="jutugo"></div>
            <div class="mx-auto col-1 mt-5"><input name="submit" type="submit" id="button" class="btn btn-outline-primary btn-block" value="登録"></div>
        </form>
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
            $("#button").click(function(){
                if(!confirm('このワードを登録しますか？')){
                /*キャンセルの時の処理 */
                return false;
                }else{
                }
            });

            <?php if(isset($_GET['tweet'])): ?>
                alert('ツイートしました。');
                location.href = 'index.php';
            <?php endif; ?>
        });
    </script>
</body>
</html>
