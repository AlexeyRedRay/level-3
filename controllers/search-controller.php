<?php

require __DIR__ . '/../model/search-model.php';

require __DIR__ . '/../core/functions.php';

$content = render('books-template', $array_db);

$content = '<p style="font-weight: bold"> "' . $text_search . '" found ' .  count($array_db) .' </p>' . $content;

echo render('general-template', $content);