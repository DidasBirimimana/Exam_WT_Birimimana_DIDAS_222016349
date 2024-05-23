<?php
include('Database_Connection.php');

// Check if FeedbackID is set
if(isset($_REQUEST['FeedbackID'])) {
    $feedbackID = $_REQUEST['FeedbackID'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE FeedbackID=?");
    $stmt->bind_param("i", $feedbackID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $feedback_id = $row['FeedbackID'];
        $from_user_id = $row['FromUserID'];
        $to_user_id = $row['ToUserID'];
        $listing_id = $row['ListingID'];
        $rating = $row['Rating'];
        $comments = $row['Comments'];
        $timestamp = $row['Timestamp'];
    } else {
        echo "Feedback not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Feedback Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update feedback form -->
        <h2><u>Update Form for Feedback</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">


            <label for="FromUserID">From User ID:</label>
            <input type="text" name="from_user_id" value="<?php echo isset($from_user_id) ? $from_user_id : ''; ?>">
            <br><br>

            <label for="ToUserID">To User ID:</label>
            <input type="text" name="to_user_id" value="<?php echo isset($to_user_id) ? $to_user_id : ''; ?>">
            <br><br>

            <label for="ListingID">Listing ID:</label>
            <input type="number" name="listing_id" value="<?php echo isset($listing_id) ? $listing_id : ''; ?>">
            <br><br>

            <label for="Rating">Rating:</label>
            <input type="number" name="rating" value="<?php echo isset($rating) ? $rating : ''; ?>">
            <br><br>

            <label for="Comments">Comments:</label>
            <input type="text" name="comments" value="<?php echo isset($comments) ? $comments : ''; ?>">
            <br><br>

            <label for="Timestamp">Timestamp:</label>
            <input type="datetime-local" name="timestamp" value="<?php echo isset($timestamp) ? $timestamp : ''; ?>">
            <br><br>

            <input type="hidden" name="feedbackID" value="<?php echo $feedbackID; ?>"> <!-- Hidden field to pass FeedbackID -->
            <input type="submit" name="update" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    // Retrieve updated values from form
    $from_user_id = $_POST['from_user_id'];
    $to_user_id = $_POST['to_user_id'];
    $listing_id = $_POST['listing_id'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];
    $timestamp = $_POST['timestamp'];
    $feedbackID = $_POST['feedbackID']; // Fetch FeedbackID from hidden field
    
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET FromUserID=?, ToUserID=?, ListingID=?, Rating=?, Comments=?, Timestamp=? WHERE FeedbackID=?");
    $stmt->bind_param("iiiissi", $from_user_id, $to_user_id, $listing_id, $rating, $comments, $timestamp, $feedbackID);
    $stmt->execute();
    
    // Redirect to view_feedback.php or any other appropriate page
    header('Location: view_feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
