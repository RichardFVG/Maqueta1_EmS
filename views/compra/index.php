<div class="row index_compra">
    <div class="col-12">
        <h2 class="mi-titulo-personalizado2">Listado de Compras</h2>
        
        <!-- Botones con clase Bootstrap + clase personalizada -->
        <a href="index.php?controller=Compra&action=create" 
           class="btn btn-primary mb-3 mi-boton-personalizado">
            Añadir Compra
        </a>
        
        <a href="index.php?controller=Compra&action=downloadXls" 
           class="btn btn-success mb-3 mi-boton-success-personalizado">
            Descargar XLS
        </a>

        <!-- Tabla con clase Bootstrap + clase personalizada -->
        <table class="table table-bordered mi-tabla-personalizada">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($compras)): ?>
                    <?php foreach($compras as $compra): ?>
                    <tr>
                        <td><?= $compra['id']; ?></td>
                        <td><?= $compra['cliente']; ?></td>
                        <td><?= $compra['producto']; ?></td>
                        <td><?= $compra['fecha']; ?></td>
                        <td><?= $compra['monto']; ?></td>
                        <td>
                            <!-- Conservamos las clases originales de Bootstrap, 
                                 pero podrías añadir también tu clase extra si lo deseas -->
                            <a class="btn btn-warning"
                               href="index.php?controller=Compra&action=edit&id=<?= $compra['id']; ?>">
                               Editar
                            </a>
                            <a class="btn btn-danger"
                               href="index.php?controller=Compra&action=delete&id=<?= $compra['id']; ?>"
                               onclick="return confirm('¿Estás seguro de eliminar esta compra?')">
                               Borrar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No hay compras registradas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
