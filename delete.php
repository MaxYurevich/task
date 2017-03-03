<?php

require 'connect.php';

try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Начало транзакции
    $db->beginTransaction();

    $sql1 = 'SET FOREIGN_KEY_CHECKS = 0;' .
            'TRUNCATE TABLE user_post;' .
            'TRUNCATE TABLE user;' .
            'TRUNCATE TABLE post;' .
            'SET FOREIGN_KEY_CHECKS = 1;';

    $db->exec($sql1);

    $db->commit();

} catch (PDOException $e) {
    $db->rollBack();
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$db = null;

?>

<br/><a href="index.php">Back</a>