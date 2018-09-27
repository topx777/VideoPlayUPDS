<?php
    $db = new Conexion();
    $db->charset();
    $obtenerCategorias = $db->query("SELECT * FROM categoria");
    if($db->rows($obtenerCategorias) > 0)
    {
        while($resCate = $db->recorrer($obtenerCategorias))
        {
            $categorias[] = array(
                'id' => $resCate['idCategoria'],
                'nombre' => $resCate['nombreCategoria'],
                'icono' => $resCate['icono']
            );
        }
    }
?>
<div id="main-category">
    <div class="container-full">
        <div class="row">
            <div class="col-md-12">
                <ul class="main-category-menu">
                <?php
                $color = 1;
                $max_color = 4;
                foreach ($categorias as $key => $categoria) {
                    $color = $color > 4 ? 1 : $color;
                    echo '<li class="color-'.$color.'"><a href="categorias.php?categoria='.$categoria['id'].'"><i class="fa '.$categoria['icono'].'"></i>'.$categoria['nombre'].'</a></li>';
                    $color++;
                }
                ?>
                </ul>
            </div><!-- // col-md-14 -->
        </div><!-- // row -->
    </div><!-- // container-full -->
</div><!-- // main-category -->