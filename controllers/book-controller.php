<?php
require __DIR__ . '/../model/book-model.php';

require __DIR__ . '/../core/functions.php';

$content = render('book-template', $array_db);

echo render('general-template', $content);