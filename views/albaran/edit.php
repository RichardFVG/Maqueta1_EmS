<div class="row">
    <div class="col-6 offset-3">
        <h2>Editar Albarán</h2>
        <?php if(isset($albaran)): ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha"
                       class="form-control"
                       value="<?= $albaran['fecha']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="proveedor" class="form-label">Proveedor</label>
                <input type="text" name="proveedor" id="proveedor"
                       class="form-control"
                       value="<?= $albaran['proveedor']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad"
                       class="form-control"
                       value="<?= $albaran['cantidad']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" name="descripcion" id="descripcion"
                       class="form-control"
                       value="<?= $albaran['descripcion']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php?controller=Albaran&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
        <?php else: ?>
            <p>No se encontró el albarán.</p>
        <?php endif; ?>
    </div>
</div>
