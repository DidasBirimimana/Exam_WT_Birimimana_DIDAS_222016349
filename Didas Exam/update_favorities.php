<?php
include('Database_Connection.php');

// Check if UserID set
if(isset($_REQUEST['UserID'])) {
    $userID = $_REQUEST['UserID'];

    
    $stmt = $connection->prepare("SELECT * FROM favorites WHERE UserID=?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Record found, you may perform any necessary action here
        $row = $result->fetch_assoc();
        $userID = $row['UserID'];
        $listingID = $row['ListingID'];
    } else {
        echo "Favorite not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Favorites Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update favorites form -->
        <h2><u>Update Form of favorites</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
    
            <label for="ListingID">ListingID:</label>
            <input type="number" name="ll" value="<?php echo isset($listingID) ? $listingID : ''; ?>">
            <br><br>
    
            <input type="submit" name="up" value="Update">
            
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $listingID = $_POST['ll'];
    
    // Update the favorite in the database
    $stmt = $connection->prepare("UPDATE favorites SET ListingID=? WHERE UserID=?");
    $stmt->bind_param("ii", $listingID, $userID);
    $stmt->execute();
    
    // Redirect to some page
    header('Location: view_favorities.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
