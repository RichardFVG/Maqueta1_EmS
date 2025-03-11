**README - Maqueta Dental Dominguez**

¡Bienvenido/a! Este es una maqueta de ejemplo que ilustra una arquitectura básica **MVC** (Modelo-Vista-Controlador) desarrollada en **PHP** para la gestión de facturas, albaranes y compras, utilizando **MySQL** como base de datos y **Bootstrap** para la maquetación. A continuación, encontrarás toda la información necesaria para ponerlo en marcha y personalizarlo.

---

## 1. Descripción General

Este proyecto es una **maqueta funcional** que cubre los aspectos esenciales de un sistema de administración para un consultorio dental (o cualquier contexto similar). Permite:
- Crear, listar, editar, eliminar y descargar en formato XLS las **facturas**.
- Crear, listar, editar y eliminar los **albaranes**.
- Listar las **compras**, descargarlas en XLS y clasificarlas (por cliente, en el ejemplo).
- Filtrar facturas por rango de fechas.

La organización de carpetas y ficheros se diseñó para reflejar el patrón MVC:
- **Modelos** en `models/`
- **Controladores** en `controllers/`
- **Vistas** en `views/`
- Un **archivo de configuración** para la base de datos en `config/database.php`
- Un **archivo principal** de entrada (`index.php`) que gestiona las peticiones entrantes.

---

## 2. Requisitos Previos

