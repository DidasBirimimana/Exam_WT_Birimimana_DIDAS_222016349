<?php
include('Database_Connection.php');

// Check if InstructorID is set
if(isset($_REQUEST['InstructorID'])) {
    $InstructorID = $_REQUEST['InstructorID'];
    
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE InstructorID=?");
    $stmt->bind_param("i", $InstructorID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['InstructorID'];
        $y = $row['UserID'];
        $z = $row['Bio'];
    } else {
        echo "Instructor not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Instructors Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update instructors form -->
    <h2><u>Update Form for Instructors</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

  
        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Bio">Bio:</label>
        <input type="text" name="Bio" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
  
    $UserID = $_POST['UserID'];
    $Bio = $_POST['Bio'];
    
    // Update the instructor in the database
    $stmt = $connection->prepare("UPDATE instructors SET UserID=?, Bio=? WHERE InstructorID=?");
    $stmt->bind_param("isi", $UserID, $Bio, $InstructorID);
    $stmt->execute();
    
    // Redirect to instructors.php
    header('Location: view_instructors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
