<?php
require_once('/word/Contorollers/Controller.php');
$Controller = new Controller();
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $text = $_POST['text'];
    if(!empty($text)){
        $error = $Controller->word_validate($text);
        if(empty($error)){
            $result = $Controller->jutugo_data_duplication_check($text);
            if(empty($result)){
                $Controller->edit_jutugo($id,$text);
                $message = 'ワードを変更しました。';
            }else{
                $message = 'ワードが重複しているか、変更されていません。';
            }
        }else{
            $message =  $error;
        }
    }else{
        $message = '変更内容が空文字です。';
    }
}
if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    $Controller->delete_jutugo($id);
    header('location: myWord.php?delete=1');
}
$result = $Controller->select_jutugodata_where_id($id);
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
    <link rel="stylesheet" type="text/css" href="css/edit_delete.css">

    <title>ワードツイート</title>
</head>
<body>
    <?php include('nav.php'); ?>

    <div class="container css-bg">
        <div class="text-center">
            <?php
            if(isset($message)){
                echo $message;
            }
            ?>
        </div>
        <form method="post" action="edit_delete_jutugo.php?edit_id=<?= $result['id'] ?>">
            <div class="mx-auto col-6 input">
                <input class="p-3 mb-5 mt-5" id="input" name="text" type="text" style="width: 100%;" value=<?=$result['text']?>>
            </div>
            <div class="row col-8 mx-auto">
                <div class="col-5">
                    <input name="edit" type="submit" id="edit" class="btn btn-outline-primary btn-block" value="編集">
                </div>
                <div class="col-5">
                    <input name="delete" type="button" id="delete" class="btn btn-outline-primary btn-block" value="削除">
                </div>
            </div>
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
            $("#edit").click(function(){
                let value = $("#input").val();
                if(!confirm('「' + value + '」に編集しますか？')){
                    return false;
                }
            })
            $("#delete").click(function(){
                if(!confirm('削除しますか？')){
                    return false;
                }else{
                    window.location.href = 'edit_delete_jutugo.php?delete_id=<?=$id ?>'
                }
            })
        })
    </script>
</body>
</html>