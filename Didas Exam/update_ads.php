<?php
include('Database_Connection.php');

// Check if AdID is set
if(isset($_REQUEST['AdID'])) {
    $adID = $_REQUEST['AdID'];
    
    $stmt = $connection->prepare("SELECT * FROM ads WHERE AdID=?");
    $stmt->bind_param("i", $adID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $ListingID = $row['ListingID'];
        $Title = $row['Title'];
        $Description = $row['Description'];
        $Price = $row['Price'];
        $CategoryID = $row['CategoryID'];
        $Location = $row['Location'];
        $DatePosted = $row['DatePosted'];
        $Status = $row['Status'];
    } else {
        echo "Ad not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Ads Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update ads form -->
        <h2><u>Update Form of Ads</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="UserID">UserID:</label>
            <input type="number" name="uid" value="<?php echo isset($UserID) ? $UserID : ''; ?>">
            <br><br>

            <label for="ListingID">ListingID:</label>
            <input type="number" name="lid" value="<?php echo isset($ListingID) ? $ListingID : ''; ?>">
            <br><br>

            <label for="Title">Title:</label>
            <input type="text" name="title" value="<?php echo isset($Title) ? $Title : ''; ?>">
            <br><br>

            <label for="Description">Description:</label>
            <input type="text" name="description" value="<?php echo isset($Description) ? $Description : ''; ?>">
            <br><br>

            <label for="Price">Price:</label>
            <input type="number" name="price" value="<?php echo isset($Price) ? $Price : ''; ?>">
            <br><br>

            <label for="CategoryID">CategoryID:</label>
            <input type="number" name="category_id" value="<?php echo isset($CategoryID) ? $CategoryID : ''; ?>">
            <br><br>

            <label for="Location">Location:</label>
            <input type="text" name="location" value="<?php echo isset($Location) ? $Location : ''; ?>">
            <br><br>

            <label for="DatePosted">DatePosted:</label>
            <input type="date" name="date_posted" value="<?php echo isset($DatePosted) ? $DatePosted : ''; ?>">
            <br><br>

            <label for="Status">Status:</label>
            <input type="text" name="status" value="<?php echo isset($Status) ? $Status : ''; ?>">
            <br><br>

            <input type="submit" name="update" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    // Retrieve updated values from form
    $UserID = $_POST['uid'];
    $ListingID = $_POST['lid'];
    $Title = $_POST['title'];
    $Description = $_POST['description'];
    $Price = $_POST['price'];
    $CategoryID = $_POST['category_id'];
    $Location = $_POST['location'];
    $DatePosted = $_POST['date_posted'];
    $Status = $_POST['status'];
    
    // Update the ad in the database
    $stmt = $connection->prepare("UPDATE ads SET UserID=?, ListingID=?, Title=?, Description=?, Price=?, CategoryID=?, Location=?, DatePosted=?, Status=? WHERE AdID=?");
    $stmt->bind_param("iisssisssi", $UserID, $ListingID, $Title, $Description, $Price, $CategoryID, $Location, $DatePosted, $Status, $adID);
    $stmt->execute();
    
    // Redirect to some page
    header('Location: view_ads.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
