<?php 

include("../../bd.php");

if(isset($_GET['txtid'])){

    //Recuperamos los datos del ID seleccionado
    $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";

    //Borrando la imagen relacionada al ID del registro a eliminar
    $sentencia= $conexion->prepare("SELECT imagen FROM tbl_portafolio WHERE id=:id");
    $sentencia->bindParam(":id",$txtid);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registro_imagen["imagen"])){
            if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
                unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);
            }
        }

     //Borrado del registro
    $sentencia= $conexion->prepare("DELETE FROM tbl_portafolio WHERE id=:id");
    $sentencia->bindParam(":id",$txtid);
    $sentencia->execute();
    
}

    //SELECCIONAR REGISTROS
$sentencia= $conexion->prepare("SELECT * FROM `tbl_portafolio`"); 
$sentencia->execute();
$lista_portafolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);



include("../../templates/header.php");
?> 

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
        
    <div class="table-responsive-sm">
        <table class="table table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Titulo y Subitulo</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Url</th>
                    <th scope="col">Acciones</th>

                </tr>
            </thead>
            <tbody>
                
                <?php foreach($lista_portafolio as $registros){?>
                    <tr class="">
                    <td scope="col"><?php echo $registros['id'];?></td>
                    <td scope="col">
                        <?php echo $registros['titulo'];?>
                        <br/>
                        <?php echo $registros['subtitulo'];?></td>
                    <td scope="col">
                        <img width="70" src="../../../assets/img/portfolio/<?php echo $registros['imagen'];?>"/>
                    </td>
                    <td scope="col"><?php echo $registros['descripcion'];?></td>
                    <td scope="col"><?php echo $registros['cliente'];?></td>
                    <td scope="col"><?php echo $registros['categoria'];?></td>
                    <td scope="col"><?php echo $registros['url'];?></td>
                    <td scope="col">

                        <a name="" id="" class="btn btn-info" href="editar.php?txtid=<?php echo $registros['id']; ?> " role="button" role="button">Editar</a>

                        <a name="" id="" class="btn btn-danger" href="index.php?txtid=<?php echo $registros['id']; ?> " role="button">Eliminar</a>

                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    

    </div>
  
</div>

<?php include("../../templates/footer.php");?> 