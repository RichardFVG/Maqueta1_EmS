<div class="row">
    <div class="col-12">
        <h2>Listado de Facturas</h2>
        <a href="index.php?controller=Factura&action=create" class="btn btn-primary mb-3">Crear Factura</a>
        <a href="index.php?controller=Factura&action=downloadXls" class="btn btn-success mb-3">Descargar XLS</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($facturas)): ?>
                    <?php foreach($facturas as $factura): ?>
                    <tr>
                        <td><?= $factura['id']; ?></td>
                        <td><?= $factura['fecha']; ?></td>
                        <td><?= $factura['cliente']; ?></td>
                        <td><?= $factura['servicio']; ?></td>
                        <td><?= $factura['total']; ?></td>
                        <td>
                            <a class="btn btn-warning" 
                               href="index.php?controller=Factura&action=edit&id=<?= $factura['id']; ?>">
                               Editar
                            </a>
                            <a class="btn btn-danger" 
                               href="index.php?controller=Factura&action=delete&id=<?= $factura['id']; ?>"
                               onclick="return confirm('¿Estás seguro de eliminar esta factura?')">
                               Borrar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No hay facturas registradas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

       

    </div>
</div>
