<?php
include('Database_Connection.php');

// Check if ListingID is set
if(isset($_REQUEST['ListingID'])) {
    $lid = $_REQUEST['ListingID'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM listings WHERE ListingID=?");
    $stmt->bind_param("i", $lid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $listing_id = $row['ListingID'];
        $title = $row['Title'];
        $description = $row['Description'];
        $price = $row['Price'];
        $category_id = $row['CategoryID'];
        $location = $row['Location'];
        $date_posted = $row['DatePosted'];
        $status = $row['Status'];
    } else {
        echo "Listing not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Listings Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update listings form -->
        <h2><u>Update Form for Listings</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="Title">Title:</label>
            <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
            <br><br>

            <label for="Description">Description:</label>
            <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
            <br><br>

            <label for="Price">Price:</label>
            <input type="number" name="price" value="<?php echo isset($price) ? $price : ''; ?>">
            <br><br>

            <label for="CategoryID">Category ID:</label>
            <input type="number" name="category_id" value="<?php echo isset($category_id) ? $category_id : ''; ?>">
            <br><br>

            <label for="Location">Location:</label>
            <input type="text" name="location" value="<?php echo isset($location) ? $location : ''; ?>">
            <br><br>

            <label for="DatePosted">Date Posted:</label>
            <input type="datetime-local" name="date_posted" value="<?php echo isset($date_posted) ? $date_posted : ''; ?>">
            <br><br>

            <label for="Status">Status:</label>
            <input type="text" name="status" value="<?php echo isset($status) ? $status : ''; ?>">
            <br><br>

            <input type="submit" name="update" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    // Retrieve updated values from form
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $location = $_POST['location'];
    $date_posted = $_POST['date_posted'];
    $status = $_POST['status'];
    
    // Update the listing in the database
    $stmt = $connection->prepare("UPDATE listings SET Title=?, Description=?, Price=?, CategoryID=?, Location=?, DatePosted=?, Status=? WHERE ListingID=?");
    $stmt->bind_param("ssdissss", $title, $description, $price, $category_id, $location, $date_posted, $status, $listing_id);
    $stmt->execute();
    
    // Redirect to listings.php
    header('Location: view_listings.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
