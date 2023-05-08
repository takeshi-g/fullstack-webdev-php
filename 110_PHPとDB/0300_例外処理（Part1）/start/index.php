<?php

try {
    // new PDO('','','');
    $bool = false;
    $bool->method();
    echo '  end of try  ';
} catch (PDOException $e) {
    echo '  PDOExeption called  ';
    echo $e->getMessage();
} 
 catch (Error $e) {
    echo '  catch called  ';
    echo $e->getMessage();
} 
finally {
    echo '  inally  ';
}
