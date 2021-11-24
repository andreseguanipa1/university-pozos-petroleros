<?php
include_once('cnx/conexion.php');
session_start();

if(isset($_SESSION['id'])){

    $ID = $_SESSION['id'];
    $QUERY = "SELECT * FROM usuarios WHERE id='$ID'";
    $rsQUERY = mysqli_query($con, $QUERY) or die('Error: ' . mysqli_error($con));
    $countQUERY = mysqli_num_rows($rsQUERY);

    if($countQUERY <= 0){
        header('Location: index.php');
    }

}else{

    header('Location: index.php');

}