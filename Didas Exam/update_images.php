<?php
include('Database_Connection.php');

// Check if ImageID is set
if(isset($_REQUEST['ImageID'])) {
    $imageID = $_REQUEST['ImageID'];
    
    $stmt = $connection->prepare("SELECT * FROM images WHERE ImageID=?");
    $stmt->bind_param("i", $imageID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ImageID'];
        $y = $row['ListingID'];
        $z = $row['ImageURL'];
        $w = $row['Description'];
    } else {
        echo "Image not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Images Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update images form -->
    <h2><u>Update Form of Images</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="ListingID">ListingID:</label>
        <input type="number" name="ll" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="ImageURL">Image URL:</label>
        <input type="text" name="url" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Description">Description:</label>
        <input type="text" name="dd" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $ListingID = $_POST['ll'];
    $ImageURL = $_POST['url'];
    $Description = $_POST['dd'];
    
    // Update the image in the database
    $stmt = $connection->prepare("UPDATE images SET ListingID=?, ImageURL=?, Description=? WHERE ImageID=?");
    $stmt->bind_param("issi", $ListingID, $ImageURL, $Description, $imageID);
    $stmt->execute();
    
    // Redirect to some page
    header('Location: view_images.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
