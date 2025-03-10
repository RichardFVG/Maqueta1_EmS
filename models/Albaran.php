<?php
class Albaran {
    private $id;
    private $fecha;
    private $proveedor;
    private $cantidad;
    private $descripcion;

    private $db; // Conexión PDO

    public function __construct() {
        $this->db = Database::connect();
    }

    // Getters y setters
    public function setId($id){ $this->id = $id; }
    public function getId(){ return $this->id; }

    public function setFecha($fecha){ $this->fecha = $fecha; }
    public function getFecha(){ return $this->fecha; }

    public function setProveedor($proveedor){ $this->proveedor = $proveedor; }
    public function getProveedor(){ return $this->proveedor; }

    public function setCantidad($cantidad){ $this->cantidad = $cantidad; }
    public function getCantidad(){ return $this->cantidad; }

    public function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
    public function getDescripcion(){ return $this->descripcion; }

    // Insertar un nuevo albarán
    public function save() {
        $sql = "INSERT INTO albaranes (fecha, proveedor, cantidad, descripcion)
                VALUES (:fecha, :proveedor, :cantidad, :descripcion)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':proveedor', $this->proveedor);
        $stmt->bindParam(':cantidad', $this->cantidad);
        $stmt->bindParam(':descripcion', $this->descripcion);
        return $stmt->execute();
    }

    // Actualizar albarán
    public function update() {
        $sql = "UPDATE albaranes
                SET fecha = :fecha, proveedor = :proveedor, cantidad = :cantidad, descripcion = :descripcion
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':proveedor', $this->proveedor);
        $stmt->bindParam(':cantidad', $this->cantidad);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Borrar albarán
    public function delete() {
        $sql = "DELETE FROM albaranes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Obtener todos los albaranes
    public function getAll() {
        $sql = "SELECT * FROM albaranes ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un albarán
    public function getOne() {
        $sql = "SELECT * FROM albaranes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
