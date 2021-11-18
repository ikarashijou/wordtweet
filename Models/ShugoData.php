<?php
class ShugoData{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }
    public function insert($user_id,$text){
        $created_at = date("Y/m/d H:i:s");
        $sql = "INSERT INTO shugoData (
            user_id, text, created
            ) VALUES (
                :user_id, :text, :created_at
            )";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':user_id', $user_id, PDO::PARAM_STR);
        $sth->bindParam( ':text', $text, PDO::PARAM_STR);
        $sth->bindParam( ':created_at', $created_at, PDO::PARAM_STR);
        $sth->execute();
    }

    public function data_duplication_check($text):Array{
        $sql = "SELECT text FROM shugoData WHERE text = :text";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':text', $text, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        if(empty($result)){
            $result = array();
        }
        return $result;
    }

    public function select_data($id):Array{
        $sql = "SELECT * FROM shugoData WHERE user_id = :user_id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':user_id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function select_data_where_id($id):Array{
        $sql = "SELECT * FROM shugoData WHERE id = :id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function text_select():Array{
        $sql = "SELECT text FROM shugoData";
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function all_select():Array{
        $sql = "SELECT * FROM shugoData";
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function edit($id,$text){
        $sql = "UPDATE shugoData SET text = :text WHERE id = :id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':text', $text, PDO::PARAM_STR);
        $sth->bindParam( ':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }

    public function delete($id){
        $sql = "DELETE FROM shugoData WHERE id = :id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }

    public function delete_user_id($user_id){
        $sql = "DELETE FROM shugoData WHERE user_id = :user_id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam( ':user_id', $user_id, PDO::PARAM_INT);
        $sth->execute();
    }
}