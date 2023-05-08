
<?php

/**
 * SessionとCookieの理解度チェック
 * 
 * index.phpに訪問するたびに訪問回数が
 * １ずつ増える処理を実装してみてください。
 * Session、Cookieの二つのパターンで実装してみましょう。
 * 
 * １回目
 * 訪問回数は 1 回目です。
 * 
 * ２回目
 * 訪問回数は 2 回目です。
 * 
 */


// Sessionを使った場合

session_start();
if(isset($_SESSION['C']))
{
    $_SESSION['C'] += 1;
}
else
{
    $_SESSION['C'] = 1;
}
?>
//session
<h1>訪問回数は<?php echo $_SESSION['C'] ?>回です。</h1>

// Cookieを使った場合

<?php
if(isset($_COOKIE['C']))
{
 $num = $_COOKIE['C'] +1;
 setcookie('C', $num);
}
else
{
 setcookie('C', 1);
 $num = 1;
}
?>
<h1>訪問回数は<?php echo $num ?>回です。</h1>