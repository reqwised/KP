<?php
  include 'config.php';
 
  $output = '';
  $order = $_POST["order"];
  if($order == 'desc'){
      $order = 'asc';
  } else {
    $order = 'desc';
  }
 
  $nama_kolom = $_POST["nama_kolom"];
  $orderby = $_POST["order"];
 
  $query = "SELECT * FROM kapal ORDER BY ". $nama_kolom ." ". $orderby ."";
  $dewan1 = $mysqli->prepare($query);
  $dewan1->execute();
  $res1 = $dewan1->get_result();
//  $res1 = mysqli_query($mysqli, $query);

  $output .= '
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <style>body {font-family: Nunito; font-size: 14px;}</style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <table class="table table-hover mt-2">
      <tr>
           <th><a class="column_sort" id="MMSI" data-order="'.$order.'" href="#">MMSI</a></th>
           <th><a class="column_sort" id="Nama_Kapal" data-order="'.$order.'" href="#">Nama Kapal</a></th>
           <th><a class="column_sort" id="Call_Sign" data-order="'.$order.'" href="#">Call Sign</a></th>
           <th><a class="column_sort" id="IMO" data-order="'.$order.'" href="#">IMO</a></th>
           <th><a class="column_sort" id="Tipe_kapal" data-order="'.$order.'" href="#">Type</a></th>
           <th><a class="column_sort" id="Gross_tonnage" data-order="'.$order.'" href="#">GT</a></th>
           <th><a class="column_sort" id="Length" data-order="'.$order.'" href="#">Length</a></th>
           <th><a class="column_sort" id="Width" data-order="'.$order.'" href="#">Beam</a></th>
           <th><a class="column_sort" id="Flag" data-order="'.$order.'" href="#">Flag</a></th>
           <th>Action</th>
        </tr>
  ';

  /*while($kapal = mysqli_fetch_array($result)) {
    $output .= '
    <tr>
         <td>' . $row["MMSI"] . '</td>
         <td>' . $row["Nama Kapal"] . '</td>
         <td>' . $row["Call Sign"] . '</td>
         <td>' . $row["IMO"] . '</td>
         <td>' . $row["Type"] . '</td>
         <td>' . $row["GT"] . '</td>
         <td>' . $row["Length"] . '</td>
         <td>' . $row["Beam"] . '</td>
         <td>' . $row["Flag"] . '</td>
    </tr>
    ';
  }*/
  while ($kapal = $res1->fetch_assoc()) {
      $output .= '
      <tr>
           <td>' . $kapal["MMSI"] . '</td>
           <td>' . $kapal["Nama_kapal"] . '</td>
           <td>' . $kapal["Call_sign"] . '</td>
           <td>' . $kapal["IMO"] . '</td>
           <td>' . $kapal["Tipe_kapal"] . '</td>
           <td>' . $kapal["Gross_tonnage"] . '</td>
           <td>' . $kapal["Length"] . '</td>
           <td>' . $kapal["Width"] . '</td>
           <td>' . $kapal["Flag"] . '</td>
           <td><a href="editKapal.php?MMSI='.$kapal["MMSI"].'" type="button" class="btn btn-warning rounded-3">Ubah</a> <a href="deleteKapal.php?MMSI='.$kapal["MMSI"].'" type="button" class="btn btn-danger">Hapus</button></td>
      </tr>
      ';  
  }
  $output .= '</table>';
  echo $output;
?>