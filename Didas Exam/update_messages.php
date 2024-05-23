<?php
include('Database_Connection.php');

// Check if MessageID is set
if(isset($_REQUEST['MessageID'])) {
    $mid = $_REQUEST['MessageID'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM messages WHERE MessageID=?");
    $stmt->bind_param("i", $mid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $mid = $row['MessageID'];
        $sender_id = $row['SenderID'];
        $receiver_id = $row['ReceiverID'];
        $listing_id = $row['ListingID'];
        $timestamp = $row['Timestamp'];
        $content = $row['Content'];
    } else {
        echo "Message not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Message Record</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update message form -->
        <h2><u>Update Form for Messages</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="SenderID">SenderID:</label>
            <input type="text" name="sender_id" value="<?php echo isset($sender_id) ? $sender_id : ''; ?>">
            <br><br>

            <label for="ReceiverID">ReceiverID:</label>
            <input type="text" name="receiver_id" value="<?php echo isset($receiver_id) ? $receiver_id : ''; ?>">
            <br><br>

            <label for="ListingID">ListingID:</label>
            <input type="number" name="listing_id" value="<?php echo isset($listing_id) ? $listing_id : ''; ?>">
            <br><br>

            <label for="Timestamp">Timestamp:</label>
            <input type="datetime-local" name="timestamp" value="<?php echo isset($timestamp) ? $timestamp : ''; ?>">
            <br><br>

            <label for="Content">Content:</label>
            <input type="text" name="content" value="<?php echo isset($content) ? $content : ''; ?>">
            <br><br>

            <input type="submit" name="update" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    // Retrieve updated values from form
    
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $listing_id = $_POST['listing_id'];
    $timestamp = $_POST['timestamp'];
    $content = $_POST['content'];
    
    // Update the message in the database
    $stmt = $connection->prepare("UPDATE messages SET SenderID=?, ReceiverID=?, ListingID=?, Timestamp=?, Content=? WHERE MessageID=?");
    $stmt->bind_param("sssisi", $sender_id, $receiver_id, $listing_id, $timestamp, $content, $message_id);
    $stmt->execute();
    
    // Redirect to appropriate page
    header('Location: view_messages.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
