<div class="row">
    <div class="col-6 offset-3">
        <h2>Nueva Factura</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text" name="cliente" id="cliente" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="servicio" class="form-label">Servicio</label>
                <input type="text" name="servicio" id="servicio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" step="0.01" name="total" id="total" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?controller=Factura&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
