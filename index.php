<!-- PHP Config -->
<?php
	include 'layout.php';
	include_once("config.php");
	if(isset($_GET['search'])){
		$search = $_GET['search'];
		$result = mysqli_query($mysqli,"SELECT k.MMSI, k.Nama_kapal, k.Call_sign, k.IMO, k.Length, k.Width, t.Last_port, t.Next_port, t.ETD, t.ETA, t.Draught, t.Traffic_ID FROM kapal k inner join traffic t on k.MMSI=t.MMSI where k.Nama_kapal like '%".$search."%' or k.Call_sign like '%".$search."%' order by k.MMSI ASC");				
	}else{
		$result = mysqli_query($mysqli, "SELECT k.MMSI, k.Nama_kapal, k.Call_sign, k.IMO, k.Length, k.Width, t.Last_port, t.Next_port, t.ETD, t.ETA, t.Draught, t.Traffic_ID FROM kapal k inner join traffic t on k.MMSI=t.MMSI order by k.MMSI ASC");		
	}
	//$result = mysqli_query($mysqli, "SELECT k.MMSI, k.Nama_kapal, k.Call_sign, k.IMO, k.Length, k.Width, t.Last_port, t.Next_port, t.ETD, t.ETA, t.Draught, t.Traffic_ID FROM kapal k inner join traffic t on k.MMSI=t.MMSI order by k.MMSI ASC");
?>

<!-- Design HTML -->
<html>
	<link rel="stylesheet" href="button.css">
	<!-- Design Head -->
	<head>
		<title>DISNAV SMG</title>
	</head>
	<!-- Design Body -->
	<body>
		<div class="container">
			<h4 class="mt-5">LOGBOOK PELAYARAN</h4>
			<div style="display:flex; align-items:flex-start;">
				<form class="input-group mb-3" action="index.php" method="GET" style="width:300px;">
					<input type="text" name="search" class="form-control" placeholder="Nama Kapal / Call Sign">
					<div class="input-group-append">
						<button style="margin-left:10px;" class="btn btn-outline-secondary" type="submit">Search</button>
					</div>
				</form>
				<div style="padding:0px 10px 0px;"></div>
				<a href="add.php" type="button" class="btn btn-success rounded-3" style="width:130px;">Tambah Data</a>
				<div style="padding:0px 10px 0px;"></div>
				<button type="button" class="btn btn-export" data-bs-toggle="modal" data-bs-target="#exportModal" style="width:130px;">Export</button>
				<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="hapusModalLabel">Export Logbook</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
							</div>
							<form method="POST" action="export.php">
								<div class="modal-body">Masukkan range tanggal input data yang ingin di-export</div>
								<div class="mb-3" style="padding-left:20px;">
									<label for="first_date" class="form-label">Tanggal Awal</label>
                            		<input type="date" class="form-control" id="first_date" name="first_date" style="width:320px" required>
								</div>
								<div class="mb-3" style="padding-left:20px;">
									<label for="last_date" class="form-label">Tanggal Akhir</label>
                            		<input type="date" class="form-control" id="last_date" name="last_date" style="width:320px" required>
								</div>
								<div class="modal-footer">
									<button type="submit" name="submit_date_range" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!--<a href="export.php" type="button" class="btn btn-export" style="width:130px;">Export</a> -->
			</div>
			<table class="table table-hover mt-2">
    			<thead>
					<tr>
						<th>MMSI</th>
						<th>Nama Kapal</th>
						<th>Call Sign</th>
						<th>IMO</th>
						<th>Length</th>
						<th>Beam</th>
						<th>Last Port</th>
						<th>Next Port</th>
						<th>ETD</th>
						<th>ETA</th>
						<th>Draught</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
						while($traffic = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>".$traffic['MMSI']."</td>";
							echo "<td>".$traffic['Nama_kapal']."</td>";
							echo "<td>".$traffic['Call_sign']."</td>";
							if($traffic['IMO'] == NULL) {echo "<td>-</td>";} else {echo "<td>".$traffic['IMO']."</td>";}
							echo "<td>".$traffic['Length']."</td>";
							echo "<td>".$traffic['Width']."</td>";
							echo "<td>".$traffic['Last_port']."</td>";
							echo "<td>".$traffic['Next_port']."</td>";
							echo "<td>".$traffic['ETD']."</td>";
							echo "<td>".$traffic['ETA']."</td>";
							echo "<td>".$traffic['Draught']."</td>";
							echo "<td>"."<a href='edit.php?Traffic_ID=$traffic[Traffic_ID]' type='button' class='btn btn-warning rounded-3'>Ubah</a> <a href='delete.php?Traffic_ID=$traffic[Traffic_ID]' type='button' class='btn btn-danger' >Hapus</button>"."</td>";
							echo "</tr>";
						} 
					?> 
				</tbody>
			</table>
		</div>
	</body>
</html>