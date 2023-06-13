<?php

require __DIR__ . '/../model/admin-model.php';

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    settype($delete_id, 'integer');
    delete_item ($delete_id,$pdo);
    $page = $_SERVER['HTTP_REFERER'];
    header("Location: $page");
}

require __DIR__ . '/../core/functions.php';
echo render('admin-template', $content);