<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$con = mysqli_connect('localhost', 'root', '', 'cs.project');
if (!$con) {
    die('Connection failed: ' . mysqli_connect_error());
}
mysqli_set_charset($con, 'utf8mb4');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

//get inputs
$first = trim($_POST['first_name'] ?? '');
$second = trim($_POST['second_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$pass = $_POST['password'] ?? '';
$remember = isset($_POST['remember']) ? 1 : 0;
$coursesA = $_POST['courses'] ?? [];
$courses = json_encode($coursesA, JSON_UNESCAPED_UNICODE);

//  check
if (empty($first) || empty($second) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pass) < 8) {
    die('Invalid input.');
}

// Insert
$stmt = mysqli_prepare($con, "INSERT INTO users (first_name, second_name, email, password, remember, courses) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die('Prepare failed.');
}
mysqli_stmt_bind_param($stmt, 'ssssis', $first, $second, $email, $pass, $remember, $courses);
if (!mysqli_stmt_execute($stmt)) {
    if (mysqli_errno($con) == 1062) {
        die('Email already exists.');
    }
    die('Insert failed.');
}

// Success
header('Location: welcome.php');
exit;
?>