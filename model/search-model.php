<?php
try {
    require_once 'connect-db.php';

    $text_search = $_GET['search'];

    $stmt = $pdo->prepare("SELECT title, book_id, authors.author AS author, authors2.author AS author2, authors3.author AS author3
            FROM books 
            JOIN books_authors ON books.id = books_authors.book_id
            JOIN authors ON books_authors.author_1_id = authors.id
            LEFT JOIN authors AS authors2 ON books_authors.author_2_id = authors2.id
            LEFT JOIN authors AS authors3 ON books_authors.author_3_id = authors3.id 
            WHERE title LIKE ?");
    $stmt->execute(["%$text_search%"]);
    $array_db = $stmt->fetchAll();
} catch (Exception $e) {
    header( 'HTTP/1.1 500 Internal Server Error' );
    header('Content-type: application/json');
    echo json_encode(['error' => ' 500 Internal Server Error']);
    exit();
}