1. **Servidor local**: Se recomienda usar [XAMPP](https://www.apachefriends.org/es/index.html) u otro entorno que incluya PHP y MySQL.
2. **Base de datos MySQL**: El proyecto utiliza una base de datos denominada `consultorio_dental`.
3. **PHP** en versión 7.4 o superior (probado hasta 8.x).
4. **Composer** (opcional) si se planea incluir librerías adicionales.  
5. **Navegador web** para acceder a la aplicación (Chrome, Firefox, etc.).

---

## 3. Estructura de Carpetas

La carpeta principal (por defecto llamada `Maqueta1_EmS`) presenta esta estructura:

```
Maqueta1_EmS/
├── index.php
├── assets/
│   └── css/
│       └── style_compras.css
├── config/
│   └── database.php
├── controllers/
│   ├── BaseController.php
│   ├── FacturaController.php
│   ├── AlbaranController.php
│   └── CompraController.php
├── models/
│   ├── Factura.php
│   ├── Albaran.php
│   └── Compra.php
└── views/
    ├── layouts/
    │   ├── header.php
    │   ├── footer.php
    │   └── menu.php
    ├── factura/
    │   ├── index.php
    │   ├── create.php
    │   ├── edit.php
    │   └── filterDate.php
    ├── albaran/
    │   ├── index.php
    │   ├── create.php
    │   ├── edit.php
    │   └── summary.php
    └── compra/
        ├── index.php
        ├── create.php
        ├── edit.php
        └── classification.php
```

Cada carpeta agrupa archivos de un mismo tipo (MVC). Por ejemplo, en `controllers/` se definen las acciones para facturas, albaranes y compras. Las vistas relacionadas con cada entidad se hallan en subcarpetas específicas (`factura`, `albaran`, `compra`), y así sucesivamente.

---

## 4. Instalación y Configuración

1. **Clonar o copiar** este proyecto en tu entorno local, por ejemplo en la carpeta `htdocs` de XAMPP:
   ```
   C:\Users\Alpha\OneDrive\Documents\XAMPP\htdocs\Maqueta1_EmS
   ```

2. **Crear la base de datos**:
   - En phpMyAdmin u otra herramienta, ejecuta o importa el archivo SQL que incluye la creación de la base de datos y sus tablas. Puedes nombrarlo, por ejemplo, `consultorio_dental.sql`. Su contenido es:
     ```sql
     CREATE DATABASE IF NOT EXISTS consultorio_dental;
     USE consultorio_dental;

     CREATE TABLE IF NOT EXISTS facturas (
       id INT AUTO_INCREMENT PRIMARY KEY,
       fecha DATE NOT NULL,
       cliente VARCHAR(100) NOT NULL,
       servicio VARCHAR(100) NOT NULL,
       total DECIMAL(10,2) NOT NULL
     );

     CREATE TABLE IF NOT EXISTS albaranes (
       id INT AUTO_INCREMENT PRIMARY KEY,
       fecha DATE NOT NULL,
       proveedor VARCHAR(100) NOT NULL,
       cantidad INT NOT NULL,
       descripcion VARCHAR(255) NOT NULL
     );

     CREATE TABLE IF NOT EXISTS compras (
       id INT AUTO_INCREMENT PRIMARY KEY,
       cliente VARCHAR(100) NOT NULL,
       producto VARCHAR(100) NOT NULL,
       fecha DATE NOT NULL,
       monto DECIMAL(10,2) NOT NULL
     );
     ```

3. **Verificar credenciales** de la base de datos en `config/database.php`:
   ```php
   class Database {
       public static function connect() {
           $host = "localhost";
           $db_name = "consultorio_dental";
           $username = "root";    // Ajustar
           $password = "";        // Ajustar
           ...
       }
   }
   ```

4. **Iniciar servidores** en XAMPP (Apache + MySQL).  

5. **Acceder a la app**:
   - Abre tu navegador y visita `http://localhost/Maqueta1_EmS/` o `http://localhost/Maqueta1_EmS/index.php`.
   - Esto cargará el controlador y la acción por defecto (FacturaController -> index).

---

## 5. Uso y Navegación

- Al entrar, verás un menú principal (usando Bootstrap) que enlaza a:
  1. **Facturas**  
     - Crear, listar, editar, eliminar y **descargar XLS**.
     - Filtrar por rango de fecha (mediante formulario).
  2. **Albaranes**  
     - Crear, listar, editar, eliminar.
     - Generar historial (summary) y **descargar XLS**.
  3. **Compras**  
     - Crear, listar, editar, eliminar y **descargar XLS**.
     - Clasificar por cliente, mostrando el total de compras y monto global de cada cliente.

Cada sección dispone de formularios y listados con ejemplos sencillos de validación en el lado del servidor (PHP). Los modelos implementan los métodos CRUD más básicos (create, read, update, delete) y algunas funciones adicionales (como filtrar por fecha o agrupar resultados).

---

## 6. Personalización y Mejora

1. **Validación de datos**: Se pueden agregar checks más avanzados en los controladores o en los modelos, además de manejar excepciones.
2. **Seguridad y roles**: Para un proyecto real, conviene implementar sesiones de usuario, control de accesos (roles de administrador, usuario, etc.) y protección CSRF.
3. **Exportar a PDF**: Actualmente solo se proporciona la descarga en XLS. Puedes incorporar bibliotecas como [FPDF](http://www.fpdf.org/) o [TCPDF](https://tcpdf.org/) para PDF.
4. **Diseño y estilos**: Hay una hoja CSS (`style_compras.css`) con reglas básicas. Puedes adaptarla o incorporar SASS/SCSS.
5. **Rutas amigables**: Para despliegues en producción, podrías implementar un archivo `.htaccess` o configuraciones de servidor que permitan URLs más limpias (en lugar de `index.php?controller=...&action=...`).

---

## 7. Estructura MVC Simplificada

- **Modelos** (`models/`): Manejan la lógica de datos y se comunican con la base de datos usando PDO.
- **Controladores** (`controllers/`): Recogen las peticiones (GET/POST), llaman a los métodos del modelo y determinan qué vista mostrar.
- **Vistas** (`views/`): Muestran la información a los usuarios. Se dividen en plantillas comunes (`layouts/`) y vistas específicas de cada entidad.

El archivo `index.php` es el **Front Controller**, que determina cuál controlador y acción se utilizarán según los parámetros en la URL.

---
