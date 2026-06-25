<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "", "STUD_ROSTER20");

// Stop if connection fails
if ($conn->connect_error) {
    die("ERROR: Database connection failed.");
}

// Handle POST (AJAX submission)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullname = $_POST["fullname"];
    $stud_id  = $_POST["stud_id"];
    $gender   = $_POST["gender"];
    $age      = intval($_POST["age"]);

    $maths = intval($_POST['marks']['maths']);
    $eng   = intval($_POST['marks']['eng']);
    $bio   = intval($_POST['marks']['bio']);
    $phy   = intval($_POST['marks']['phy']);
    $chem  = intval($_POST['marks']['chem']);

    // ----------------------------
    //  VALIDATION RULES
    // ----------------------------

    // Validate age
    if ($age < 0 || $age > 120) {
        echo "ERROR: Age must be between 0 and 120.";
        exit;
    }

    // Validate subject marks
    $marks = [$maths, $eng, $bio, $phy, $chem];
    foreach ($marks as $m) {
        if ($m < 0 || $m > 100) {
            echo "ERROR: Marks must be between 0 and 100.";
            exit;
        }
    }

    // Total and average
    $total = $maths + $eng + $bio + $phy + $chem;
    $average = $total / 5;

    // Rank
    if ($average >= 85)      $rank = "A";
    else if ($average >= 75) $rank = "B";
    else if ($average >= 65) $rank = "C";
    else if ($average >= 50) $rank = "D";
    else                     $rank = "F";

    $status = ($average >= 50) ? "Pass" : "Fail";

    // Insert into DB
    $query = "INSERT INTO stud_roster 
        (fullname, stud_id, gender, age, maths, english, biology, physics, chemistry, total, average, rank, status)
        VALUES ('$fullname', '$stud_id', '$gender', '$age', '$maths', '$eng', '$bio', '$phy', '$chem', '$total', '$average', '$rank', '$status')";

    if ($conn->query($query)) {
        echo "SUCCESS"; 
    } else {
        echo "ERROR: Could not save data.";
    }

    exit; // <- Important: stop page from loading full HTML
}

// If NOT POST → Display roster page below
$result = $conn->query("SELECT * FROM stud_roster");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Roster</title>
    <link rel="stylesheet" href="roster.css">
    <link rel="icon" type="image/png" href="webTab.png">
</head>
<body>

<h2 class="title">Student Roster</h2>

<!-- Back button -->
<div style="text-align:center;">
    <a href="index.html">
        <button style="width:auto;">➤ Enter New Student</button>
    </a>
</div>

<table class="roster-table">
    <tr>
        <th>Full Name</th>
        <th>ID</th>
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
        <th>Edit</th>
    </tr>

<?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['fullname'] ?></td>
        <td><?= $row['stud_id'] ?></td>
        <td><?= $row['gender'] ?></td>
        <td><?= $row['age'] ?></td>
        <td><?= $row['maths'] ?></td>
        <td><?= $row['english'] ?></td>
        <td><?= $row['biology'] ?></td>
        <td><?= $row['physics'] ?></td>
        <td><?= $row['chemistry'] ?></td>
        <td><?= $row['total'] ?></td>
        <td><?= $row['average'] ?></td>
        <td><?= $row['rank'] ?></td>
        <td class="<?= strtolower($row['status']) ?>">
            <?= $row['status'] ?>
        </td>
        <td>
            <a href="update.php?id=<?= $row['id']?>" class='edit-btn'>Edit</a>
        </td>
    </tr>
<?php endwhile; ?>

</table>

</body>
</html>
