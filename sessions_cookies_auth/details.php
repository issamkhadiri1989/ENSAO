<?php 
echo 'Ipsum lorem dolore';

try {
	$pdo = new \PDO('mysql:host=projet_mysql_1;dbname=docker', 'root', 'tiger');
	echo 'connected';
} catch (\Exception $exception) {
	echo $exception->getMessage();
}