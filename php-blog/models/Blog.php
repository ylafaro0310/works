<?php

class Blog {
    function __construct(){
        // PDO settings
        $dsn = 'mysql:dbname=php_blog;host=mysql';
        $user = 'default';
        $password = 'default';

        try{
            $this->dbh = new PDO($dsn,$user,$password);
        }catch(PDOException $e){
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    function create($value){
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO blogs (title,content,private,created_at,updated_at) VALUE (:title,:content,:private,'". $date ."','". $date ."')";
        $sth = $this->dbh->prepare($sql);
        foreach($value as $key => $elem){
            $value[':'.$key] = $elem;
            unset($value[$key]);
        }
        $sth->execute($value);
    }

    function read($id=null){
        if(empty($id)){
            // Get all
            $sql = 'SELECT * FROM blogs ORDER BY updated_at DESC;';
            $sth = $this->dbh->prepare($sql);
            $sth->execute();
            return $sth->fetchAll();
        }else{
            // Get one
        }
    }

    function delete($id){
        $sql = 'DELETE FROM blogs WHERE id =' .$id;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
    }
}