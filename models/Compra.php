<?php
class Compra {
    private $id;
    private $cliente;
    private $producto;
    private $fecha;
    private $monto;

    private $db; // Conexión PDO

    public function __construct() {
        $this->db = Database::connect();
    }

    // Getters y setters (opcional usarlos todos si necesitas CRUD completo)
    public function setId($id){ $this->id = $id; }
    public function getId(){ return $this->id; }

    public function setCliente($cliente){ $this->cliente = $cliente; }
    public function getCliente(){ return $this->cliente; }

    public function setProducto($producto){ $this->producto = $producto; }
    public function getProducto(){ return $this->producto; }

    public function setFecha($fecha){ $this->fecha = $fecha; }
    public function getFecha(){ return $this->fecha; }

    public function setMonto($monto){ $this->monto = $monto; }
    public function getMonto(){ return $this->monto; }

    // Obtiene todas las compras (opcional si lo necesitas)
    public function getAll() {
        $sql = "SELECT * FROM compras ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ejemplo: Agrupar por cliente para clasificación
    public function getAllGroupedByCliente() {
        $sql = "SELECT cliente, COUNT(*) AS total_compras, SUM(monto) AS monto_total
                FROM compras
                GROUP BY cliente";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
