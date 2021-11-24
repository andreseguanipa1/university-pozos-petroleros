<?php
include_once('../config/cnx/conexion.php');
session_start();

if(isset($_SESSION['id'])){
    $ID = $_SESSION['id'];
    $QUERY = "Select * from usuarios Where id='$ID'";
    $rsQUERY = mysqli_query($con, $QUERY) or die('Error: ' . mysqli_error($con));
    $countQUERY = mysqli_num_rows($rsQUERY);

    if($countQUERY<=0){
        header('Location: index.html');
    }

}else{
    header('Location: index.html');
}

if(isset($_POST['nuevo'])){

    if($_POST['nuevo'] == 'Registrar'){

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefonoHab = $_POST['telefonoHab'];
        $telefonoMovil = $_POST['telefonoMovil'];
        $correo = $_POST['correo'];
        $password = md5($_POST['password']);
        $dir_subida = '../photos/';
        $fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
        $foto = basename($_FILES['fichero_usuario']['name']);

        if(move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {

            echo "El fichero es válido y se subió con éxito.\n";

            $QUERYInt = "Insert Into usuarios (nombre, apellido, direccion, telefonoHab, telefonoMovil,
            correo, password, foto)";

             $QUERYInt .= "values ('$nombre', '$apellido', '$direccion', '$telefonoHab', '$telefonoMovil',
            '$correo', '$password', '$foto')";

            $rsQUERYInt = mysqli_query($con, $QUERYInt) or die('Error: ' . mysqli_error($con));

            if($rsQUERYInt == true){
                header('Location: ../usuarios.php');
            }

            if($rsQUERYInt == false){
                echo 'Error no se pudo registrar el usuario';
            }

        } else {
            echo "¡Posible ataque de subida de ficheros!\n";
        }
    }
}

if(isset($_POST['modificar'])){

    if($_POST['modificar'] == 'GUARDAR'){

        $usuarioID = $_POST['usuarioID'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefonoHab = $_POST['telefonoHab'];
        $telefonoMovil = $_POST['telefonoMovil'];
        $correo = $_POST['correo'];
        $query = "Select * from usuarios Where usuarioID='$usuarioID'";
        $rsquery = mysqli_query($con, $query) or die('Error: ' . mysqli_error($con));
        $filequery = mysqli_fetch_array($rsquery);

        if($filequery['password'] === md5($_POST['password'])){
            $password = $filequery['password'];
        }else{
            $password = md5($_POST['password']);
        }

        $fotoActual = $filequery['foto'];
        $dir_subida = '../fotos/';
        $fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
        $foto = basename($_FILES['fichero_usuario']['name']);

        if($fotoActual != $foto){

            if(move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
                echo "El fichero es válido y se subió con éxito.\n";
            }
        }else{
            $foto = $filequery['foto'];
        }

        $QUERYmod = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido',
        direccion='$direccion', telefonoHab='$telefonoHab', telefonoMovil='$telefonoMovil', correo='$correo',
        password='$password', foto='$foto' ";

        $QUERYmod .= "WHERE usuarioID='$usuarioID'";

        $rsQUERYmod = mysqli_query($con, $QUERYmod) or die('Error: ' . mysqli_error($con));

        if($rsQUERYmod == true){
            header('Location: ../usuarios.php');
        }

        if($rsQUERYmod == false){
            echo 'Error no se pudo Actualizar el usuario';
        }
    }
}

if(isset($_GET['borrar'])){

    if($_GET['borrar'] == 'si'){
        $usuarioID = $_GET['ID'];

        $QUERYmod = "DELETE from usuarios WHERE usuarioID='$usuarioID'";
 //echo $QUERYmod;
        $rsQUERYmod = mysqli_query($con, $QUERYmod) or die('Error: ' . mysqli_error($con));

        if($rsQUERYmod == true){
            header('Location: ../usuarios.php');
        }

        if($rsQUERYmod == false){
            echo 'Error no se pudo Eliminar el usuario';
        }

    }
}

mysqli_close($con);
?>