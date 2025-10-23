<?php
const hostname = 'localhost';
const username = 'root';
const password = 'dimebag1966';
const database = 'feira';

$mysqli = new mysqli(hostname, username, password, database);
$mysqli->set_charset("utf8");
