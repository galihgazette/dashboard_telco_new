<?php
include 'konekDB.php';

// php koneksi DB
$conn = new mysqli($servername, $username, $password, $dbname);

// Ambil ID dari URL
$id = $_GET['id'];

// Validasi ID
if (!is_numeric($id)) {
    die("ID tidak valid");
}

// Query SQL untuk mendapatkan data yang akan diupdate
$query = "SELECT * FROM config_status_telco_new WHERE ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

// Eksekusi query
$stmt->execute();

// Ambil hasil query
$result = $stmt->get_result();

// Cek apakah data ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Data tidak ditemukan");
}

// Tutup statement
$stmt->close();

// Ambil data dari tabel g_vendor untuk dropdown "vendor"
$queryVendor = "SELECT * FROM g_vendor";
$resultVendor = $conn->query($queryVendor);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            margin-top: 10px;
            margin-right: 10px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }


        form .input-group {
            position: relative;
            width: 100%;
        }


        form .toggle-password {
            position: relative;
            top: 0;
            right: 0;
            transform: translateY(0%);
            cursor: pointer;
            padding: 5px;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">


</head>

<body>
    <h2 style="text-align: center;">Update Form</h2>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <div class="container-fluid">
                    <form method="post" action="proses_update.php">
                        <!-- Tambahkan form untuk input data yang akan di-update -->
                        <input type="hidden" name="id" value="<?php echo $rowData['id']; ?>">

                        <!-- Tampilkan data yang akan di-update di dalam form -->
                        <div class="form-row">
                            <!-- Tambahkan input fields sesuai dengan kolom tabel -->
                            <div class="form-group col-md-4">
                                <label for="operator">Operator:</label>
                                <select id="operator" class="form-control" name="operator">
                                    <!-- Pilihan operator -->
                                </select>
                            </div>
                            <!-- Tambahkan input fields lainnya sesuai kebutuhan -->
                        </div>
                        <!-- Tombol untuk submit form -->
                        <input class="btn btn-primary" type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Script dan library disini -->

</html>