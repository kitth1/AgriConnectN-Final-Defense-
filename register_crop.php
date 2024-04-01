
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Crop Estimation</title>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crop_name = $_POST['crop_name'];


    // echo "<p>Estimation submitted successfully!</p>";
}
?>

    <style>
        body, html {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }

        .harvest-form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        h2{

            text-align: center;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .submit-btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>


<?php

$host = 'localhost'; // Host name
$dbUsername = 'root'; // Database username
$dbPassword = ''; // Database password
$dbName = 'faccount'; // Database name

// Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crop_name = $conn->real_escape_string($_POST['crop_name']);
    $quantity = $conn->real_escape_string($_POST['quantity']);
    $date_received = $conn->real_escape_string($_POST['date_received']);

    $sql = "INSERT INTO crop_list_encode (crop_name, quantity, date_received) VALUES ('$crop_name', '$quantity', '$date_received')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "New record created successfully";
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>


<?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
    </div>
<?php elseif(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="register-crop-form">
    <h2>Register Crop</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="crop_name">Crop Name</label>
            <input type="text" id="crop_name" name="crop_name" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="date_received">Date Received</label>
            <input type="date" id="date_received" name="date_received" required>
        </div>
        <button type="submit" class="submit-btn">Submit</button>
    </form>
</div>


<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>