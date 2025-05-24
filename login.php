<?php 
session_start(); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex">
  <meta name="googlebot" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Iniciar Sesion</title>
  <meta name="msapplication-TileColor" content="#2b5797">
  <meta name="theme-color" content="#ffffff">
    
  <!-- CSS externos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.20.0/css/mdb.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" >
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/roboto-fontface@0.10.0/css/roboto/roboto-fontface.min.css">

  <!-- CSS personalizado -->
  <link rel="stylesheet" href="styles/estilos-login.css">
  <link rel="stylesheet" href="styles/estilos-popup.css">

</head>
<body class="login-page">

  <header>
    <section class="view">
      <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto">
        
              <!-- Contenedor de Hojas Apiladas -->
              <div class="login-stack fadeIn">
                <div class="paper back"></div>
                <div class="paper middle"></div>

                <div class="paper card">
                  <div class="card-body">
                    <div class="form-header transparent-header">
                        <i class="fas fa-users icon-only"></i> 
                        <h3>Login Administrador</h3><br>
                    </div>

                    <form method="POST" action="login.php">
                      <div class="md-form">
                        <i class="fas fa-user prefix" style="color:rgb(14, 13, 13);"></i>
                        <input type="text" id="user" name="username" class="form-control" autocomplete="off" required>
                        <label for="username">Nombre de usuario</label> <br>
                      </div>

                      <div class="md-form">
                        <i class="fas fa-lock prefix" style="color:rgb(14, 13, 13);"></i>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="off" required>
                        <label for="password">Contraseña</label> <br>
                      </div>

                      <div class="text-center mt-4 mb-2">
                        <button type="submit" class="btn blue-gradient btn-lg btn-block">Ingresar</button>
                        <a href="index.php" class="btn btn-outline-blue btn-lg btn-block">
                            <i class="fas fa-home mr-2"></i> Volver al Inicio</a>

                      </div>
                    </form>
                  </div> <!-- card-body -->
                </div> <!-- paper.card -->
              </div> <!-- login-stack -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </header>
</body>
</html>

<?php
 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      include 'db.php';

      $username = isset($_POST['username']) ? trim($_POST['username']) : '';
      $password = isset($_POST['password']) ? trim($_POST['password']) : '';

      if ($username !== '' && $password !== '') {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
          if ($password === $user['contrasenia']) {
            $_SESSION['logged_in'] = true;
            header("Location: admin-panel.php");
            exit;
          } else {
            $errorMessage = "Contraseña incorrecta.";
            $showPopup = true;
          }
        } else {
          $errorMessage = "Usuario no encontrado.";
          $showPopup = true;
        }
      } else {
        $errorMessage = "Por favor, completá todos los campos.";
        $showPopup = true;
      }
    }
  ?>


