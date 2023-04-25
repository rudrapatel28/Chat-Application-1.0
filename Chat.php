<!DOCTYPE html>
<html>
<head>
    <title>Chat Application</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function loadChats() {
    $.ajax({
        url: "get_chats.php",
        type: "GET",
        success: function(data) {
            $("#chat-messages").html(data);
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error("Error loading chats:", errorThrown);
        }
    });
}

        // Function to submit chat message	
        function submitChat() {
            var name = $("#name").val();
            var message = $("#message").val();

            if (name === "" || message === "") {
                alert("Please enter your name and message.");
                return;
            }

            $.ajax({
                url: "submit_chat.php",
                type: "POST",
                data: { name: name, message: message },
                success: function(data) {
                    loadChats();
                    $("#message").val("");
                }
            });
        }

	// Function to delete all chat messages
function deleteAllChats() {
    if (confirm("Are you sure you want to delete all chat messages?")) {
        $.ajax({
            url: "delete_chat.php",
            type: "POST",
            success: function(data) {
                // Reload the page after successful deletion
                location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("Error deleting chats:", errorThrown);
            }
        });
    }
}
 // Function to update chat messages periodically
        function updateChats() {
            loadChats();
            setTimeout(updateChats, 5000); // Update every 5 seconds
        }

        // Load chat messages on page load and start updating periodically
        $(document).ready(function() {
            loadChats();
            updateChats();
        });
    </script>

    <style>

    /* CSS for chat application */

    /* Chat container */
    #chat-messages {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        height: 300px;
        overflow-y: scroll;
    }

    /* Chat messages */
    .chat-message {
        margin-bottom: 10px;
    }

    .chat-name {
        font-weight: bold;
    }

    .chat-timestamp {
        font-size: 12px;
        color: #666;
    }

    /* Chat form */
    #chat-form {
        width: 80%;
        margin: 0 auto;
        margin-top: 10px;
    }

    #chat-form label {
        display: block;
        margin-bottom: 5px;
    }

    #chat-form input[type="text"] {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
    }

    #chat-form input[type="button"] {
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    #chat-form input[type="button"]:hover {
        background-color: #0056b3;
    }

    </style>
</head>
<body>
    <h1>Chat Application</h1>
    <div id="chat-messages"></div>
    <form id="chat-form">
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="message">Message: </label>
        <input type="text" id="message" name="message" required>
        <br>
        <input type="button" value="Submit" onclick="submitChat()">
	  <input type="button" value="Delete Chats" onclick="deleteAllChats()">
    </form>
</body>
</html>
