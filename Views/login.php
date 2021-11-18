<?php
session_start();
require_once('/word/Contorollers/Controller.php');
$Controller = new Controller();
$error_pass = '';
$error_name = '';
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    if($pass == $pass2){
        $errors = $Controller->validate($name,$pass);
        if(isset($errors['error_name'])){
            $error_name = $errors['error_name'];
        }
        if(isset($errors['error_pass'])){
            $error_pass = $errors['error_pass'];
        }
        if(empty($errors)){
            $result = $Controller->admin_certification($name);
            if(!empty($result)){
                if($pass == $result['password']){
                    header('location: admin-index.php');
                }else{
                    $error_pass = 'パスワードが違います。';
                }
            }else{
                $result = $Controller->certification($name,$pass);
                if(empty($result)){
                    header('Location: index.php');
                }else{
                    $error_name = $result;
                }
            }
        }
    }else{
        $error_pass = 'パスワードが一致しません';
    }
}

if(isset($_GET['logout'])){
    session_destroy();
    header('location: login.php');
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
    <h1 class="text-center">サインイン</h1>
    <br>

    <div class="border col-7 mx-auto">
        <br>
        <h2>ログイン</h2>
        <br>
        <div class="row">
            <div class="col-md">
                <form id="form" method="post">
                    <div class="form-group">
                        <label>ユーザー名：</label>
                        <?php if(isset($error_name)){
                            echo($error_name);
                        } ?>
                        <input name="name" type="text" class="form-control" placeholder="user name">
                    </div>
                    <div class="form-group">
                        <label>パスワード：</label>
                        <?php if(isset($error_pass)){
                            echo($error_pass);
                        } ?>
                        <input name="pass" type="password" class="form-control" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label>パスワード（確認用）：</label>
                        <input name="pass2" type="password" class="form-control" placeholder="password">
                    </div>
                </form>
            </div>
        </div>
        <div class="row center-block text-center pt-3 pb-3">
            <div class="col-5 mx-auto">
                <input name="submit" type="submit" id="button" class="btn btn-outline-primary btn-block" form="form" value="ログイン">
            </div>
        </div>
        <br>
    </div>
    <div class="col-3 mx-auto mt-5">
        <button type="button" id="button-sinki" class="btn btn-outline-dark btn-block" form="form">新規登録</button>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $("#button").click(function(){
                window.location.href = "index.php";
            });
            // $("#button").click(function(){
            //     window.location.href = "admin-index.php";
            // });
        });

        $(function(){
            $("#button-sinki").click(function(){
                window.location.href = "sinup.php";
            });
        });

    </script>
</body>

</html>