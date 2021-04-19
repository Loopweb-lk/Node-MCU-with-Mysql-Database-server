<?php
session_start();
?>

<?php
$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $sensor = $location = $value1 = $value2 = $value3 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $sensor = test_input($_POST["sensor"]);
       
        $_SESSION['data'] = $sensor;
        
        // Create connection
        include 'inc/connection.php';
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO SensorData (sensor)
        VALUES ('" . $sensor . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
              
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        //------------------------------------------------------------------------------------------------------------------------------------
        
        $sql2 = "INSERT INTO loga (Uid)
        VALUES ('" . $sensor . "')";
        
        if ($conn->query($sql2) === TRUE) {
            echo "New record created successfully";
              
        } 
        else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
        
        //----------------------------------------------------------------------------------------------------------------------------------
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}