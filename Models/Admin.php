<?php
require_once('/word/Models/Db.php');

class AdminDb extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function certification($name){
        $sql = "SELECT * FROM admin WHERE name = :name";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':name', $name, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
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