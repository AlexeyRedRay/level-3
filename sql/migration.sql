USE Books;

CREATE TABLE authors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    author VARCHAR(255) UNIQUE NOT NULL CHECK (author != '')
);

INSERT ignore INTO authors (author)
SELECT author
FROM books_all;

INSERT ignore INTO authors (author)
SELECT authorTwo
FROM books_all;

INSERT ignore INTO authors (author)
SELECT authorThree
FROM books_all;

CREATE TABLE books_authors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    book_id INT,
    author_1_id INT,
    author_2_id INT,
    author_3_id INT
);

INSERT INTO books_authors (book_id, author_1_id, author_2_id, author_3_id)
SELECT books_all.id AS book_id, authors.id AS author_1_id, authors2.id AS author_2_id, authors3.id AS author_3_id
FROM books_all JOIN authors ON books.author = authors.author
           LEFT JOIN authors AS authors2 ON books.authorTwo = authors2.author
           LEFT JOIN authors AS authors3 ON books.authorThree = authors3.author;


ALTER TABLE books_all DROP COLUMN author;
ALTER TABLE books_all DROP COLUMN authorTwo;
ALTER TABLE books_all DROP COLUMN authorThree;

CREATE VIEW books AS SELECT * FROM books_all WHERE deleted_at IS NULL;