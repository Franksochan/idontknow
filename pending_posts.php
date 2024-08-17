<?php
// Start the session
session_start();

// Include your database connection
include('connect_db.php');

// Handle status update requests
if (isset($_POST['action']) && isset($_POST['post_id'])) {
    $post_id = intval($_POST['post_id']);
    $status = $_POST['action'] === 'approve' ? 'accepted' : 'rejected';

    // Prepare the SQL statement to update the post status
    $sql = "UPDATE posts SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $post_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'action' => $_POST['action']]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Fetch pending posts from the database
$sql = "SELECT posts.*, users.username AS author_name FROM posts 
        LEFT JOIN users ON posts.user_id = users.id
        WHERE posts.status = 'pending'
        ORDER BY posts.id DESC";
$result = $conn->query($sql);

$pending_posts = [];
while ($row = $result->fetch_assoc()) {
    $pending_posts[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pending Posts</title>
    <link rel="stylesheet" href="css/pendingposts.css">
</head>
<body>
    <h1>Pending Posts</h1>
    <table>
        <thead>
            <tr>
                <th>Post Content</th>
                <th>Author</th>
                <th>Created</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be inserted here by JavaScript -->
        </tbody>
    </table>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function fetchPendingPosts() {
            // Data is already embedded in the PHP section, no need to fetch again
            const posts = <?php echo json_encode($pending_posts); ?>;
            const tableBody = document.querySelector('tbody');
            tableBody.innerHTML = '';

            posts.forEach(post => {
                const row = document.createElement('tr');
                row.id = `post-${post.id}`; // Set a unique ID for each row
                row.innerHTML = `
                    <td>${post.content}</td>
                    <td>${post.author_name || 'Anonymous'}</td>
                    <td>${new Date(post.created_at).toLocaleDateString()}</td>
                    <td>${post.status}</td>
                    <td>
                        <button class="approve-btn" data-post-id="${post.id}">Approve</button>
                        <button class="reject-btn" data-post-id="${post.id}">Reject</button>
                        <button class="edit-btn" data-post-id="${post.id}">Edit</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Attach event listeners to buttons
            document.querySelectorAll('.approve-btn').forEach(button => {
                button.addEventListener('click', function() {
                    updatePostStatus(this.dataset.postId, 'approve');
                });
            });

            document.querySelectorAll('.reject-btn').forEach(button => {
                button.addEventListener('click', function() {
                    updatePostStatus(this.dataset.postId, 'reject');
                });
            });
        }

        function updatePostStatus(postId, action) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'pending_posts.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        const row = document.getElementById(`post-${postId}`);
                        if (row) {
                            row.remove(); // Remove the row from the table
                        }
                        if (response.action === 'approve') {
                            alert('The post has been approved.');
                        } else if (response.action === 'reject') {
                            alert('The post has been rejected.');
                        }
                    } else {
                        alert('There was an error updating the post status.');
                    }
                }
            };
            xhr.send(`post_id=${encodeURIComponent(postId)}&action=${encodeURIComponent(action)}`);
        }

        fetchPendingPosts();
    });
    </script>
</body>
</html>
