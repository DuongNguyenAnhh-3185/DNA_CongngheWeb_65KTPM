<?php
// database/connect.php
$pdo = new PDO("sqlite:../database/cse485.db");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("PRAGMA foreign_keys = ON;");

// Tạo bảng câu hỏi trắc nghiệm
$pdo->exec("CREATE TABLE IF NOT EXISTS questions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    question TEXT NOT NULL,
    option_a TEXT,
    option_b TEXT,
    option_c TEXT,
    option_d TEXT,
    answer TEXT NOT NULL
)");

// Tạo bảng users (sinh viên)
$pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    password TEXT,
    lastname TEXT,
    firstname TEXT,
    class TEXT,
    email TEXT
)");
?>