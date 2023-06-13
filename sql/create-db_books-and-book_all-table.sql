CREATE DATABASE Books;

USE Books;

CREATE TABLE books_all (
   id INT PRIMARY KEY AUTO_INCREMENT,
   author_1_id int,
   author_2_id int,
   author_3_id int,
   description	text,
   year	smallint,
   pages smallint,
   isbn	varchar(255),
   views int DEFAULT(0),
   clicks int DEFAULT(0),
   deleted_at datetime DEFAULT(NULL)
);