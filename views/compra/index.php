<div class="row">
    <div class="col-12">
        <h2>Clasificación de Compras por Cliente</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Total de Compras</th>
                    <th>Monto Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($compras)): ?>
                    <?php foreach($compras as $comp): ?>
                    <tr>
                        <td><?= $comp['cliente']; ?></td>
                        <td><?= $comp['total_compras']; ?></td>
                        <td><?= $comp['monto_total']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3">No hay compras registradas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
