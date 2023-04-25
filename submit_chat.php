<?php
// Establish database connection
$conn = mysqli_connect("sql1.njit.edu", "rmp32", "Mayurbhai1!", "rmp32"); // Replace with your database credentials

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $message = $_POST["message"];

    // Insert the new message into the database, even if the name already exists
    $sql = "INSERT INTO Chat (Name, Message, Timestamp) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name, $message);
    $result = mysqli_stmt_execute($stmt);

    // Check if insert was successful
    if ($result) {
        echo "Message submitted successfully";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close database connection
mysqli_close($conn);
?>
