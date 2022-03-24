<?php
           // Descarga del archivo CSV
       header("Content-disposition: attachment; filename=plantilla-producto.csv");
       header("Content-type: MIME");
       readfile("plantilla.csv");
?>