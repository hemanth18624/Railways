<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "payment_processing.css">
    <title>Payment Processing</title>
</head>
<body>
    <div class="center">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
    <div class="display">
        <h1>Payment Processing.....Please Wait</h1>
    </div>
    <script>
        setTimeout(function() {
          window.location.href = "generate_qr.php";
        }, 5000); // 5000 milliseconds = 5 seconds
      </script>
</body>
</html>
