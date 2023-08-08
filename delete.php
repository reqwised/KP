<?php
    include_once("config.php");
    $id = $_GET['Traffic_ID'];
    $result = mysqli_query($mysqli, "DELETE FROM traffic WHERE `traffic`.`Traffic_ID` = $id");
    header("Location:index.php");
?>