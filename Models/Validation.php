<?php
class Validate{
  public function validateUser($name,$pass):Array{
    $errors = array();

    $name = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
    $pass = htmlspecialchars($pass, ENT_QUOTES, "UTF-8");

    if (empty($name) || mb_strlen($name) > 9) {
      $errors['error_name'] = '氏名は必須項目です。８文字以内で入力してください。';
    }
    if (empty($pass) || mb_strlen($pass) > 9) {
      $errors['error_pass'] = 'パスワードは必須項目です。８文字以内で入力してください。';
    }
    return($errors);
  }
}