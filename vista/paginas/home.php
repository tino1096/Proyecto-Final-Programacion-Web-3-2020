<?php 
	session_start();
    if (! $_SESSION['activa'] == true) {
        header("Location: ../../index.html");
    }
?>

<div class="card mt-4 center">
    <div class="card-body">
        <h1 class="card-title">Registrar Entrada/Salida</h1>
        
        <form method="POST" action="../../scripts/servidor/registros/procesar_alta_registros.php">
            <button type="submit" class="btn btn-primary">REGISTRAR ENTRADA/SALIDA</button>
        </form>

    </div>
</div>