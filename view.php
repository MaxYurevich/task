<?php

require 'connect.php';

try {

//    $sql1 = 'SELECT * FROM post';
//
//    $stmt = $db->prepare($sql1);
//    $stmt->execute();
//
//    $stmt->bindColumn('id', $post_id);
//    $stmt->bindColumn('ref', $ref);
//    $stmt->bindColumn('status', $status);
//
//    while ($stmt->fetch(PDO::FETCH_BOUND)) {
//        echo 'Post: ' . $ref . '<br>Status: ' . $status . '<br>';
//
//        $sth = $db->prepare('SELECT sum(is_like) as likes, sum(is_repost) as reposts FROM user_post WHERE post_id = ?');
//        $sth->bindParam(1, $post_id, PDO::PARAM_INT);
//        $sth->bindColumn('likes', $likes);
//        $sth->bindColumn('reposts', $reposts);
//        $sth->execute();
//        while ($sth->fetch(PDO::FETCH_BOUND)) {
//            echo 'Likes: ' . $likes . ' Reposts: ' . $reposts . '<br><br>';
//        }
//    }


    // Вывод постов
    $sql1 = 'SELECT * FROM post';
    foreach ($db->query($sql1) as $row) {
        $post_id = $row['id'];
        $ref = $row['ref'];
        $status = $row['status'];

        echo 'Post: ' . $ref . '<br>Status: ' . $status . '<br>';

        // Подсчет лайков\репостов к посту и вывод их
        $sql2 = "SELECT sum(is_like) as likes, sum(is_repost) as reposts FROM user_post WHERE post_id = '$post_id'";
        foreach ($db->query($sql2) as $lp) {
            $likes = $lp['likes'];
            $reposts = $lp['reposts'];
            echo 'Likes: ' . $likes . ' Reposts: ' . $reposts . '<br><br>';
        }

    }

} catch (PDOException $e) {
    print 'Error!: ' . $e->getMessage() . '<br/>';
    die();
}

$db = null;

?>

<br/><a href="index.php">Back</a>