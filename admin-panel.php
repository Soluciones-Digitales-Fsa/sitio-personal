<?php 

include 'db.php';
include 'autenticacion.php';
// Función para limpiar entrada
function limpiar_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Manejo de POST para CRUD
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'guardar_sobre') {
        $contenido = $_POST['contenido'] ?? '';
        $contenido = limpiar_input($contenido);

        // Actualizar o insertar el contenido "sobre nosotros"
        $sql_check = "SELECT id FROM nosotros LIMIT 1";
    $result = $conn->query($sql_check);
    if ($result && $row = $result->fetch_assoc()) {
        $id_nosotros = $row['id']; // Obtén el id
        $sql_update = "UPDATE nosotros SET contenido = ? WHERE id = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("si", $contenido, $id_nosotros); // Vincula el contenido y el id
        $stmt->execute();
        $stmt->close();
    } else {
        $sql_insert = "INSERT INTO nosotros (contenido) VALUES (?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("s", $contenido);
        $stmt->execute();
        $stmt->close();
    }
        header("Location: admin-panel.php?msg=sobre_guardado");
        exit;
    }

if ($accion === 'agregar_equipo') {
        $nombre = limpiar_input($_POST['nombre'] ?? '');
        $rol = limpiar_input($_POST['rol'] ?? '');

        if ($nombre && $rol) {
            $sql = "INSERT INTO equipo (nombre, rol) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $nombre, $rol);
            $stmt->execute();
            $stmt->close();
        }
        header("Location: admin-panel.php?msg=equipo_agregado");
        exit;
    }

 if ($accion === 'editar_equipo') {
        $id = intval($_POST['id'] ?? 0);
        $nombre = limpiar_input($_POST['nombre'] ?? '');
        $rol = limpiar_input($_POST['rol'] ?? '');
        if ($id > 0 && $nombre && $rol) {
            $sql = "UPDATE equipo SET nombre = ?, rol = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $nombre, $rol, $id);
            $stmt->execute();
            $stmt->close();
        }
        header("Location: admin-panel.php?msg=equipo_editado");
        exit;
    }

  if ($accion === 'eliminar_equipo') {
        $id = intval($_POST['id'] ?? 0);
        if ($id > 0) {
            $sql = "DELETE FROM equipo WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
        header("Location: admin-panel.php?msg=equipo_eliminado");
        exit;
    }

    if ($accion === 'agregar_proyecto') {
        $titulo = limpiar_input($_POST['titulo'] ?? '');
        $descripcion = limpiar_input($_POST['descripcion'] ?? '');
        if ($titulo && $descripcion) {
            $sql = "INSERT INTO proyectos (titulo, descripcion) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $titulo, $descripcion);
            $stmt->execute();
            $stmt->close();
        }
        header("Location: admin-panel.php?msg=proyecto_agregado");
        exit;
    }

if ($accion === 'editar_proyecto') {
        $id = intval($_POST['id'] ?? 0);
        $titulo = limpiar_input($_POST['titulo'] ?? '');
        $descripcion = limpiar_input($_POST['descripcion'] ?? '');
        if ($id > 0 && $titulo && $descripcion) {
            $sql = "UPDATE proyectos SET titulo = ?, descripcion = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $titulo, $descripcion, $id);
            $stmt->execute();
            $stmt->close();
        }
        header("Location: admin-panel.php?msg=proyecto_editado");
        exit;
    }

    if ($accion === 'eliminar_proyecto') {
        $id = intval($_POST['id'] ?? 0);
        if ($id > 0) {
            $sql = "DELETE FROM proyectos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
        header("Location: admin-panel.php?msg=proyecto_eliminado");
        exit;
    }

}

// Cargar datos para mostrar en el panel
$sobre_nosotros = "";
$sql = "SELECT contenido FROM nosotros LIMIT 1";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $sobre_nosotros = $row['contenido'];
}

$equipo = [];
$sql = "SELECT * FROM equipo ORDER BY id DESC";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $equipo[] = $row;
    }
}

$proyectos = [];
$sql = "SELECT * FROM proyectos ORDER BY id DESC";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $proyectos[] = $row;
    }
}

// Cargar mensajes de contacto
$contact_messages = [];
$sql = "SELECT * FROM contactos ORDER BY fecha_creado DESC";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $contact_messages[] = $row;
    }
}

// Mostrar mensajes
$msg = $_GET['msg'] ?? '';
$msg_text = '';
switch ($msg) {
    //case 'mensaje_guardado': $msg_text = "Mensaje enviado correctamente."; break;
    case 'sobre_guardado': $msg_text = "Sección 'Sobre Nosotros' guardada correctamente."; break;
    case 'equipo_agregado': $msg_text = "Miembro del equipo agregado correctamente."; break;
    case 'equipo_editado': $msg_text = "Miembro del equipo editado correctamente."; break;
    case 'equipo_eliminado': $msg_text = "Miembro del equipo eliminado correctamente."; break;
    case 'proyecto_agregado': $msg_text = "Proyecto agregado correctamente."; break;
    case 'proyecto_editado': $msg_text = "Proyecto editado correctamente."; break;
    case 'proyecto_eliminado': $msg_text = "Proyecto eliminado correctamente."; break;
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="styles/estilos-admin.css"/>
</head>
<body>
<header>
    <h1>Panel de Administrador</h1>
    <a href="logout.php">Cerrar sesión</a>
</header>
    
<?php if ($msg_text): ?>
<section class="mensaje-exito"><?= htmlspecialchars($msg_text) ?></section>
<?php endif; ?>
    
<main>
    <section>
    <h2>Sobre Nosotros</h2>
    <form method="post" action="admin-panel.php">
        <textarea name="contenido" rows="6" required><?= htmlspecialchars($sobre_nosotros) ?></textarea><br/>
        <input type="hidden" name="accion" value="guardar_sobre"/>
        <button type="submit">Guardar</button>
    </form>
  </section>

   <section>
    <h2>Equipo</h2>
    <form method="post" action="admin-panel.php" class="agregar-form">
        <input type="hidden" name="accion" value="agregar_equipo"/>
        <input type="text" name="nombre" placeholder="Nombre" required/>
        <input type="text" name="rol" placeholder="Rol" required/>
        <button type="submit">Agregar Miembro</button>
    </form>
       
   </section> 

   <section>
    <h2>Proyectos</h2>
    <form method="post" action="admin-panel.php" class="agregar-form">
        <input type="hidden" name="accion" value="agregar_proyecto"/>
        <input type="text" name="titulo" placeholder="Título" required/>
        <input type="text" name="descripcion" placeholder="Descripción" required/>
        <button type="submit">Agregar Proyecto</button>
    </form>
       
    </section> 
    
</main>
</body>
</html>

<?
