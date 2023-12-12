<?php
include 'konekDB.php';

// php koneksi DB
$conn = new mysqli($servername, $username, $password, $dbname);


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

    <h2 style="text-align: center;">Input Form</h2>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <div class="container-fluid">
                    <form method="post" action="proses_input.php">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="operator">Operator:</label>
                                <select id="operator" class="form-control" name="operator">
                                    <option value="">Pilih . . .</option>
                                    <option value="Telkomsel">Telkomsel</option>
                                    <option value="Excelcom">Excelcom</option>
                                    <option value="Indosat">Indosat</option>
                                    <option value="Hutchinson">Hutchinson</option>
                                    <option value="Smartfren">Smartfren</option>
                                    <option value="International">International</option>
                                    <option value="WhatsApp">WhatsApp</option>
                                    <option value="Email">Email</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="server">Server:</label>
                                <input type="text" class="form-control" id="server" name="server" placeholder="IP Server" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="user_ssh">User SSH:</label>
                                <input type="text" class="form-control" id="user_ssh" name="user_ssh" placeholder="SSH Username" value="">
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="pathlog">Path Log:</label>
                                <input type="text" class="form-control" id="pathlog" name="pathlog" placeholder="/path/to/folder" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="logfile">Log File:</label>
                                <input type="text" class="form-control" id="logfile" name="logfile" placeholder="logfile.log" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status_err">Status Error:</label>
                                <input type="text" class="form-control" id="status_err" name="status_err" placeholder="RESP: Error/Connection" value="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="service">Services:</label>
                                <select id="service" class="form-control" name="service">
                                    <option value="">Pilih. . .</option>
                                    <option value="Bulk">Bulk</option>
                                    <option value="Bulk Reguler">Bulk Reguler</option>
                                    <option value="Bulk Premium">Bulk Premium</option>
                                    <option value="Banking">Banking</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="vendor">Vendor:</label>
                                <select id="vendor" class="form-control" name="vendor">
                                    <?php
                                    // Tampilkan dropdown untuk "vendor"
                                    if ($resultVendor->num_rows > 0) {
                                        while ($rowVendor = $resultVendor->fetch_assoc()) {
                                            echo '<option value="' . $rowVendor["vendor_name"] . '">' . $rowVendor["vendor_name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="url">URL:</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="send_ip_no" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="port">Port:</label>
                                <input type="text" class="form-control" id="port" name="port" placeholder="send_port" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fname">Fname:</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="filename" value="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="uname">Username:</label>
                                <input type="text" class="form-control" id="uname" name="uname" placeholder="send_username" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="upass">Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="upass" name="upass" placeholder="send_password" value="">
                                    <span class="toggle-password" onclick="togglePasswordVisibility('upass')">👁️</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="is_active">is Active:</label>
                                <select id="is_active" class="form-control" name="is_active" required>
                                    <option value="0">Default InActive</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Non-Aktif</option>
                                </select>
                            </div>
                        </div>

                        <input class="btn btn-primary" type="reset" onclick="history.back()" value="Kembali">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
<script>
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    }
</script>


</html>