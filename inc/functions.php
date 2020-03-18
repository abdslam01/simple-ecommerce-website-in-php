<?php
    function insertMember($user,$email,$pass){
        $file=fopen('data.txt','a+');
        fprintf($file,"%s|%s|%s\n",$user,$email,$pass);
        fclose($file);
    }
    function selectMember($user,$email,$pass){
        $file=fopen('data.txt','r+');
        fscanf($file,"%s\n",$data);
        fclose($file);
        return $data;
    }
    function verifyAndReturn($text){
        return addslashes(htmlentities($text));
    }
    function generateToken($length = 20)
    {
        return bin2hex(random_bytes($length));
    }