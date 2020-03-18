<?php
    define('SALT','3$%DHe!sqz+&r4HK2v%2');

    define('DB_HOST','localhost');
    define('DB_DATABASE','id12753165_proj');
    define('DB_USERNAME','id12753165_bahafid');
    define('DB_PASSWORD','fE9?BMUL6yZj-F3');
    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }


    /*
----------------INSERT DATA mySQLi--------------------
$stmt = $dbConnection->prepare('SELECT * FROM employees WHERE name = ?');
$stmt->bind_param('s', $name); // 's' specifies the variable type => 'string'

$stmt=$mysqli->query('$sql');

--------------GET DATA mySQLi--------------------
$stmt = $mysqli->stmt_init();
$stmt->prepare($q);
$stmt->execute();
$result=$stmt->get_result(); || NULL    ---> var_dump()
while ($row = $result->fetch_assoc()) {
    // Do something with $row
}
$stmt->close();
$mysqli->close();
    */