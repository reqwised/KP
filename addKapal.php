<?php
    include 'layout.php';
    include 'config.php';
?>

<html>
    <head>
        <title>TAMBAH DATA KAPAL</title>
    </head>
    
    <body>
        <div class="container">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title fw-bolder mb-3">Tambah Data Kapal</h5>
                    <form action="addKapal.php" method="post" name="form1">
                        <div style="display:flex; align-items:flex-start;">
                            <div class="mb-3"> <!-- NEED ERROR HANDLING -->
                                <label for="MMSI" class="form-label">MMSI</label>
                                <div class="col-md-3">
                                    <input id="MMSI" name="MMSI" style="width:320px" 
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    type="number" class="form-control" required  maxlength="9">
                                </div>
                            </div>

                            <div style="padding:0px 20px 0px;"></div>

                            <div class="mb-3">
                                <label for="IMO" class="form-label">IMO</label>
                                <input type="number" class="form-control"id="IMO" name="IMO" style="width:320px" nullable>
                            </div>
                        </div>

                        <div style="display:flex; align-items:flex-start;">
                            <div class="mb-3">
                                <label for="Nama_kapal" class="form-label">Nama Kapal</label>
                                <input type="text" class="form-control"id="Nama_kapal" name="Nama_kapal" style="width:320px" required>
                            </div>

                            <div style="padding:0px 20px 0px;"></div>

                            <div class="mb-3">
                                <label for="Call_sign" class="form-label">Call Sign</label>
                                <input type="text" class="form-control"id="Call_sign" name="Call_sign" style="width:320px" required>
                            </div>
                        </div>

                        <div style="display:flex; align-items:flex-start;">
                            <div class="mb-3">
                                <label for="Gross_tonnage" class="form-label">GT</label>
                                <input type="number" step="0.001" class="form-control"id="Gross_tonnage" name="Gross_tonnage" style="width:320px" nullable>
                            </div>

                            <div style="padding:0px 20px 0px;"></div>

                            <div class="mb-3">
                                <label for="Length" class="form-label">Length</label>
                                <input type="number" step="0.1" class="form-control"id="Length" name="Length" style="width:320px" nullable>
                            </div>

                            <div style="padding:0px 20px 0px;"></div>

                            <div class="mb-3">
                                <label for="Width" class="form-label">Beam</label>
                                <input type="number" step="0.1" class="form-control"id="Width" name="Width" style="width:320px" nullable>
                            </div>
                        </div>

                        <div style="display:flex; align-items:flex-start;">
                            <div class="mb-3">
                                <label for="Tipe_kapal" class="form-label">Tipe Kapal</label>
                                <?php
                                            $table_name = "kapal";
                                            $column_name = "Tipe_kapal";
                                            echo "<select name=\"$column_name\">";
                                            $result = mysqli_query($mysqli, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'");
                                            $row = mysqli_fetch_array($result);
                                            $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
                                            foreach($enumList as $value)
                                            echo "<option value=\"$value\">$value</option>";
                                            echo "</select>";  
                                ?>
                            </div>

                            <div style="padding:0px 20px 0px;"></div>

                            <div class="mb-3">
                                <label for="Flag" class="form-label">Flag</label>
                                <?php
                                            $table_name = "kapal";
                                            $column_name = "Flag";
                                            echo "<select name=\"$column_name\">";
                                            $result = mysqli_query($mysqli, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'");
                                            $row = mysqli_fetch_array($result);
                                            $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
                                            foreach($enumList as $value)
                                            echo "<option value=\"$value\">$value</option>";
                                            echo "</select>"; 
                                ?>
                            </div>
                        </div>
                
                        <div class="text-center">
                            <input type="submit" name="Submit" class="btn btn-primary" value="Tambah" />
                        </div>
                    </form>
            
                    <?php
                        if(isset($_POST['Submit'])) {
                            (strlen((string)$_POST['MMSI']) != 9) ? $MMSI = NULL : $MMSI = $_POST['MMSI'];
                            $Nama_kapal = $_POST['Nama_kapal'];
                            $Call_sign = $_POST['Call_sign'];
                            (empty($_POST['IMO'])) ? $IMO = 'NULL' : $IMO = $_POST['IMO'];
                            $Tipe_kapal = $_POST['Tipe_kapal'];
                            (empty($_POST['Gross_tonnage'])) ? $Gross_tonnage = 'NULL' : $Gross_tonnage = $_POST['Gross_tonnage'];
                            (empty($_POST['Length'])) ? $Length = 'NULL' : $Length = $_POST['Length'];
                            (empty($_POST['Width'])) ? $Width = 'NULL' : $Width = $_POST['Width'];
                            $Flag = $_POST['Flag'];
                            include_once("config.php");
                            $result = mysqli_query($mysqli, "INSERT INTO kapal (`MMSI`, `Nama_kapal`, `Call_sign`, `IMO`, `Tipe_kapal`, `Gross_tonnage`, `Length`, `Width`, `Flag`) VALUES($MMSI,'$Nama_kapal','$Call_sign', $IMO, '$Tipe_kapal', $Gross_tonnage, $Length, $Width, '$Flag')");
                            if ($MMSI == NULL) {echo "<h6>DATA GAGAL DITAMBAH</h6>";} else {echo "DATA BERHASIL DITAMBAH. <a href='indexKapal.php'>Back to Home</a>"; }
                        }    
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>