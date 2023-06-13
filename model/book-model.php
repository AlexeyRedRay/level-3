<?php
try {
    require_once 'connect-db.php';

    if (isset($_POST['clickId'])) {
        $click_id = $_POST['clickId'];
        settype($click_id, 'integer');
        $stmt= $pdo->prepare("UPDATE books SET clicks = clicks + 1 WHERE id = :id");
        $stmt->execute(['id' => $click_id]);
    } else {
        $id = $routes[2];
        settype($id, 'integer');
        $stmt= $pdo->prepare("UPDATE books SET views = views + 1 WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $array_db = $pdo->query("SELECT title, description, year, pages, isbn, book_id AS id, authors.author, authors2.author AS author2, authors3.author AS author3 FROM books 
            JOIN books_authors ON books.id = books_authors.book_id
            JOIN authors ON books_authors.author_1_id = authors.id
            LEFT JOIN authors AS authors2 ON books_authors.author_2_id = authors2.id
            LEFT JOIN authors AS authors3 ON books_authors.author_3_id = authors3.id
    WHERE  books.id = $id")->fetch();
        if (empty($array_db)) {
            require 'views/404.php';
            exit;
        }
    }
} catch (Exception $e) {
    header( 'HTTP/1.1 500 Internal Server Error' );
    header('Content-type: application/json');
    echo json_encode(['error' => ' 500 Internal Server Error']);
    exit();
}