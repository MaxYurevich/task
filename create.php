<?php

require 'connect.php';
require 'generator.php';

try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Начало транзакции
    $db->beginTransaction();

//    $ref = generate_string(rand(4, 20));
//    $status = rand(0, 9);
//    $sth = $db->prepare('INSERT INTO post SET ref = ?, status = ?');
//    $sth->bindParam(1, $ref, PDO::PARAM_STR, 256);
//    $sth->bindParam(2, $status, PDO::PARAM_INT);
//    $sth->execute();
//    $post_id = $db->lastInsertId();
//    echo "<h2>Create Post: $ref </h2><br><h3>With status: $status </h3><br>";


    // Создание и вывод поста
    $ref = generate_string(rand(4, 20));
    $status = rand(0, 9);
    $db->exec("INSERT INTO post SET ref = '$ref', status = '$status'");
    $post_id = $db->lastInsertId();
    echo "<h2>Create Post: $ref </h2><br><h3>With status: $status </h3><br>";

    // Создание 10 пользователей и добавление связей
    for ($i = 0; $i < 10; $i++) {
        $name = generate_string(rand(4, 20));
        $db->exec("INSERT INTO user SET sname = '$name'");
        $user_id = $db->lastInsertId();

        // Если пользователь совершил действие, то добавляем связь в таблицу 3
        $is_like = rand(0, 1);
        $is_repost = rand(0,1);
        if (!($is_like || $is_repost)) {
            $is_like = 1;
        }
        $db->exec("INSERT INTO user_post SET user_id = '$user_id', post_id = '$post_id', is_like = '$is_like', is_repost = '$is_repost'");
    }

    $db->commit();

} catch (PDOException $e) {
    $db->rollBack();
    print 'Error!: ' . $e->getMessage() . '<br/>';
    die();
}

$db = null;

?>

<br/><a href="index.php">Back</a>