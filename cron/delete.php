<?php

$deleteds = $pdo->query("SELECT id, deleted_at FROM  books WHERE deleted_at IS NOT NULL")->fetchAll();

//print_r($authors_id);

foreach ($deleteds as $deleted) {
    $deleted_time = $deleted['deleted_at'];
    $start = strtotime($deleted_time);
    $end =  time();

    $minutes = floor(($end - $start) / 60);

    if ($minutes > 60) {

        $id = $deleted['id'];
        $stmt= $pdo->prepare("DELETE FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $stmt = $pdo->prepare("SELECT author_1_id, author_2_id, author_3_id FROM books_authors WHERE book_id = :id");
        $stmt->execute(['id' => $id]);
        $authors_id = $stmt->fetchAll();

        
        $stmt= $pdo->prepare("DELETE FROM books_authors WHERE book_id = :id");
        $stmt->execute(['id' => $id]);


        foreach ($authors_id[0] as $author_id) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM books_authors WHERE author_1_id = :id OR author_2_id = :id2 OR author_3_id = :id3");
            $stmt->execute(['id' => $author_id, 'id2' => $author_id, 'id3' => $author_id]);
            $count_author = $stmt->fetchColumn();
            if ($count_author == 0) {
                $stmt = $pdo->prepare("DELETE FROM authors WHERE id = :id");
                $stmt->execute(['id' => $author_id]);
            }
        }
    }
}

