<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" aria-controls="navbarNav" 
            aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
        <!-- Facturas -->
        <li class="nav-item">
          <a class="nav-link" 
             href="index.php?controller=Factura&action=index">
             Facturas
          </a>
        </li>
        
        <!-- Albaranes -->
        <li class="nav-item">
          <a class="nav-link" 
             href="index.php?controller=Albaran&action=index">
             Albaranes
          </a>
        </li>
        
        <!-- Compras (clasificación) -->
        <li class="nav-item">
          <a class="nav-link" 
             href="index.php?controller=Compra&action=index">
             Clasificación Compras
          </a>
        </li>
        
        <!-- Listado con Filtro de Fechas -->
        <li class="nav-item">
          <a class="nav-link" 
             href="index.php?controller=Factura&action=filterDate">
             Listado Facturas (Filtrar)
          </a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
