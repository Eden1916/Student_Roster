<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Roster</title>
    <link rel="stylesheet" href="rost.css">
</head>
<body>
<?php
include ('index.html');
$servername = 'localhost';
$username = 'root';
$pass = '';

$conn = new mysqli($servername, $username, $pass);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$DB = "CREATE DATABASE IF NOT EXISTS STUD_ROSTER20";
if ($conn->query($DB) === TRUE) {
    echo "";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}
$conn->select_db("STUD_ROSTER20");

$TB = "CREATE TABLE IF NOT EXISTS Stud_roster22 (
    id INT(3) AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(30) NOT NULL,
    stud_id VARCHAR(10) NOT NULL,
    gender VARCHAR(6) NOT NULL,
    age INT(3) NOT NULL,
    maths INT(3) NOT NULL,
    english INT(3) NOT NULL,
    biology INT(3) NOT NULL,
    physics INT(3) NOT NULL,
    chemistry INT(3) NOT NULL,
    total INT(4) NOT NULL,
    average DOUBLE NOT NULL,
    rank VARCHAR(1) NOT NULL,
    status ENUM('Pass','Fail') NOT NULL
)";
if ($conn->query($TB) === TRUE) {
    echo "";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['fullname'];
    $stud_id = $_POST['stud_id'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $maths = $_POST['marks']['maths'];
    $eng = $_POST['marks']['eng'];
    $bio = $_POST['marks']['bio'];
    $phy = $_POST['marks']['phy'];
    $chem = $_POST['marks']['chem'];

    $total = $maths + $eng + $bio + $phy + $chem;
    $average = $total / 5;

    if ($average >= 85) {
        $rank = 'A';
    } elseif ($average >= 75) {
        $rank = 'B';
    } elseif ($average >= 65) {
        $rank = 'C';
    } elseif ($average >= 50) {
        $rank = 'D';
    } else {
        $rank = 'F';
    }

    $status = ($average >= 50) ? 'Pass' : 'Fail';

    $sql = "INSERT INTO Stud_roster22 (fullname, stud_id, gender, age, maths, english, biology, physics, chemistry, total, average, rank, status) 
            VALUES ('$name', '$stud_id', '$gender', $age, $maths, $eng, $bio, $phy, $chem, $total, $average, '$rank', '$status')";
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}

$selectsql = "SELECT * FROM Stud_roster22";
$result = $conn->query($selectsql);
if ($result->num_rows > 0) {
    echo "<table>
    <tr>
    <th>Full Name</th>
    <th>Student ID</th>
    <th>Gender</th>
    <th>Age</th>
    <th>Maths</th>
    <th>English</th>
    <th>Biology</th>
    <th>Physics</th>
    <th>Chemistry</th>
    <th>Total</th>
    <th>Average</th>
    <th>Rank</th>
    <th>Status</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        $statusClass = ($row['status'] == 'Pass') ? 'Pass' : 'Fail';
        echo "<tr>
        <td>" . $row['fullname'] . "</td>
        <td>" . $row['stud_id'] . "</td>
        <td>" . $row['gender'] . "</td>
        <td>" . $row['age'] . "</td>
        <td>" . $row['maths'] . "</td>
        <td>" . $row['english'] . "</td>
        <td>" . $row['biology'] . "</td>
        <td>" . $row['physics'] . "</td>
        <td>" . $row['chemistry'] . "</td>
        <td>" . $row['total'] . "</td>
        <td>" . $row['average'] . "</td>
        <td>" . $row['rank'] . "</td>
        <td class='" . $statusClass . "'>" . $row['status'] . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results found.";
}

$conn->close();
?>