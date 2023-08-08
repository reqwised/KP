<!-- PHP Config -->
<?php
	include 'layout.php';
	include_once("config.php");
	if(isset($_GET['search'])){
		$search = $_GET['search'];
		$result = mysqli_query($mysqli,"SELECT * FROM kapal where Nama_kapal like '%".$search."%' or Call_sign like '%".$search."%'");				
	}
	else {
		$result = mysqli_query($mysqli, "SELECT * FROM kapal");		
	}
?>

<!-- Design HTML -->
<html>
	<!-- Design Head -->
	<head>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<title>DISNAV SMG</title>
	</head>
	<!-- Design Body -->
	<body>
		<div class="container">
			<h4 class="mt-5">DATA KAPAL</h4>
			<div style="display:flex; align-items:flex-start;">
				<form class="input-group mb-3" action="indexKapal.php" method="GET" style="width:300px;">
					<input type="text" name="search" class="form-control" placeholder="Nama Kapal / Call Sign">
					<div class="input-group-append">
						<button style="margin-left:10px;" class="btn btn-outline-secondary" type="submit">Search</button>
						
					</div>
				</form>
				<div style="padding:0px 10px 0px;"></div>
				<a href="addKapal.php" type="button"class="btn btn-success rounded-3" style="width:130px;">Tambah Data</a>
			</div>
			<div class="table-responsive" id="tabel_karyawam">
				<table class="table table-hover mt-2">
					<thead>
						<tr>
							<th><a class="column_sort" id="MMSI" data-order="desc" href="#">MMSI</a></th>
							<th><a class="column_sort" id="Nama_kapal" data-order="desc" href="#">Nama Kapal</a></th>
							<th><a class="column_sort" id="Call_sign" data-order="desc" href="#">Call Sign</a></th>
							<th><a class="column_sort" id="IMO" data-order="desc" href="#">IMO</a></th>
							<th><a class="column_sort" id="Tipe_kapal" data-order="desc" href="#">Tipe Kapal</a></th>
							<th><a class="column_sort" id="Gross_tonnage" data-order="desc" href="#">Gross Tonnage</a></th>
							<th><a class="column_sort" id="Length" data-order="desc" href="#">Length</a></th>
							<th><a class="column_sort" id="Width" data-order="desc" href="#">Beam</a></th>
							<th><a class="column_sort" id="Flag" data-order="desc" href="#">Flag</a></th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php 
							while($kapal = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>".$kapal['MMSI']."</td>";
							echo "<td>".$kapal['Nama_kapal']."</td>";
							echo "<td>".$kapal['Call_sign']."</td>";
							if($kapal['IMO'] == NULL) {echo "<td>-</td>";} else {echo "<td>".$kapal['IMO']."</td>";}
							if($kapal['Tipe_kapal'] == NULL) {
								echo "<td>-</td>";
							} 
							else {
								if($kapal['Tipe_kapal'] != 'CARGO' && $kapal['Tipe_kapal'] != 'PASSENGER' && $kapal['Tipe_kapal'] != 'TANKER' && $kapal['Tipe_kapal'] != 'TUG' && $kapal['Tipe_kapal'] != 'TUG BOAT') {
									$kapal['Tipe_kapal'] = 'OTHER';
								}
								echo "<td>".$kapal['Tipe_kapal']."</td>";
							}
							if($kapal['Gross_tonnage'] == NULL) {echo "<td>-</td>";} else {echo "<td>".$kapal['Gross_tonnage']."</td>";}
							if($kapal['Length'] == NULL) {echo "<td>-</td>";} else {echo "<td>".$kapal['Length']."</td>";}
							if($kapal['Width'] == NULL) {echo "<td>-</td>";} else {echo "<td>".$kapal['Width']."</td>";}
							echo "<td>".$kapal['Flag']."</td>";
							echo "<td>"."<a href='editKapal.php?MMSI=$kapal[MMSI]' type='button' class='btn btn-warning rounded-3'>Ubah</a> <a href='deleteKapal.php?MMSI=$kapal[MMSI]' type='button' class='btn btn-danger' >Hapus</button>"."</td>";
							echo "</tr>";
						} 
						?> 
					</tbody>
				</table>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				$(document).on('click', '.column_sort', function(){
					var nama_kolom = $(this).attr("id");
					var order = $(this).data("order");
					var arrow = '';
					if(order == 'desc'){
						arrow = '&nbsp;<span class="fa fa-arrow-down"></span>';
					} else {
						arrow = '&nbsp;<span class="fa fa-arrow-up"></span>';
					}
					$.ajax({
						url:"sort.php",
						method:"POST",
						data:{nama_kolom:nama_kolom, order:order},
						success:function(data)
						{
							$('#tabel_karyawam').html(data);
							$('#'+nama_kolom+'').append(arrow);
						}
					})
				});
			});
		</script>
	</body>
</html>