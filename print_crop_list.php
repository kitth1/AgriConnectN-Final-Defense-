<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crop List for <?php echo htmlspecialchars($farmName); ?></title>
</head>
<body onload="window.print();">
    <h2>Crop List for <?php echo htmlspecialchars($farmName); ?></h2>
    <table border="1">
        <thead>
            <tr>
                <th>Crop Name</th>
                <th>Date Planted</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['crop_name']); ?></td>
                <td><?php echo htmlspecialchars($row['date_planted']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

    <style>
/* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body, html {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9;
}

.container {
    width: auto;
    max-width: 60%;
    margin: auto;
    padding: 40px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th, .table td {
    text-align: left;
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
}

.table th {
    background-color: #4CAF50;
    color: white;
}

.table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.btn {
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    font-size: 16px;
    margin-right: 10px;
}

.btn-primary {
    background-color: #4CAF50;
    color: white;
    border: none;
}

.no-print {
    display: inline-block;
}

/* Print-specific styles */
@media print {
    body, html {
        background: none;
        -webkit-print-color-adjust: exact; /* Ensures that background color and images are printed */
    }

    .container {
        box-shadow: none;
        margin: 0;
        width: auto;
        max-width: 100%;
    }

    .table th, .table td {
        border: 1px solid #000; /* Ensures the table borders are visible when printed */
    }

    .table th {
        background-color: #fff; /* Removes the background color */
        color: #000; /* Sets the text color to black */
    }

    .btn, .no-print {
        display: none; /* Hide elements that shouldn't be printed */
    }


@media (max-width: 768px) {
    .container {
        width: 95%;
        max-width: none;
    }
}
}
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faccount";
// Assuming 'farmName' is passed as a GET parameter in the URL
$farmName = isset($_GET['farmName']) ? $_GET['farmName'] : '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL query using placeholders to avoid SQL injection
$sql = "SELECT crop_name, date_planted FROM crop_list WHERE farm_n = ?";
$stmt = $conn->prepare($sql);

// Bind the farm name parameter and execute the query
$stmt->bind_param("s", $farmName);
$stmt->execute();
$result = $stmt->get_result();
?>

