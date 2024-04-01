<!DOCTYPE html>
<html lang="en">
<head>
    <!-- [existing head elements] -->
    <title>Crops</title>
    <!-- [existing style elements] -->
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar links -->
        <a href="/AgriConnectN/admin_page.php">Back</a>
    </div>
    <div class="main-content">
        <div class="dashboard-box">

        <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "faccount";
 
     $conn = new mysqli($servername, $username, $password, $dbname);

    $farm_n="";
    $crop_name="";
    $crop_status="";
    $initial_update="";
    

$sql = "SELECT * FROM farmer_acc2 WHERE farm_n = '$farm_n' ORDER BY crop_name ASC";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $crop_name= $_POST["crop_name"];
    $crop_status= $_POST["crop_status"];
    $initial_update= $_POST["initial_update"];


    if ( empty($crop_name) || empty($crop_status) ||  empty($initial_update)) {
        echo "ALL the fields are required";
    } 
    else {
            $stmt = $conn->prepare("INSERT INTO crop_list (crop_name, crop_status, initial_update) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $crop_name, $crop_status, $initial_update);

            if ($stmt->execute()) {
                header('location:view.php');
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }
$conn->close();
?>
                </tbody>
            </table>
            <div class="container my-5">
        <h2>Add New Crop</h2>


        <form method="POST">
        <div class="row mb-3">
        <input type="hidden" name="farm_n" value="<?php echo htmlspecialchars($farm_n); ?>">
                <label class="col-sm-3 col-form-label">Crop Name</label>
                <div class="select-wrapper">
                <select name="crop_name" class="form-control"  value="<?php echo $crop_name; ?>">
                <option value=""> select crop name </option>
                    <option value="Eggplant"> Eggplant (Talong) </option>
                    <option value="Bitter Gourd"> Bitter Gourd (Ampalaya) </option>
                    <option value="Okra"> Okra </option>
                    <option value="Rice"> Rice (Bigas) </option>
                    <option value="Corn"> Corn (Mais)</option>
                    <option value="String Beans"> String Beans (Sitaw) </option>
                    <option value="Squash"> Squash (Kalabasa)</option>
                    <option value="Sweet Potato"> Sweet Potato (Kamote) </option>
                    <option value="Tomato"> Tomato </option>
                    <option value="Peppers"> Peppers (Sili) </option>
                    <option value="Cabbage"> Cabbage (Repolyo) </option>
                    <option value="Onion"> Onion (Sibuyas) </option>
                    <option value="Garlic">Garlic (bawang) </option>
                    <option value="Grapes"> Grapes (Ubas) </option>
                    <option value="Banana"> Banana (Saging)</option>
                    <option value="Papaya"> Papaya </option>
                    <option value="Strawberry"> Strawberry </option>
                    <option value="Melon"> Melon </option>
                        </select>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crop Status</label>
                <div class="select-wrapper">
                <select name="crop_status" class="form-control"  value="<?php echo $crop_status; ?>">
                <option value=""> select crop status </option>
                    <option value="seedling"> seedling </option>
                    <option value="sprouting"> sprouting </option>
                    <option value="ripening"> ripening </option>
                    <option value="harvesting"> harvesting </option>
                    <option value="withered"> withered </option>
                        </select>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date Recorded</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" name="initial_update" required placeholder="" value="<?php echo $initial_update; ?>">
                </div> 
            </div><br>
            <div class="row mb-3">
            <input type="submit" name="submit" value="Submit" class="btn btn-submit">
                </div>
    </div>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- [existing head elements] -->
    <title>Crops</title>
    <!-- [existing style elements] -->
</head>
<body>
    <div class="main-content">
    <div class="dashboard-box">
        <h2>Farm Crop List</h2><br>

        <table class="table">
    <thead>
        <tr>
            <th>Crop Name</th>
            <th>Crop Status</th>
            <th>Date Recorded</th>
            <th>Latest Update</th>
            
        </tr>  
    </thead> 
    <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "faccount";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM crop_list ORDER BY crop_name ASC";
                
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        
                        echo "
                        <tr>
                            <td>{$row['crop_name']}</td>
                            <td>{$row['crop_status']}</td>
                            <td>{$row['initial_update']}</td>
                            <td>{$row['latest_update']}</td>
                            <td>
                                <div class='btn-container'>
                                    <a class='btn view-btn' href='/AgriConnectN/view.php?ID={$row["ID"]}'>Delete</a><br>
                                    <a class='btn update-btn' href='/AgriConnectN/update_admin.php?ID={$row["ID"]}'>Update</a>
                                </div>
                            </td>
                        </tr>
                        ";
                    }
                    ?>
                
            </tbody>
        </table>

</body>
</html>


