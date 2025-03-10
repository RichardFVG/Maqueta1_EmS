<?php
class Factura {
    private $id;
    private $fecha;
    private $cliente;
    private $servicio;
    private $total;

    private $db; // Conexión PDO

    public function __construct() {
        $this->db = Database::connect();
    }

    // Getters y setters
    public function setId($id){ $this->id = $id; }
    public function getId(){ return $this->id; }

    public function setFecha($fecha){ $this->fecha = $fecha; }
    public function getFecha(){ return $this->fecha; }

    public function setCliente($cliente){ $this->cliente = $cliente; }
    public function getCliente(){ return $this->cliente; }

    public function setServicio($servicio){ $this->servicio = $servicio; }
    public function getServicio(){ return $this->servicio; }

    public function setTotal($total){ $this->total = $total; }
    public function getTotal(){ return $this->total; }

    // Inserta una nueva factura
    public function save() {
        $sql = "INSERT INTO facturas (fecha, cliente, servicio, total)
                VALUES (:fecha, :cliente, :servicio, :total)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':cliente', $this->cliente);
        $stmt->bindParam(':servicio', $this->servicio);
        $stmt->bindParam(':total', $this->total);
        return $stmt->execute();
    }

    // Actualiza una factura existente
    public function update() {
        $sql = "UPDATE facturas
                SET fecha = :fecha, cliente = :cliente, servicio = :servicio, total = :total
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':cliente', $this->cliente);
        $stmt->bindParam(':servicio', $this->servicio);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Borra una factura
    public function delete() {
        $sql = "DELETE FROM facturas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Obtiene todas las facturas
    public function getAll() {
        $sql = "SELECT * FROM facturas ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene una factura por su id
    public function getOne() {
        $sql = "SELECT * FROM facturas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Filtrar facturas por rango de fechas
    public function filterByDateRange($startDate, $endDate) {
        $sql = "SELECT * FROM facturas
                WHERE fecha BETWEEN :startDate AND :endDate";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
