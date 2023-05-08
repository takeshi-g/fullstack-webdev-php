<h1>todos</h1>
<?php
session_start();
$self_php = $_SERVER['PHP_SELF'];
print_r($_SESSION['todos']);
?>
<form action="<?php echo $self_php ?>" method="POST">
    <input type="text" name="title">
    <input type="submit" name="crud" value="CREATE">
</form>
<?php
if (isset($_POST['title'])) {
    if ($_POST['crud'] === 'CREATE') {
        $_SESSION['todos'][] = $_POST['title'];
    } else if ($_POST['crud'] === 'UPDATE') {
        $_SESSION['todos'][$_POST['id']] = $_POST['title'];
        echo 'タスク名を変更しました。';
        echo $_POST['title'];
    } else if ($_POST['crud'] === 'DELETE') {
        array_splice($_SESSION['todos'], $_POST['id'], 1);
        echo 'タスクを削除しました。';
        echo $_POST['title'];
    }
}
if (empty($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
    die();
}
?>
<ul>
    <?php for ($i = 0; $i < count($_SESSION['todos']); $i++) : ?>
        <li>
            <form action="<?php echo $self_php ?>" method="POST">
                <input type="text" name="title" value="<?php echo $_SESSION['todos'][$i] ?>">
                <input type="hidden" name="id" value="<?php echo $i ?>">
                <input type="submit" value="UPDATE" name="crud">
                <input type="submit" value="DELETE" name="crud">
            </form>
        </li>
    <?php endfor ?>
</ul>


