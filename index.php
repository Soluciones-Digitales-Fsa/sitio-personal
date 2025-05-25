<?php 

include 'db.php';
function limpiar_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

//manejo de envío de formulario de contacto
$msg = '';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['accion']) && $_POST['accion'] === 'guardar_mensaje') {
    $nombre = limpiar_input($_POST['nombre'] ?? '');
    $email = limpiar_input($_POST['email'] ?? '');
    $mensaje = limpiar_input($_POST['mensaje'] ?? '');
    if ($nombre && $email && $mensaje) {
        $sql = "INSERT INTO contactos (nombre, email, mensaje) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sss", $nombre, $email, $mensaje);
            $stmt->execute();
            $stmt->close();
            $msg = "Mensaje enviado correctamente.";
        } else {
            $msg = "Error al preparar la consulta.";
        }
    } else {
        $msg = "Por favor complete todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DevNode</title>
  <link rel="stylesheet" href="styles/estilos-index.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
  <header>
  <div class="container">
      <nav>
<div class="logo" tabindex="0" aria-label="Logo de la empresa">
    <img src="images/DEVNODE.jpg" alt="Logo de DevNode" />
  </div>  
  <ul class="nav-list">
    <li><a href="#inicio">Inicio</a></li>
    <li><a href="#nosotros">Nosotros</a></li>
    <li><a href="#equipo">Equipo</a></li>
    <li><a href="#idiomas">Idiomas</a></li>
    <li><a href="#proyectos">Proyectos</a></li>
    <li><a href="#herramientas">Herramientas</a></li>
    <li><a href="#testimonios">Testimonios</a></li>
    <li><a href="#contacto">Contacto</a></li>
  </ul>
  <div class="login-container">
    <a href="login.php">Login</a>
  </div>
</nav>
  </div>
</header>

<main>
  <section id="inicio" class="hero">
    <div class="container-titulo">
      <h1 class="">Bienvenidos a DevNode</h1>
      <p>Conectando Ideas, Creando Soluciones</p>
    </div>
  </section>
  
  <section id="nosotros" class="about">
    <div class="container">
      <h2>Sobre Nosotros</h2>
           <?php
        $result = $conn->query("SELECT * FROM nosotros ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='contenido'>";
            echo "<p>{$row['contenido']}</p>";
            echo "</div>";
        }
        ?>
    </div>
  </section>
  
  <section id="equipo" class="team"> 
    <div class="container">
      <h2>Nuestro Equipo</h2>
      <div class="team-members">

          <div class="card-container" title="Pasa el puntero para girar la tarjeta">
    <div class="card">
      <div class="card-face card-front member">
        <img class="img-member" src="images/veronica.jpg" alt="Verónica Álvarez" />
        <?php
          $result = $conn->query("SELECT * FROM equipo WHERE id = 1");
          while ($row = $result->fetch_assoc()) {
              echo "<div class='nombre'>";
              echo "<h3>{$row['nombre']}</h3>";
              echo "<p>{$row['rol']}</p>";
              echo "</div>";
          }
        ?>
      </div>
      <div class="card-face card-back">
        <h3>Más Información</h3>
        <p>Aquí puede ir información adicional sobre el miembro.</p>
        <p>Teléfono: +123 456 789</p>
        <p>Email: veronica@example.com</p>
      </div>
    </div>
  </div>
  
      <div class="card-container" title="Pasa el puntero para girar la tarjeta">
    <div class="card">
      <div class="card-face card-front member">
        <img class="img-member" src="images/yanina.jpg" alt="Yanina Cabrera">
        <?php
          $result = $conn->query("SELECT * FROM equipo WHERE id = 2");
          while ($row = $result->fetch_assoc()) {
              echo "<div class='nombre'>";
              echo "<h3>{$row['nombre']}</h3>";
              echo "<p>{$row['rol']}</p>";
              echo "</div>";
          }
        ?>
      </div>
      <div class="card-face card-back">
        <h3>Más Información</h3>
        <p>Aquí puede ir información adicional sobre el miembro.</p>
        <p>Teléfono: +123 456 789</p>
        <p>Email: veronica@example.com</p>
      </div>
    </div>
  </div>

      <div class="card-container" title="Pasa el puntero para girar la tarjeta">
    <div class="card">
      <div class="card-face card-front member">
        <img class="img-member" src="images/valeria.jpg" alt="Valeria Figueredo">
        <?php
          $result = $conn->query("SELECT * FROM equipo WHERE id = 3");
          while ($row = $result->fetch_assoc()) {
              echo "<div class='nombre'>";
              echo "<h3>{$row['nombre']}</h3>";
              echo "<p>{$row['rol']}</p>";
              echo "</div>";
          }
        ?>
      </div>
      <div class="card-face card-back">
        <h3>Más Información</h3>
        <p>Aquí puede ir información adicional sobre el miembro.</p>
        <p>Teléfono: +123 456 789</p>
        <p>Email: veronica@example.com</p>
      </div>
    </div>
  </div>

      <div class="card-container" title="Pasa el puntero para girar la tarjeta">
    <div class="card">
      <div class="card-face card-front member">
        <img class="img-member" src="images/sebastian.jpg" alt="Sebastián Mora">
        <?php
          $result = $conn->query("SELECT * FROM equipo WHERE id = 4");
          while ($row = $result->fetch_assoc()) {
              echo "<div class='nombre'>";
              echo "<h3>{$row['nombre']}</h3>";
              echo "<p>{$row['rol']}</p>";
              echo "</div>";
          }
        ?>
      </div>
      <div class="card-face card-back">
        <h3>Más Información</h3>
        <p>Aquí puede ir información adicional sobre el miembro.</p>
        <p>Teléfono: +123 456 789</p>
        <p>Email: veronica@example.com</p>
      </div>
    </div>
  </div>

      <div class="card-container" title="Pasa el puntero para girar la tarjeta">
    <div class="card">
      <div class="card-face card-front member">
        <img class="img-member" src="images/gustavo.jpg" alt="Gustavo Ayala">
        <?php
          $result = $conn->query("SELECT * FROM equipo WHERE id = 5");
          while ($row = $result->fetch_assoc()) {
              echo "<div class='nombre'>";
              echo "<h3>{$row['nombre']}</h3>";
              echo "<p>{$row['rol']}</p>";
              echo "</div>";
          }
        ?>
      </div>
      <div class="card-face card-back">
        <h3>Más Información</h3>
        <p>Aquí puede ir información adicional sobre el miembro.</p>
        <p>Teléfono: +123 456 789</p>
        <p>Email: veronica@example.com</p>
      </div>
    </div>
  </div>

      <div class="card-container" title="Pasa el puntero para girar la tarjeta">
    <div class="card">
      <div class="card-face card-front member">
        <img class="img-member" src="images/hugo.jpg" alt="Hugo Brandan">
        <?php
          $result = $conn->query("SELECT * FROM equipo WHERE id = 6");
          while ($row = $result->fetch_assoc()) {
              echo "<div class='nombre'>";
              echo "<h3>{$row['nombre']}</h3>";
              echo "<p>{$row['rol']}</p>";
              echo "</div>";
          }
        ?>
      </div>
      <div class="card-face card-back">
        <h3>Más Información</h3>
        <p>Aquí puede ir información adicional sobre el miembro.</p>
        <p>Teléfono: +123 456 789</p>
        <p>Email: veronica@example.com</p>
      </div>
    </div>
  </div>
  
      <div class="card-container" title="Pasa el puntero para girar la tarjeta">
    <div class="card">
      <div class="card-face card-front member">
        <img class="img-member" src="images/noelia.jpg" alt="Noelia Chávez">
        <?php
          $result = $conn->query("SELECT * FROM equipo WHERE id = 7");
          while ($row = $result->fetch_assoc()) {
              echo "<div class='nombre'>";
              echo "<h3>{$row['nombre']}</h3>";
              echo "<p>{$row['rol']}</p>";
              echo "</div>";
          }
        ?>
      </div>
      <div class="card-face card-back">
        <h3>Más Información</h3>
        <p>Aquí puede ir información adicional sobre el miembro.</p>
        <p>Teléfono: +123 456 789</p>
        <p>Email: veronica@example.com</p>
      </div>
    </div>
  </div>
        
      </div>
    </div>
  </section>

  <section id="idiomas" class="languages">
  <div class="container">
    <h2>Idiomas</h2>
    <ul class="language-list">
      <li>
        <img src="images/argentina.png" alt="Español" class="flag-icon">
        <span>Español (nativo)</span>
      </li>
      <li>
        <img src="images/reino-unido.png" alt="Inglés" class="flag-icon">
        <span>Inglés (avanzado)</span>
      </li>
      <li>
        <img src="images/brasil.png" alt="Portugués" class="flag-icon">
        <span>Portugués (básico)</span>
      </li>
    </ul>
  </div>
</section>

<section id="proyectos" class="projects">
  <div class="container">
    <h2>Proyectos</h2>

    <div class="slider-wrapper" style="position: relative; width: 480px; margin: 0 auto;">
      <!-- Flecha izquierda -->
      <button id="btnLeft" class="arrow-btn arrow-left" aria-label="Proyecto anterior">
        <i class="arrow-icon left-icon"></i>
      </button>

      <!-- Contenedor scroll -->
      <div class="project-list scroll-snap-container">

          <?php
          $result = $conn->query("SELECT * FROM proyectos ORDER BY id DESC");
          while ($row = $result->fetch_assoc()) {
              echo "<div class='project'>";
              echo "<h3>" . htmlspecialchars($row['titulo']) . "</h3>";
              echo "<p>" . htmlspecialchars($row['descripcion']) . "</p>";
              echo "<button>Ir al proyecto</button>";
              echo "</div>";
          }
        ?>
   
      </div>

      <!-- Flecha derecha -->
      <button id="btnRight" class="arrow-btn arrow-right" aria-label="Siguiente proyecto">
        <i class="arrow-icon right-icon"></i>
      </button>
    </div>
  </div>
</section>

<section id="herramientas" class="tools">
  <div class="container">
    <h2>Herramientas y Tecnologías</h2>
    <div class="tools-logos">
      <i class="fab fa-html5 fa-3x"></i>
      <i class="fab fa-css3-alt fa-3x"></i>
      <i class="fab fa-js-square fa-3x"></i>
      <i class="fab fa-php fa-3x"></i>
      <i class="fas fa-database fa-3x"></i>
      <i class="fab fa-git-alt fa-3x"></i>
    </div>
  </div>
</section>

<section id="testimonios" class="testimonials">
    <div class="container">
      <h2>Testimonios</h2>
      <div class="testimonial">
        
      </div>
      <div class="testimonial">
        
      </div>
      <div class="testimonial">
        
      </div>
    </div>
  </section>

  <section id="contacto" class="contact">
    <div class="container">
      <h2>Contacto</h2>

      
      <form method="post" action="index.php#contacto">
        <input type="hidden" name="accion" value="guardar_mensaje" />
        <input type="text" name="nombre" placeholder="Tu nombre" required />
        <input type="email" name="email" placeholder="Tu correo" required />
        <textarea name="mensaje" placeholder="Tu mensaje..." required></textarea>
        <button type="submit">Enviar</button>
      </form>
    </div>
  </section>
  
</main>

<footer>
  <div class="container">
    <div class="social-links">
      <a href="https://www.instagram.com/devnode25" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
      <a href="https://www.linkedin.com/in/dev-node-271405363" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
      <a href="https://github.com/JuValeria" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
    </div>
    <p>&copy; <?php echo date("Y"); ?> DevNode. Todos los derechos reservados.</p>
  </div>
</footer>

<!-- Botón flotante de WhatsApp -->
<a href="https://wa.me/549XXXXXXXXXX" class="whatsapp-float" target="_blank" title="WhatsApp">
  <i class="fab fa-whatsapp"></i>
</a>

<!-- Botón volver arriba -->
<a href="#inicio" class="scroll-top" title="Volver arriba">
  <i class="fas fa-chevron-up"></i>
</a>

</body>
</html>
?>
