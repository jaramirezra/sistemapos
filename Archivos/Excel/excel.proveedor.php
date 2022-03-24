<?php
           // Descarga del archivo CSV
       header("Content-disposition: attachment; filename=plantilla-proveedor.csv");
       header("Content-type: MIME");
       readfile("plantilla-proveedor.csv");
?>