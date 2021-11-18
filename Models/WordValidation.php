<?php
class WordValidate{
  public function validateWord($word):String{
    $error = '';
    $word = htmlspecialchars($word, ENT_QUOTES, "UTF-8");

    if (mb_strlen($word) > 13) {
      $error = '主語は１２文字以内で入力してください。';
    }
    return($error);
  }
}