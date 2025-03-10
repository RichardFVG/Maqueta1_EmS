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