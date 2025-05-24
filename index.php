<?php 
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
      
    </div>
  </section>
  
  <section id="equipo" class="team"> 
    <div class="container">
      <h2>Nuestro Equipo</h2>
      <div class="team-members">

        
      </div>
    </div>
  </section>

  <section id="idiomas" class="languages">
  <div class="container">
    <h2>Idiomas</h2>
    <ul class="language-list">
      <li>
        <img src="#" alt="Español" class="flag-icon">
        <span>Español (nativo)</span>
      </li>
      <li>
        <img src="#" alt="Inglés" class="flag-icon">
        <span>Inglés (avanzado)</span>
      </li>
      <li>
        <img src="#" alt="Portugués" class="flag-icon">
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

  
  
</main>

  
</body>
</html>
?>
