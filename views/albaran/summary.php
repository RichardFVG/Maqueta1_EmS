<div class="row">
    <div class="col-12">
        <h2>Historial de Albaranes</h2>

        <!-- Creamos una fila con dos columnas: 
             - La primera (col-6) muestra las estadísticas
             - La segunda (col-6) alinea el botón a la derecha -->
        <div class="row mb-3">
            <div class="col-6">
                <p>
                    <strong>Total de Albaranes:</strong> <?= $totalAlbaranes; ?><br>
                    <strong>Suma de Cantidades:</strong> <?= $sumaCantidad; ?>
                </p>
            </div>
            <div class="col-6 text-end">
                <a href="index.php?controller=Albaran&action=downloadSummaryXls" 
                   class="btn btn-success">
                   Descargar XLS
                </a>
            </div>
        </div>

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
