<?php

require __DIR__ . '/../model/books-model.php';

require __DIR__ . '/../core/functions.php';

$content = render('books-template', $array_db);

echo render('general-template', $content);