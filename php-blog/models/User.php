<?php

class User {
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
        $sql = 'INSERT INTO users (username,password) VALUE (:username,:password)';
        $sth = $this->dbh->prepare($sql);
        foreach($value as $key => $elem){
            if($key === 'password'){
                $value[':'.$key] = password_hash($elem,PASSWORD_DEFAULT);
            }else{
                $value[':'.$key] = $elem;
            }
            unset($value[$key]);
        }
        $sth->execute($value);
    }
    function validate_password($username,$password){
        $sql = 'SELECT password from users where username = :username';
        $sth = $this->dbh->prepare($sql);
        $sth->execute([':username'=>$username]);
        $user = $sth->fetch();
        if($user){
            return password_verify($password,$user['password']);
        }else{
            return false;
        }
    }
}