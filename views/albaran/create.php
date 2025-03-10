<div class="row">
    <div class="col-6 offset-3">
        <h2>Nuevo Albarán</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="proveedor" class="form-label">Proveedor</label>
                <input type="text" name="proveedor" id="proveedor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?controller=Albaran&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
