<?php
include 'konekDB.php';

// php koneksi DB
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui form
    $id = $_POST['id'];
    $operator = $_POST['operator'];
    $server = $_POST['server'];
    $user_ssh = $_POST['user_ssh'];
    $pathlog = $_POST['pathlog'];
    $logfile = $_POST['logfile'];
    $status_err = $_POST['status_err'];
    $service = $_POST['service'];
    $vendor = $_POST['vendor'];
    $url = $_POST['url'];
    $port = $_POST['port'];
    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $upass = $_POST['upass'];
    $is_active = $_POST['is_active'];

    // Update data ke dalam tabel
    $queryUpdate = "UPDATE config_status_telco_new SET 
                    operator = '$operator', 
                    server = '$server', 
                    user_ssh = '$user_ssh', 
                    pathlog = '$pathlog', 
                    logfile = '$logfile', 
                    status_err = '$status_err', 
                    service = '$service', 
                    vendor = '$vendor', 
                    url = '$url', 
                    port = '$port', 
                    fname = '$fname', 
                    uname = '$uname', 
                    upass = '$upass', 
                    is_active = '$is_active' 
                    WHERE id = $id";

    if ($conn->query($queryUpdate) === TRUE) {
        echo "Data berhasil di-update.";
    } else {
        echo "Error: " . $queryUpdate . "<br>" . $conn->error;
    }

    echo '<br><a href="index.php">kembali ke Home</a>';
}

$conn->close();
