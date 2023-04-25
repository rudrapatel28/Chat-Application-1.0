<?php
// Connect to MySQL database
$conn = mysqli_connect("sql1.njit.edu", "rmp32", "Mayurbhai1!", "rmp32");

// Check for connection errors
if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Query to retrieve data from Chat table
$query = "SELECT Name, Message, Timestamp FROM Chat ORDER BY Timestamp ASC";
$result = mysqli_query($conn, $query);

// Fetch data and print in one line
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '' . $row['Name'] . ':' . $row['Message'] . ' | Timestamp: ' . $row['Timestamp'] . '<br>';
    }
} else {
    echo 'No data found.';
}

// Close database connection
mysqli_close($conn);
?>
