<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('db_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Contact Form Submissions</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    input[type=checkbox] {
        transform: scale(1.3);
        padding: 10px;
        cursor: pointer;
    }
    td {
        vertical-align: middle !important;
    }
    td p {
        margin: unset;
    }
    table {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th {
        background-color: #28a745;
        color: white;
    }
    body {
      padding: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="mb-4">Contact Form Submissions</h2>
  
  <?php
  // Database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "clickfees_db";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch all contact messages
  $sql = "SELECT id, name, email, subject, message FROM contact_form";
  $result = $conn->query($sql);
  if (!$result) {
      die("Query failed: " . $conn->error);
  }
  ?>

  <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Subject</th>
          <th>Message</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row["id"]; ?></td>
            <td><?= htmlspecialchars($row["name"]); ?></td>
            <td><?= htmlspecialchars($row["email"]); ?></td>
            <td><?= htmlspecialchars($row["subject"]); ?></td>
            <td><?= nl2br(htmlspecialchars($row["message"])); ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info">No submissions found.</div>
  <?php endif; ?>

</div>

</body>
</html>

<?php
$conn->close();
?>
