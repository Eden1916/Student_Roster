<link rel="stylesheet" href="update.css">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "STUD_ROSTER20";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get student ID from URL
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM stud_roster WHERE id=$id");

if ($result->num_rows == 0) {
    echo "Record not found.";
    exit;
}

$row = $result->fetch_assoc();
?>

<h2 class="edit-title">Edit Student Data</h2>
<form action="update.php?id=<?php echo $id; ?>" method="POST">
    <div class="update-container">
    <label>Full Name</label>
    <input type="text" name="fullname" value="<?php echo $row['fullname']; ?>" required>

    <label>Student ID</label>
    <input type="text" name="stud_id" value="<?php echo $row['stud_id']; ?>" required>

    <label>Gender</label>
    <select name="gender" required>
        <option value="Male" <?php if($row['gender']=='Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if($row['gender']=='Female') echo 'selected'; ?>>Female</option>
    </select>

    <label>Age</label>
    <input type="number" name="age" value="<?php echo $row['age']; ?>" required>

    <label>Maths</label>
    <input type="number" name="marks[maths]" value="<?php echo $row['maths']; ?>" required>

    <label>English</label>
    <input type="number" name="marks[eng]" value="<?php echo $row['english']; ?>" required>

    <label>Biology</label>
    <input type="number" name="marks[bio]" value="<?php echo $row['biology']; ?>" required>

    <label>Physics</label>
    <input type="number" name="marks[phy]" value="<?php echo $row['physics']; ?>" required>

    <label>Chemistry</label>
    <input type="number" name="marks[chem]" value="<?php echo $row['chemistry']; ?>" required>

    <button type="submit">Update</button>
</div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$fullname = $_POST['fullname'];
$stud_id = $_POST['stud_id'];
$gender = $_POST['gender'];
$age = $_POST['age'];

$maths = $_POST['marks']['maths'];
$eng = $_POST['marks']['eng'];
$bio = $_POST['marks']['bio'];
$phy = $_POST['marks']['phy'];
$chem = $_POST['marks']['chem'];

// Recalculate total, average, rank, status
$marks = [$maths, $eng, $bio, $phy, $chem];
$total = array_sum($marks);
$average = $total / 5;

if ($average >= 85) $rank = "A";
else if ($average >= 75) $rank = "B";
else if ($average >= 65) $rank = "C";
else if ($average >= 50) $rank = "D";
else $rank = "F";

$status = ($average >= 50) ? "Pass" : "Fail";

// Update query using prepared statement
$stmt = $conn->prepare("UPDATE stud_roster SET fullname=?, stud_id=?, gender=?, age=?, maths=?, english=?, biology=?, physics=?, chemistry=?, total=?, average=?, rank=?, status=? WHERE id=?");
$stmt->bind_param("sssiiiiiiidssi",
    $fullname, $stud_id, $gender, $age,
    $maths, $eng, $bio, $phy, $chem,
    $total, $average, $rank, $status, $id
);
$stmt->execute();
$stmt->close();

echo "Record updated successfully! <a href='roster.php'>Go back</a>";
}
?>