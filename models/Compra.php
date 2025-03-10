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

    // Getters y setters
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

    // Insertar nueva compra
    public function save() {
        $sql = "INSERT INTO compras (cliente, producto, fecha, monto)
                VALUES (:cliente, :producto, :fecha, :monto)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':cliente', $this->cliente);
        $stmt->bindParam(':producto', $this->producto);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':monto', $this->monto);
        return $stmt->execute();
    }

    // Actualizar compra
    public function update() {
        $sql = "UPDATE compras
                SET cliente = :cliente, producto = :producto, fecha = :fecha, monto = :monto
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':cliente', $this->cliente);
        $stmt->bindParam(':producto', $this->producto);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Borrar compra
    public function delete() {
        $sql = "DELETE FROM compras WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Obtener todas las compras
    public function getAll() {
        $sql = "SELECT * FROM compras ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una compra
    public function getOne() {
        $sql = "SELECT * FROM compras WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Clasificación: agrupar por cliente (ejemplo)
    public function getAllGroupedByCliente() {
        $sql = "SELECT cliente, COUNT(*) AS total_compras, SUM(monto) AS monto_total
                FROM compras
                GROUP BY cliente";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
