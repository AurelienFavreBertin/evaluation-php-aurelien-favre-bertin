<?php

const DB_HOST = 'localhost';
const DB_NAME = 'immobilier';
const DB_PORT = '3306';
const DB_USER = 'root';
const DB_PSWD = '';
$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8;port=' . DB_PORT, DB_USER, DB_PSWD);




