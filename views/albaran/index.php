<div class="row">
    <div class="col-12">
        <h2>Listado de Albaranes</h2>
        <a href="index.php?controller=Albaran&action=create" class="btn btn-primary mb-3">Crear Albarán</a>
        <!-- Nuevo botón para generar resumen -->
        <a href="index.php?controller=Albaran&action=generateSummary" class="btn btn-primary mb-3">Generar Historial</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($albaranes)): ?>
                    <?php foreach($albaranes as $albaran): ?>
                    <tr>
                        <td><?= $albaran['id']; ?></td>
                        <td><?= $albaran['fecha']; ?></td>
                        <td><?= $albaran['proveedor']; ?></td>
                        <td><?= $albaran['cantidad']; ?></td>
                        <td><?= $albaran['descripcion']; ?></td>
                        <td>
                            <a class="btn btn-warning"
                               href="index.php?controller=Albaran&action=edit&id=<?= $albaran['id']; ?>">
                               Editar
                            </a>
                            <a class="btn btn-danger"
                               href="index.php?controller=Albaran&action=delete&id=<?= $albaran['id']; ?>"
                               onclick="return confirm('¿Estás seguro de eliminar este albarán?')">
                               Borrar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No hay albaranes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

            
    </div>
</div>
