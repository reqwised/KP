<?php 
    include 'layout.php';
    include_once 'config.php';
    $old_MMSI_get = $_GET['MMSI'];
    $data = mysqli_query($mysqli, "SELECT * FROM kapal WHERE `kapal`.`MMSI` = $old_MMSI_get");
    while($data2 = mysqli_fetch_array($data)) {
        $old_MMSI_get = $data2['MMSI'];
        $Nama_kapal_get = $data2['Nama_kapal'];
        $Call_sign_get = $data2['Call_sign'];
        $IMO_get = $data2['IMO'];
        $Tipe_kapal_get = $data2['Tipe_kapal'];
        $Gross_tonnage_get = $data2['Gross_tonnage'];
        $Length_get = $data2['Length'];
        $Width_get = $data2['Width'];
        $Flag_get = $data2['Flag'];
    }
?>

<?php
    if(isset($_POST['Submit'])) {
        $old_MMSI_post = $_POST['old_MMSI'];
        $MMSI_post = $_POST['MMSI'];
        $Nama_kapal_post = $_POST['Nama_kapal'];
        $Call_sign_post = $_POST['Call_sign'];
        (empty($_POST['IMO'])) ? $IMO_post = 'NULL' : $IMO_post = $_POST['IMO'];
        $Tipe_kapal_post = $_POST['Tipe_kapal'];
        (empty($_POST['Gross_tonnage'])) ? $Gross_tonnage_post = 'NULL' : $Gross_tonnage_post = $_POST['Gross_tonnage'];
        (empty($_POST['Length'])) ? $Length_post = 'NULL' : $Length_post = $_POST['Length'];
        (empty($_POST['Width'])) ? $Width_post = 'NULL' : $Width_post = $_POST['Width'];
        $Flag_post = $_POST['Flag'];
        $result_post = mysqli_query($mysqli, "update `kapal` set `MMSI` = $MMSI_post, `Nama_kapal` = '$Nama_kapal_post', `Call_sign` = '$Call_sign_post', `IMO` = $IMO_post, `Tipe_kapal` = '$Tipe_kapal_post', `Gross_tonnage` = $Gross_tonnage_post, `Length` = $Length_post, `Width` = $Width_post, `Flag` = '$Flag_post' where `kapal`.`MMSI` = $old_MMSI_post");
        header("Location: indexKapal.php");
    }
?>

<html>
    <head>
        <title>Edit Data Kapal</title>
    </head>
    
    <body>
        <div class="container">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title fw-bolder mb-3">Edit Data Kapal</h5>
                    <form action="editKapal.php" method="post" name="update_kapal">
                        <div class="mb-3"> <!-- NEED ERROR HANDLING -->
                            <label for="MMSI" class="form-label">MMSI</label>
                            <div class="col-md-3">
                                <input id="MMSI" name="MMSI" type="number" class="form-control" value=<?php echo $old_MMSI_get; ?> 
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                required maxlength="9">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Nama_kapal" class="form-label">Nama Kapal</label>
                            <input type="text" class="form-control"id="Nama_kapal" name="Nama_kapal" style="width:320px" required value="<?php echo $Nama_kapal_get; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="Call_sign" class="form-label">Call Sign</label>
                            <input type="text" class="form-control"id="Call_sign" name="Call_sign" style="width:320px" required value=<?php echo $Call_sign_get?>>
                        </div>
                
                        <div class="mb-3">
                            <label for="IMO" class="form-label">IMO</label>
                            <input type="number" class="form-control"id="IMO" name="IMO" style="width:320px" nullable value=<?php echo $IMO_get ?>>
                        </div>

                        <div class="mb-3">
                            <label for="Tipe_kapal" class="form-label">Tipe Kapal</label>
                            <select name='Tipe_kapal'>
                            <?php
                                        $result = mysqli_query($mysqli, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'kapal' AND COLUMN_NAME = 'Tipe_kapal'");
                                        $row = mysqli_fetch_array($result);
                                        $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
                                        foreach($enumList as $value)
                                        echo "<option value=\"$value\">$value</option>";
                            ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Gross_tonnage" class="form-label">GT</label>
                            <input type="number" step="0.001" class="form-control"id="Gross_tonnage" name="Gross_tonnage" style="width:320px" nullable value=<?php echo $Gross_tonnage_get ?>>
                        </div>

                        <div class="mb-3">
                            <label for="Length" class="form-label">Length</label>
                            <input type="number" step="0.1" class="form-control"id="Length" name="Length" style="width:320px" nullable value=<?php echo $Length_get?>>
                        </div>

                        <div class="mb-3">
                            <label for="Width" class="form-label">Beam</label>
                            <input type="number" step="0.1" class="form-control"id="Width" name="Width" style="width:320px" nullable value=<?php echo $Width_get?>>
                        </div>

                        <div class="mb-3">
                            <label for="Flag" class="form-label">Flag</label>
                            <select name='Flag' value=<?php echo $Flag_get?>>
                            <?php
                                        $result = mysqli_query($mysqli, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'kapal' AND COLUMN_NAME = 'Flag'");
                                        $row = mysqli_fetch_array($result);
                                        $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
                                        foreach($enumList as $value)
                                        echo "<option value=\"$value\">$value</option>";
                            ?>
                            </select>
                        </div>
                
                        <div class="text-center">
                            <input type="hidden" readonly name="old_MMSI" value=<?php echo $old_MMSI_get;?>>
                            <input type="submit" name="Submit" class="btn btn-primary" value="Update" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>