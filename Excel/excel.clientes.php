<?php
           // Descarga del archivo CSV
       header("Content-disposition: attachment; filename=plantilla-clientes.csv");
       header("Content-type: MIME");
       readfile("plantilla-clientes.csv");
?>