<?php

use JetBrains\PhpStorm\ArrayShape;

require_once('/word/Models/Validation.php');
require_once('/word/Models/WordValidation.php');
require_once('/word/Models/User.php');
require_once('/word/Models/ShugoData.php');
require_once('/word/Models/JutugoData.php');
require_once('/word/Models/Admin.php');

class Controller{
    private $User;
    private $Jutugo;
    private $Shugo;
    private $Validate;
    private $WordValidate;
    private $Admin;

    public function __construct(){
        //モデルオブジェクトの生成
        $this->User = new UserDb();
        //別モデルと連携
        $dbh = $this->User->get_db_handler();
        $this->Jutugo = new JutugoData($dbh);
        $this->Shugo = new ShugoData($dbh);
        $this->Admin = new AdminDb($dbh);

        $this->Validate = new Validate();
        $this->WordValidate = new WordValidate();
    }
    //バリデーション(ログイン、新規登録)
    public function validate($name,$pass):Array{
        $errors = $this->Validate->validateUser($name,$pass);
        return $errors;
    }
    //バリデーション(ワード登録)
    public function word_validate($word):String{
        $errors = $this->WordValidate->validateWord($word);
        return $errors;
    }
    //ユーザーデータ新規登録
    public function insert($name,$pass){
        $this->User->insert($name,$pass);
    }
    //ユーザーデータID取得
    public function select_id($name):Int{
        $id = $this->User->select_id($name);
        return $id;
    }
    //ユーザーネーム取得
    public function select_name($id):String{
        $name = $this->User->select_name($id);
        return $name;
    }
    //ユーザーだ‐た全取得
    public function all_user(){
        $result = $this->User->all_user();
        return $result;
    }
    //ユーザー削除
    public function user_delete($id){
        $this->User->delete($id);
    }
    //述語ワード登録
    public function jutugo_insert($user_id,$text){
        $this->Jutugo->insert($user_id,$text);
    }
    //述語ワード編集
    public function edit_jutugo($id,$text){
        $this->Jutugo->edit($id,$text);
    }
    //述語ワード削除
    public function delete_jutugo($id){
        $this->Jutugo->delete($id);
    }
    //述語ワード削除（ユーザーIDから）
    public function jutugo_delete_user_id($user_id){
        $this->Jutugo->delete_user_id($user_id);
    }
    //主語ワード登録
    public function shugo_insert($user_id,$text){
        $this->Shugo->insert($user_id,$text);
    }
    //主語ワード編集
    public function edit_shugo($id,$text){
        $this->Shugo->edit($id,$text);
    }
    //主語ワード削除
    public function shugo_delete($id){
        $this->Shugo->delete($id);
    }
    //主語ワード削除（ユーザーIDから）
    public function shugo_delete_user_id($user_id){
        $this->Shugo->delete_user_id($user_id);
    }
    //主語ワードを重複をチェック
    public function shugo_data_duplication_check($text):Array{
        $result = $this->Shugo->data_duplication_check($text);
        return $result;
    }
    //述語ワードを重複をチェック
    public function jutugo_data_duplication_check($text):Array{
        $result = $this->Jutugo->data_duplication_check($text);
        return $result;
    }
    //ログイン認証
    public function certification($name,$pass):string{
        $result = $this->User->certification($name,$pass);
        return $result;
    }
    //管理者ログイン認証
    public function admin_certification($name):Array{
        $result = $this->Admin->certification($name);
        if(empty($result)){
            $result = array();
            return $result;
        }else{
            return $result;
        }
    }
    //user_idDから主語ダータ取得
    public function select_shugodata_where_user_id($id):Array{
        $result = $this->Shugo->select_data($id);
        return $result;
    }
    //user_idから述語ダータ取得
    public function select_jutugodata_where_user_id($id):Array{
        $result = $this->Jutugo->select_data($id);
        return $result;
    }
    //idから主語ダータ取得
    public function select_shugodata_where_id($id):Array{
        $result = $this->Shugo->select_data_where_id($id);
        return $result;
    }
    //idから述語ダータ取得
    public function select_jutugodata_where_id($id):Array{
        $result = $this->Jutugo->select_data_where_id($id);
        return $result;
    }
    //主語ワードを取得
    public function shugodata_text_select():Array{
        $result = $this->Shugo->text_select();
        return $result;
    }
    //主語ダータ全取得
    public function shugodata_all_select():Array{
        $result = $this->Shugo->all_select();
        return $result;
    }
    //述語ワードを取得
    public function jutugodata_text_select():Array{
        $result = $this->Jutugo->text_select();
        return $result;
    }
    //述語ダータ全取得
    public function jutugodata_all_select():Array{
        $result = $this->Jutugo->all_select();
        return $result;
    }
}