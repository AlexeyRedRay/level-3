<?php
try {
    require_once 'connect-db.php';

    $limit = 10;
    $count_entry = $pdo->query("SELECT COUNT(*) FROM books")->fetchColumn();

    if ($count_entry > $limit) {
        $count_pages = ceil($count_entry / $limit);
        if ($page_number > $count_pages) {
            include 'views/404.php';
            exit;
        }
        $offset = $limit * $page_number - $limit;
        $array_db = $pdo->query(
    "SELECT title, book_id, authors.author AS author, authors2.author AS author2, authors3.author AS author3
            FROM books 
            JOIN books_authors ON books.id = books_authors.book_id
            JOIN authors ON books_authors.author_1_id = authors.id
            LEFT JOIN authors AS authors2 ON books_authors.author_2_id = authors2.id
            LEFT JOIN authors AS authors3 ON books_authors.author_3_id = authors3.id
            LIMIT $limit OFFSET $offset")->fetchAll();
        $array_db[0]['page'] = $page_number;
        $array_db[0]['count_pages'] = $count_pages;
    } else {
        $array_db = $pdo->query(
    "SELECT title, book_id, authors.author AS author, authors2.author AS author2, authors3.author AS author3
            FROM books 
            JOIN books_authors ON books.id = books_authors.book_id
            JOIN authors ON books_authors.author_1_id = authors.id
            LEFT JOIN authors AS authors2 ON books_authors.author_2_id = authors2.id
            LEFT JOIN authors AS authors3 ON books_authors.author_3_id = authors3.id")->fetchAll();
    }
} catch (Exception $e) {
    header( 'HTTP/1.1 500 Internal Server Error' );
    header('Content-type: application/json');
    echo json_encode(['error' => ' 500 Internal Server Error']);
    exit();
}