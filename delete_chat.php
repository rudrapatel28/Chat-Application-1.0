<?php
$conn = mysqli_connect("sql1.njit.edu", "rmp32", "Mayurbhai1!", "rmp32");

// Check for connection errors
if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Delete all rows from the chats table
$query = "DELETE FROM Chat";
$result = mysqli_query($conn, $query); // Changed from $conn->query($query)

if ($result) {
    // If deletion is successful, return success message
    $response = array('status' => 'success', 'message' => 'All chat messages deleted successfully');
} else {
    // If deletion fails, return error message
    $response = array('status' => 'error', 'message' => 'Failed to delete chat messages');
}

// Close database connection
mysqli_close($conn); // Changed from $conn->close()

// Return response as JSON
echo json_encode($response);
?>
