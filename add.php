<?php include 'layout.php';
    include 'config.php';?>

<?php
   echo '<script>console.log(href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css")</script>';
?>

<html>
    <head>
        <title>ADD LOGBOOK</title>
    </head>
    
    <body>
        <div class="container">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title fw-bolder mb-3">Tambah Data Logbook</h5>
                    <form action="add.php" method="post" name="form1">
                        <div style="display:flex; align-items:flex-start;">
                            <div class="mb-3"> <!-- NEED ERROR HANDLING -->
                                <label for="MMSI" class="form-label">MMSI</label>
                                <div class="col-md-3">
                                    <input id="MMSI" name="MMSI" type="number" style="width:320px;" list="list_MMSI" class="form-control" onkeyup="GetDetail(this.value)" required>
                                    <datalist id="list_MMSI">
                                        <?php $result = mysqli_query($mysqli, "SELECT * FROM kapal");
                                        while($MMSI = mysqli_fetch_array($result)){
                                            echo "<option>".$MMSI['MMSI']."</option>";
                                        }?>
                                    </datalist>
                                </div>
                            </div>

                            <div style="padding:0px 20px 0px;"></div>

                            <div class="mb-3">
                                <label for="Nama_kapal" class="form-label">Nama Kapal</label>
                                <input type="text" readonly class="form-control" id="Nama_kapal" disabled="disabled" style="width:320px ; height:30px" name="Nama_kapal" required>
                            </div>
                        </div>

                        <div style="display:flex; align-items:flex-start;">
                            <div class="mb-3">
                                <label for="Last_port" class="form-label">Last Port</label>
                                <input type="text" class="form-control" id="Last_port" name="Last_port" style="width:320px" required>
                            </div> 
                            
                            <div style="padding:0px 20px 0px;"></div>

                            <div class="mb-3">
                                <label for="Next_port" class="form-label">Next Port</label>
                                <input type="text" class="form-control" id="Next_port" name="Next_port" style="width:320px" required>
                            </div> 
                        </div>

                        <div style="display:flex; align-items:flex-start;">
                            <div class="mb-3">
                                <label for="ETD" class="form-label">ETD</label>
                                <input type="datetime-local" class="form-control" id="ETD" name="ETD" style="width:320px;" required>
                            </div>

                            <div style="padding:0px 20px 0px;"></div>
                    
                            <div class="mb-3">
                                <label for="ETA" class="form-label">ETA</label>
                                <input type="datetime-local" class="form-control" id="ETA" name="ETA" style="width:320px;" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Draught" class="form-label">Draught</label>
                            <input type="number" step="0.1" class="form-control" id="Draught" name="Draught"  style="width:190px" required>
                        </div>
                
                        <div class="text-center">
                            <input type="submit" name="Submit" class="btn btn-primary" value="Tambah" />
                        </div>
                    </form>
            
                    <?php
                        if(isset($_POST['Submit'])) {
                            (strlen((string)$_POST['MMSI']) != 9) ? $MMSI = NULL : $MMSI = $_POST['MMSI'];
                            $MMSI = $_POST['MMSI'];
                            $Last_port = $_POST['Last_port'];
                            $Next_port = $_POST['Next_port'];
                            $ETD = $_POST['ETD'];
                            $ETA = $_POST['ETA'];
                            $Draught = $_POST['Draught'];
                            include_once("config.php");
                            $result = mysqli_query($mysqli, "INSERT INTO traffic (MMSI, Last_port, Next_port, ETD, ETA, Draught) VALUES($MMSI,'$Last_port', '$Next_port', '$ETD', '$ETA', $Draught)");
                            if ($MMSI == NULL) {echo "<h6>DATA GAGAL DITAMBAH</h6>";} else {echo "DATA BERHASIL DITAMBAH. <a href='index.php'>Back to Home</a>"; }
                        }    
                    ?>
                </div>
            </div>
        </div>

        <script>
  
        // onkeyup event will occur when the user 
        // release the key and calls the function
        // assigned to this event
        function GetDetail(str) {
            if (str.length != 9) {
                document.getElementById("Nama_kapal").value = "";
                return;
            }
            else {
  
                // Creates a new XMLHttpRequest object
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
  
                    // Defines a function to be called when
                    // the readyState property changes
                    if (this.readyState == 4 && 
                            this.status == 200) {
                          
                        // Typical action to be performed
                        // when the document is ready
                        var myObj = JSON.parse(this.responseText);
  
                        // Returns the response data as a
                        // string and store this array in
                        // a variable assign the value 
                        // received to first name input field
                          
                        document.getElementById
                            ("Nama_kapal").value = myObj[0];
                    }
                };
  
                // xhttp.open("GET", "filename", true);
                xmlhttp.open("GET", "controller.php?MMSI=" + str, true);
                  
                // Sends the request to the server
                xmlhttp.send();
            }
        }
    </script>
    </body>
</html>
