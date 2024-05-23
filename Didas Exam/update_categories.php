<?php
include('Database_Connection.php');

// Check if CategoryID is set
if(isset($_REQUEST['CategoryID'])) {
    $categoryID = $_REQUEST['CategoryID'];

    $stmt = $connection->prepare("SELECT * FROM categories WHERE CategoryID=?");
    $stmt->bind_param("i", $categoryID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        // Record found, you may perform any necessary action here
        $row = $result->fetch_assoc();
        $categoryID = $row['CategoryID'];
        $name = $row['Name'];
        $description = $row['Description'];
    } else {
        echo "Category not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Category Record</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update categories form -->
        <h2><u>Update Form of Categories</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
    
            <label for="Name">Name:</label>
            <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
            <br><br>

            <label for="Description">Description:</label>
            <textarea name="description"><?php echo isset($description) ? $description : ''; ?></textarea>
            <br><br>
    
            <input type="submit" name="up" value="Update">
            
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Update the category in the database
    $stmt = $connection->prepare("UPDATE categories SET Name=?, Description=? WHERE CategoryID=?");
    $stmt->bind_param("ssi", $name, $description, $categoryID);
    $stmt->execute();

    // Redirect to some page
    header('Location: view_categories.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
