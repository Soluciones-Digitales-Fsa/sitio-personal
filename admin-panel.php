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
