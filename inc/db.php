<?php
define('SALT','3$%DHe!sqz+&r4HK2v%2');
class db extends PDO{
    private $conn, $host, $database, $username, $password;
    public function __construct(){
        $host='localhost';
        $database='proj';
        $username='root';
        $password='';
        try {
            parent::__construct("mysql:host=$host;dbname=$database", $username, $password);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Connection erreur: " . $e->getMessage());
        }
    }
    public function __destruct(){
        $conn=null;
    }
    public function verifyAndReturn($text){
        return addslashes(htmlentities(strip_tags($text)));
    }
    public function generateToken($length = 20)
    {
        return bin2hex(random_bytes($length));
    }
    public function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public function validatePass($pass){
        return preg_match("/^(?=.*[0-9]+)(?=.*[\*&%$#@\!\?\/]*)(?=.*[A-Z]+){8,}/",$pass);
    }
    public function returnData($query,$type=null){
        if($type=='one')
            return $this->query($query)->fetch(PDO::FETCH_ASSOC);
        else if($type=='many'){
            $rows=[];
            $data=$this->query($query)->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $r)
                array_push($rows,$r);
            return $rows;
        }
        return 'Specifier le type';
    }
    public function insertData($query,$data=[]){
        return $this->updateData($query,$data);
    }
    public function deleteData($query,$data=[]){
        return $this->prepare($query)->execute($data);
    }
    public function updateData($query,$data=[]){
        return $this->prepare($query)->execute($data);
    }
}