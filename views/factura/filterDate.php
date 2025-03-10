<div class="row">
    <div class="col-6 offset-3">
        <h2>Filtrar Facturas por Fecha</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="start_date" class="form-label">Fecha Inicial</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Fecha Final</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="index.php?controller=Factura&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
