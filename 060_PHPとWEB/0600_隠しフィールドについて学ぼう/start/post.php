<?php
$num = $_POST['num'];
$price = $_POST['price'];
$discount = $_POST['discount'];
echo ($num * $price ) * (1 - $discount / 100);