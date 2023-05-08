<?php
setcookie('VISIT_COUNT',1, [
    'expires' => time() + 60 * 60 * 24 * 30,
    'path'=> '/fullstack-webdev',
    'secure'=> true,
    'HttpOnly' => true
]);
?>
<h1>cookie</h1>