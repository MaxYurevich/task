<?php

// Подключение к базе данных, используя PDO
try {
    $db = new PDO('mysql:host=localhost;dbname=task', 'task', 'root', array(
        PDO::ATTR_PERSISTENT => true
    ));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}