<?php
    $username = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
    $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));

    $error = '';
    if(strlen($username) < 2){
        $error = 'Введите имя';
    }else if(strlen($email) < 5){
        $error = 'Введите email';
    }else if(strlen($mess) < 5){
        $error = 'Введите сообщение';
    }
    if($error != ''){
        echo $error;
        exit();
    }
    
    

    echo "Done";
?>