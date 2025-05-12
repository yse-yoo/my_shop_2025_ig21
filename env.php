<?php
// Database
const DB_CONNECTION = 'mysql';
const DB_HOST = 'localhost';

const DB_PORT = 3306;
const DB_DATABASE = 'my_shop';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

// APP
const APP_KEY = "my_shop";
const SITE_TITLE = "My Shop";

// サイトベースURL
define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
// const BASE_URL = "http://localhost/my_shop/";