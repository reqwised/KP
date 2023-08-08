<?php
    include_once("config.php");
    $MMSI = $_GET['MMSI'];
    $result = mysqli_query($mysqli, "DELETE FROM kapal WHERE `kapal`.`MMSI` = $MMSI");
    header("Location:indexKapal.php");
?>