<?php
class Database {
    public static function connect() {
        $host = "localhost";
        $db_name = "consultorio_dental"; // Debe coincidir con el que creaste en tu SQL
        $username = "root";             // Ajusta según tu entorno
        $password = "";                 // Ajusta según tu entorno

        try {
            $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
            exit;
        }
    }
}
