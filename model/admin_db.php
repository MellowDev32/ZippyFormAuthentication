<?php
function add_admin($username, $password){
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = 'INSERT INTO administrators (username, password) VALUES (:username, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $hash);
    $statement->execute();
    $statement->closeCursor();
}


function is_valid_admin_login($username, $password){
    global $db;
    $query = 'SELECT password FROM administrators WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    if(!empty($row['password'])){
        $hash = $row['password'];
    } else {
        $hash = '';
    }
    return password_verify($password, $hash);
}

function add_admin($username){
    global $db;
    $query = 'SELECT COUNT(*) FROM administrators WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $count = $statement->fetch();
    $statement->closeCursor();
    return ($count == 0) ? false : true;
}
