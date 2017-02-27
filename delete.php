<?php

require 'connect.php';

try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Начало транзакции
    $db->beginTransaction();

    $sql1 = 'ALTER TABLE user_post DROP FOREIGN KEY user_post_ibfk_1';
    $sql2 = 'ALTER TABLE user_post DROP FOREIGN KEY user_post_ibfk_2';
    $sql3 = 'TRUNCATE TABLE user_post';
    $sql4 = 'TRUNCATE TABLE user';
    $sql5 = 'TRUNCATE TABLE post';
    $sql6 = 'ALTER TABLE user_post ADD FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE RESTRICT';
    $sql7 = 'ALTER TABLE user_post ADD FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE RESTRICT';

    $db->exec($sql1);
    $db->exec($sql2);
    $db->exec($sql3);
    $db->exec($sql4);
    $db->exec($sql5);
    $db->exec($sql6);
    $db->exec($sql7);

    $db->commit();

} catch (PDOException $e) {
    $db->rollBack();
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$db = null;

?>

<br/><a href="index.php">Back</a>