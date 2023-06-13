<?php
require_once 'connect-db.php';

if ($_POST) {
    try {
        $title = $_POST['title'];
        $year = $_POST['year'];
        $author1 = $_POST['author1'];
        $author2 = $_POST['author2'];
        $author3 = $_POST['author3'];
        $description = $_POST['description'];
        $pages = $_POST['pages'];
        $isbn = $_POST['isbn'];

        $stmt = $pdo->prepare("INSERT INTO books(title, description, year, pages, isbn) VALUES(:title, :description, :year, :pages, :isbn)");
        $stmt->execute(['title' => $title, 'description' => $description, 'year' => $year, 'pages' => $pages, 'isbn' => $isbn]);
        $id_book = $pdo->lastInsertId();

        function add_author($author, &$pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(author) FROM authors WHERE author =:author");
            $stmt->execute(['author' => $author]);
            $isset_author = $stmt->fetchColumn();

            if (!$isset_author) {
                $stmt = $pdo->prepare("INSERT INTO authors(author) VALUES (:author)");
                $stmt->execute(['author' => $author]);
                $id_author = $pdo->lastInsertId();
            } else {
                $stmt = $pdo->prepare("SELECT id FROM authors WHERE author =:author");
                $stmt->execute(['author' => $author]);
                $id_author = $stmt->fetchColumn();
            }

            return $id_author;
        }

        $id_author_1 = add_author($author1, $pdo);
        $stmt = $pdo->prepare("INSERT INTO books_authors(book_id, author_1_id) VALUES(:book_id, :author_1_id)");
        $stmt->execute(['book_id' => $id_book, 'author_1_id' => $id_author_1]);

        if (!empty($author2)) {
            $id_author_2 = add_author($author2, $pdo);
            $stmt = $pdo->prepare("UPDATE books_authors SET author_2_id = :id_author_2 WHERE book_id = :id_book");
            $stmt->execute(['id_author_2' => $id_author_2, 'id_book' => $id_book]);
        }

        if (!empty($author3)) {
            $id_author_3 = add_author($author3, $pdo);
            $stmt = $pdo->prepare("UPDATE books_authors SET author_3_id = :id_author_3 WHERE book_id = :id_book");
            $stmt->execute(['id_author_3' => $id_author_3, '$id_book' => $id_book]);
        }


        $array = explode(".", $_FILES['image']['name']);
        $extension = end($array);
        if ($extension == 'jpg' || $extension == 'png') {
            move_uploaded_file($_FILES['image']['tmp_name'], 'assets/img/' . $pdo->lastInsertId() . '.' . $extension);
        }
    } catch (Exception $e) {
        header( 'HTTP/1.1 400 Bad Request' );
        header('Content-type: application/json');
        echo json_encode(['error' => ' 400 Bad Request']);
        exit();
    }
}

$limit = 5;

try {
$count_entry = $pdo->query("SELECT COUNT(*) FROM books")->fetchColumn();

    if ($count_entry > $limit) {
        $count_pages = ceil($count_entry / $limit);
        if ($page_number > $count_pages) {
            include 'views/404.php';
            exit;
        }
        $offset = $limit * $page_number - $limit;
        $content = $pdo->query("SELECT title, book_id, year, clicks, authors.author AS author, authors2.author AS author2, authors3.author AS author3
        FROM books 
        JOIN books_authors ON books.id = books_authors.book_id
        JOIN authors ON books_authors.author_1_id = authors.id
        LEFT JOIN authors AS authors2 ON books_authors.author_2_id = authors2.id
        LEFT JOIN authors AS authors3 ON books_authors.author_3_id = authors3.id 
        LIMIT $limit OFFSET $offset")->fetchAll();

        $content[0]['admin_page'] = $page_number;
        $content[0]['admin_count_pages'] = $count_pages;
    } else {
        $content = $pdo->query("SELECT title, book_id, year, clicks, authors.author AS author, authors2.author AS author2, authors3.author AS author3
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

function delete_item ($id, &$pdo) {
    try {
        $stmt= $pdo->prepare("UPDATE books SET deleted_at = now() WHERE id = :id");
        $stmt->execute(['id' => $id]);
    } catch (Exception $e) {
        header( 'HTTP/1.1 500 Internal Server Error' );
        header('Content-type: application/json');
        echo json_encode(['error' => ' 500 Internal Server Error']);
        exit();
    }
}