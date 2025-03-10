<div class="row">
    <div class="col-6 offset-3">
        <h2>Editar Compra</h2>
        <?php if(isset($compra)): ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text" name="cliente" id="cliente"
                       class="form-control"
                       value="<?= $compra['cliente']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="producto" class="form-label">Producto</label>
                <input type="text" name="producto" id="producto"
                       class="form-control"
                       value="<?= $compra['producto']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha"
                       class="form-control"
                       value="<?= $compra['fecha']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="monto" class="form-label">Monto</label>
                <input type="number" step="0.01" name="monto" id="monto"
                       class="form-control"
                       value="<?= $compra['monto']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php?controller=Compra&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
        <?php else: ?>
            <p>No se encontró la compra.</p>
        <?php endif; ?>
    </div>
</div>
