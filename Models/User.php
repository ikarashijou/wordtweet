<?php
require_once('/word/Models/Db.php');

class UserDb extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function insert($name,$pass){
        $created_at = date("Y/m/d H:i:s");
        $sql = "INSERT INTO users (
            name, password, created
            ) VALUES (
                :name, :password, :created_at
            )";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':name', $name, PDO::PARAM_STR);
        $sth->bindParam( ':password', $pass, PDO::PARAM_STR);
        $sth->bindParam( ':created_at', $created_at, PDO::PARAM_STR);
        $sth->execute();
    }

    public function select_id($name):Int{
        $sql = "SELECT id FROM users WHERE name = :name";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':name', $name, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    public function select_name($id):String{
        $sql = "SELECT name FROM users WHERE id = :id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth -> fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    public function certification($name,$pass):string{
        $error = '';
        $sql = "SELECT * FROM users WHERE name=:name";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':name', $name, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            if(password_verify($pass,$result['password'])){
                $_SESSION['id'] = $result['id'];
                $_SESSION['name'] = $result['name'];
                return $error;
            }else{
                $error = 'パスワードが間違っています。';
                return $error;
            }
        }else{
            $error = 'ログイン情報が間違っています。';
            return $error;
        }
    }

    public function delete($id){
        $sql = "DELETE FROM users WHERE id = :id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }

    public function all_user(){
        $sql = "SELECT * FROM users";
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // public function all():Array {
    //     $sql = "SELECT * FROM contacts";
    //     $sth = $this->dbh->query($sql);
    //     $sth->execute();
    //     $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }
    // public function delete($delete){
    //     $sql = 'DELETE FROM contacts WHERE id=:id';
    //     $sth = $this->dbh->prepare($sql);
    //     $sth->bindParam( ':id', $delete, PDO::PARAM_INT);
    //     $sth->execute();
    // }
    // public function edit($id,$data){
    //     $time = date("Y/m/d H:i:s");
    //     $sql = "UPDATE contacts SET
    //     name=:name, furigana=:furigana, tel=:tel,
    //     email=:email, body=:body, created_at=:created_at WHERE id=:id";
    //     $sth = $this->dbh->prepare($sql);
    //     $sth->bindValue(':id', $id, PDO::PARAM_INT);
    //     $sth->bindValue( ':name', $data['name'], PDO::PARAM_STR);
    //     $sth->bindValue( ':furigana', $data['furigana'], PDO::PARAM_STR);
    //     $sth->bindValue( ':email', $data['email'], PDO::PARAM_STR);
    //     $sth->bindValue( ':tel', $data['phon'], PDO::PARAM_INT);
    //     $sth->bindValue( ':body', $data['message'], PDO::PARAM_STR);
    //     $sth->bindValue( ':created_at', $time, PDO::PARAM_STR);
    //     $sth->execute();
    // }
}

?>