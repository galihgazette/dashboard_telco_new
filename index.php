<?php
include 'konekDB.php';

// php koneksi DB
$conn = new mysqli($servername, $username, $password, $dbname);

$query = "SELECT * FROM `config_status_telco_new` ORDER by id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Dashboard</title>
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
			padding: 2px;
			text-align: left;
		}

		th {
			background-color: #f2f2f2;
		}

		tr {
			font-size: smaller;
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

		#searchInput {
			float: right;
			margin-top: 10px;
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 4px;
		}

		.delete-icon {
			color: red;
		}

		.edit-icon {
			color: green;
		}

		.view-icon {
			color: blue;
		}
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>

<body>

	<h2>Dashboard</h2>

	<input type="text" id="searchInput" placeholder="Cari...">

	<button id="openFormButton">New Data</button>

	<div class="container-fluid">
		<table id="dataTable">
			<thead>
				<tr>
					<th>No.</th>
					<th>Operator</th>
					<th>Server</th>
					<th>Service</th>
					<th>Vendor</th>
					<th>URL</th>
					<th>Port</th>
					<th>File name</th>
					<th>Status Error</th>
					<th>is Active</th>
					<th>Time log</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//data dalam tabel
				if ($result->num_rows > 0) {

					$counter = 1;

					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						//echo "<td>" . $row["id"] . "</td>";
						echo "<td>" . $counter . "</td>";
						echo "<td>" . $row["operator"] . "</td>";
						echo "<td>" . $row["server"] . "</td>";
						echo "<td>" . $row["service"] . "</td>";
						echo "<td>" . $row["vendor"] . "</td>";
						echo "<td>" . $row["url"] . "</td>";
						echo "<td>" . $row["port"] . "</td>";
						echo "<td>" . $row["fname"] . "</td>";
						echo "<td>" . $row["status_err"] . "</td>";
						echo "<td>" . $row["is_active"] . "</td>";
						echo "<td>" . $row["time_log"] . "</td>";

						echo '<td>
                        <a class="btn btn-primary ml-1" href="view.php?id=' . $row["id"] . '"><i
                                class="fa fa-eye edit-icon"></i>View</a>
                        <!--id data diambil dari id yang ada di dalam table-->
                        <a class="btn btn-warning ml-1" href="update.php?id=' . $row["id"] . '"><i
                                class="fa fa-pencil edit-icon"></i>Edit</a>
                        <a class="btn btn-danger ml-1" href="delete.php?id=' . $row["id"] . '"><i
                                class="fa fa-trash edit-icon"></i>Delete</a>
                    </td>';
						echo "</tr>";

						$counter++;
					}
				} else {
					echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
				}
				?>
			</tbody>
		</table>
	</div>

	<!-- fungsi button -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

	<script>
		document.getElementById('openFormButton').addEventListener('click', function() {
			window.location.href = 'form_input.php';
		});
	</script>


	<!-- fungsi search -->

	<script>
		document.getElementById('searchInput').addEventListener('input', function() {
			var filter = this.value.toUpperCase();
			var table = document.getElementById('dataTable');
			var rows = table.getElementsByTagName('tr');

			for (var i = 1; i < rows.length; i++) {
				var cells = rows[i].getElementsByTagName('td');
				var found = false;

				for (var j = 0; j < cells.length; j++) {
					var cellText = cells[j].innerText.toUpperCase() || cells[j].textContent.toUpperCase();

					if (cellText.indexOf(filter) > -1) {
						found = true;
						break;
					}
				}

				if (found) {
					rows[i].style.display = '';
				} else {
					rows[i].style.display = 'none';
				}
			}
		});
	</script>



</body>

</html>