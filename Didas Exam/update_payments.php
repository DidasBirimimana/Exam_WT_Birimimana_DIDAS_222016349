<?php
include('Database_Connection.php');

// Check if PaymentID is set
if(isset($_REQUEST['PaymentID'])) {
    $pid = $_REQUEST['PaymentID'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM payments WHERE PaymentID=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $payment_id = $row['PaymentID'];
        $user_id = $row['UserID'];
        $amount = $row['Amount'];
        $timestamp = $row['Timestamp'];
        $status = $row['Status'];
    } else {
        echo "Payment not found.";
    }

    // Close the database connection
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Payments Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update payments form -->
        <h2><u>Update Form for Payments</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">


            <label for="UserID">User ID:</label>
            <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
            <br><br>

            <label for="Amount">Amount:</label>
            <input type="number" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>">
            <br><br>

            <label for="Timestamp">Timestamp:</label>
            <input type="datetime-local" name="timestamp" value="<?php echo isset($timestamp) ? $timestamp : ''; ?>">
            <br><br>

            <label for="status">Status:</label>
            <select name="status">
                <option value="pending" <?php if(isset($status) && $status == "pending") echo "selected"; ?>>Pending</option>
                <option value="failed" <?php if(isset($status) && $status == "failed") echo "selected"; ?>>Failed</option>
                <option value="completed" <?php if(isset($status) && $status == "completed") echo "selected"; ?>>Completed</option>
            </select>

            <input type="submit" name="update" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    // Retrieve updated values from form
    $payment_id = $_POST['payment_id'];
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $timestamp = $_POST['timestamp'];
    $status = $_POST['status'];
    
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payments SET UserID=?, Amount=?, Timestamp=?, Status=? WHERE PaymentID=?");
    $stmt->bind_param("sdssi", $user_id, $amount, $timestamp, $status, $payment_id);
    $stmt->execute();
    
    // Redirect to payments.php or any other appropriate page
    header('Location: view_payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
