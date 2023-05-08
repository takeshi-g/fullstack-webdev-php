<?php
session_start();
print_r($_POST);

if (
    isset($_POST['user'])
    && isset($_POST['pwd'])
    && $_POST['user'] === 'user'
    && $_POST['pwd'] === 'pwd'
) {
    $_SESSION['user'] = [
        'user' => $_POST['user'],
        'pwd' => $_POST['pwd']
    ];
}

if (!empty($_SESSION['user']) ) {
    echo 'ログインしています。';
} else {
    echo 'ログインしていません。';
}
