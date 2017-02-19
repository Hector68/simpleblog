<?php

$dbConfig = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];

return array_merge(
    $dbConfig,
    ( is_file(__DIR__.'/db-local.php') ? include __DIR__.'/db-local.php'  : []  )
);