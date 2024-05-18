<?php
session_start();

// Get the QR image filename from the URL parameter
$qr_image = $_GET['qr_image'];
$image_path = 'generated_qr_codes/' . $qr_image;

if (!file_exists($image_path)) {
  die('Error: QR code image not found.');
}

// Read the QR code content (ticket details) from the session
if (isset($_SESSION['ticket_details'])) {
  $ticket_details = $_SESSION['ticket_details'];
} else {
  die('Error: Ticket details not found in session.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticket Details</title>
  <style>
    .container {
      text-align: center;
      margin-top: 50px;
    }
    .qr-code {
      margin-bottom: 20px;
    }
    .ticket-details {
      text-align: left;
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Scan the QR Code to get Ticket Details</h1>
    <div class="qr-code">
      <img src="<?php echo $image_path; ?>" alt="QR Code">
    </div>
    <div class="ticket-details">
      <h2>Ticket Details</h2>
      <ul>
        <?php
          foreach ($ticket_details as $key => $value) {
            echo "<li><b>$key:</b> $value</li>";
          }
        ?>
      </ul>
    </div>
  </div>
</body>
</html>
