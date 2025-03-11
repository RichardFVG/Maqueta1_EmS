<<<<<<< HEAD
<div class="row">
    <div class="col-12">
        <h2>Historial de Albaranes</h2>

        <!-- Pequeño resumen o "stats" -->
        <p>
            <strong>Total de Albaranes:</strong> <?= $totalAlbaranes; ?><br>
            <strong>Suma de Cantidades:</strong> <?= $sumaCantidad; ?>
        </p>

        <!-- Botón de descarga XLS -->
        <a href="index.php?controller=Albaran&action=downloadSummaryXls" 
           class="btn btn-success mb-3">
            Descargar XLS
        </a>

        <?php if(!empty($albaranes)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($albaranes as $albaran): ?>
                    <tr>
                        <td><?= $albaran['id']; ?></td>
                        <td><?= $albaran['fecha']; ?></td>
                        <td><?= $albaran['proveedor']; ?></td>
                        <td><?= $albaran['cantidad']; ?></td>
                        <td><?= $albaran['descripcion']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay albaranes registrados.</p>
        <?php endif; ?>

        <a href="index.php?controller=Albaran&action=index" class="btn btn-secondary">Atrás</a>
    </div>
</div>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
            if(!empty($albaranes)): 
                    foreach($albaranes as $albaran): ?> 
        
                <table class="table table-bordered">
            <thead>
                <tr>
                    <th>MATERIALES ENTREGADOS SEGÚN ALBARANES</th>   
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td><?= "Albarán Nª ". $albaran['id']." de fecha ". $albaran['fecha']. " por un importe de ". $albaran['cantidad']. "€";  ?></td>
                       
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No hay albaranes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="index.php?controller=Factura&action=index" class="btn btn-secondary">Atrás</a>
            
</body>
</html>

