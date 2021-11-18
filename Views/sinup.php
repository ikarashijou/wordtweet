<?php
require_once('/word/Contorollers/Controller.php');
$Controller = new Controller();
$error_pass = '';
$error_name = '';
if(isset($_POST['submit'])){
    if($_POST['pass'] == $_POST['pass2']){
        $errors = $Controller->validate($_POST['name'],$_POST['pass']);
        if(isset($errors['error_name'])){
            $error_name = $errors['error_name'];
        }elseif(isset($errors['error_pass'])){
            $error_pass = $errors['error_pass'];
        }else{
            $result = $Controller->select_id($_POST['name']);
            if(empty($result)){
                $pass = password_hash($_POST['pass'],PASSWORD_DEFAULT);
                $Controller->insert($_POST['name'],$pass);
                header('Location: login.php');
            }else{
                $error_name = 'すでに登録されている名前です。';
            }
        }
    }else{
        $error_pass = 'パスワードが一致しません';
    }
}
?>
<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/public/css/nav.css">
    <title>JISAKU</title>
</head>

<body>
    <br>
    <h1 class="text-center">サインアップ</h1>
    <br>

    <div class="border col-7 mx-auto">
        <br>
        <h2>新規登録</h2>
        <br>
        <div class="row">
            <div class="col-md">
                <form id="form" method="post" action="">
                    <div class="form-group">
                        <label>ID：</label>
                        <input type="text" class="form-control" value="000" disabled>
                    </div>
                    <div class="form-group">
                        <label>ユーザー名：</label>
                        <?php if(isset($error_name)){
                            echo($error_name);
                        } ?>
                        <input type="text" class="form-control" placeholder="user name" name="name">
                    </div>
                    <div class="form-group">
                        <label>パスワード：</label>
                        <?php if(isset($error_pass)){
                            echo($error_pass);
                        } ?>
                        <input type="password" class="form-control" placeholder="password" name="pass">
                    </div>
                    <div class="form-group">
                        <label>パスワード（確認用）：</label>
                        <input type="password" class="form-control" placeholder="password" name="pass2">
                    </div>
                </form>
            </div>
        </div>
        <div class="row center-block text-center">
            <div class="col-1">
            </div>
            <div class="col-5">
                <button type="button" class="btn btn-outline-secondary btn-block" id="login">ログイン画面</button>
            </div>
            <div class="col-5">
                <input name="submit" id="sinki" type="submit" class="btn btn-outline-primary btn-block" form="form" value="登録">
            </div>
        </div>
        <br>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
        $(function(){
            $('#login').click(function(){
                window.location.href = 'login.php';
            })
        })
    </script>

</body>

</html>