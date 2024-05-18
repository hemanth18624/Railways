<?php
session_start();

// Include the QR code library
require 'phpqrcode/qrlib.php'; // Ensure the path is correct

// Check if session data is available
if (!isset($_SESSION['ticket_details'])) {
    die('Error: Session data not available.');
}

// Collect ticket details from session
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
$gen_price = $ticket_details['gen_price'];
$sleeper_price = $ticket_details['sleeper_price'];
$ac_price = $ticket_details['ac_price'];
$distance = $ticket_details['distance'];
$gen_count = $ticket_details['gen_count'];
$sleeper_count = $ticket_details['sleeper_count'];
$ac_count = $ticket_details['ac_count'];

// Combine the details into a single string
$ticket_info = "Name: $name\nAge: $age\nGender: $gender\nBerth Type: $berthType\nPhone No: $phone_no\nEmail: $email\nNumber of Tickets: $no_of_tickets\nTrain ID: $train_id\nTrain Name: $train_name\nSource: $source\nDestination: $destination\nDate of Journey: $date_of_journey\nGeneral Price: $gen_price\nSleeper Price: $sleeper_price\nAC Price: $ac_price\nDistance: $distance\nGeneral Count: $gen_count\nSleeper Count: $sleeper_count\nAC Count: $ac_count";

// Generate a unique identifier for the QR code file name
$unique_input = uniqid('ticket_');

// Define the path where the QR code image will be
//saved
$image_path = 'generated_qr_codes/' . $unique_input . '.png';

// Ensure the directory exists and is writable
if (!file_exists('generated_qr_codes')) {
mkdir('generated_qr_codes', 0777, true);
}

// Generate the QR code image with the ticket details
QRcode::png($ticket_info, $image_path);

// Check if the image was saved successfully
if (!file_exists($image_path)) {
die('Error: Unable to save QR code image.');
}

// Redirect to the page where the QR code will be displayed
header('Location: display_qr.php?qr_image=' . urlencode($unique_input . '.png'));
exit;
?>
