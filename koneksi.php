<?php
// DB connection. Reads env vars (Docker / hosting); falls back to the old
// localhost XAMPP defaults so running it bare still works.
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db   = getenv('DB_NAME') ?: 'db_alumni_tracer';
$port = (int)(getenv('DB_PORT') ?: 3306);

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
