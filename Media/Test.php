<?php
require_once 'Article.php';
require_once 'Book.php';

//$Article = new Article('Test Article', 'Issam');
//echo $Article;

$Book = new Book('Book title', 'Ceeator', 6);
$Book->displayTitle();