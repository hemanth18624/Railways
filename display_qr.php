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
  $name = $ticket_details['name'];
  $age = $ticket_details['age'];
  $gender = $ticket_details['gender'];
  $berthType = $ticket_details['berthType'];
  $phone_no = $ticket_details['phone_no'];
  $email = $ticket_details['email'];
  $no_of_tickets = $ticket_details['no_of_tickets'];
  $train_id = $ticket_details['train_id'];
  $train_name = $ticket_details['train_name'];
  $source = $ticket_details['source'];
  $destination = $ticket_details['destination'];
  $date_of_journey = $ticket_details['date_of_journey'];
  $pnr_no = $ticket_details['pnr_no'];
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
      margin-top:20px;
    }
    #bot3{
      display:flex;
      align-items:center;
    }
    .ticket-details{
      margin-left:120px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Scan the QR Code to get Ticket Details</h1>
    <h2>Please download the QRCode for entry</h2>
    <div class="qr-code">
      <img src="<?php echo $image_path; ?>" alt="QR Code">
    </div>
    <button id="bot3">download
  </button>
  <div class="ticket-details">
      <h2>Ticket Details</h2>
      <p><strong>PNR No:</strong> <?php echo $pnr_no; ?></p>
      <p><strong>Name:</strong> <?php echo $name; ?></p>
      <p><strong>Age:</strong> <?php echo $age; ?></p>
      <p><strong>Gender:</strong> <?php echo $gender; ?></p>
      <p><strong>Berth Type:</strong> <?php echo $berthType; ?></p>
      <p><strong>Phone No:</strong> <?php echo $phone_no; ?></p>
      <p><strong>Email:</strong> <?php echo $email; ?></p>
      <p><strong>Number of Tickets:</strong> <?php echo $no_of_tickets; ?></p>
      <p><strong>Train ID:</strong> <?php echo $train_id; ?></p>
      <p><strong>Train Name:</strong> <?php echo $train_name; ?></p>
      <p><strong>Source:</strong> <?php echo $source; ?></p>
      <p><strong>Destination:</strong> <?php echo $destination; ?></p>
      <p><strong>Date of Journey:</strong> <?php echo $date_of_journey; ?></p>
    </div>

  </div>
  <script>
    const a=document.getElementById('bot3');
    a.addEventListener('click',function(){print()});
  </script>
</body>
</html>
