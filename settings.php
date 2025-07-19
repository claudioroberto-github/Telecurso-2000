<?php

session_start();
include_once('assets/config/config.php');

$id_usuario = $_SESSION['id']; // pega o id do usuário logado
// Buscar a imagem do usuário logado
$sql_img = "SELECT img FROM usuarios WHERE id = ?";
$stmt = $conexao->prepare($sql_img);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result_img = $stmt->get_result();
$imagem_usuario = 'assets/imgs/default_user.png'; // imagem padrão, se não tiver

if ($result_img && $row_img = $result_img->fetch_assoc()) {
    if (!empty($row_img['img'])) {
        $imagem_usuario = $row_img['img'];
    }
}

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
  header('Location: /Telecurso-2000/login.php');
  unset($_SESSION['email']);
  unset($_SESSION['passwords']);
}
$logged = $_SESSION['user'];

// Muda os dados do usuário direto no banco de dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['user']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Atualiza o usuário no banco de dados
    $sql_update = "UPDATE usuarios SET user = ?, email = ?";
    if (!empty($password)) {
        $sql_update .= ", passwords = ?";
    }
    $sql_update .= " WHERE id = ?";
    
    $stmt_update = $conexao->prepare($sql_update);
    
    if (!empty($password)) {
        $stmt_update->bind_param("sssi", $user, $email, $password, $id_usuario);
    } else {
        $stmt_update->bind_param("ssi", $user, $email, $id_usuario);
    }
    
    if ($stmt_update->execute()) {
        $_SESSION['user'] = $user; // Atualiza a sessão
        $_SESSION['email'] = $email; // Atualiza o email na sessão
        header('Location: settings.php?success=1');
        exit();
    } else {
        header('Location: settings.php?error=1');
        exit();
    }
}
// Muda a imagem do usuário
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['profile_picture']['tmp_name'];
    $file_name = $_FILES['profile_picture']['name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_new_name = "profile_" . $id_usuario . "." . $file_ext;

    // Move o arquivo para a pasta de imagens
    if (move_uploaded_file($file_tmp, "assets/imgs/" . $file_new_name)) {
        // Atualiza o caminho da imagem no banco de dados
        $sql_update_img = "UPDATE usuarios SET img = ? WHERE id = ?";
        $stmt_update_img = $conexao->prepare($sql_update_img);
        $stmt_update_img->bind_param("si", $file_new_name, $id_usuario);
        $stmt_update_img->execute();
    }
}
// Verifica se houve sucesso na atualização da imagem
if (isset($_GET['success'])) {
    echo "<script>alert('Dados ou imagem atualizados com sucesso!');</script>";
}
if (isset($_GET['error'])) {
    echo "<script>alert('Erro ao atualizar os dados ou imagem. Tente novamente.');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Settings</title>
  <link rel="stylesheet" href="assets/css/home/home.css " />
  <link rel="stylesheet" href="assets/css/menu/styles-loja.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
      <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar collapsed">
      <!-- Sidebar header -->
      <div class="sidebar-header">
        <img src="<?php echo htmlspecialchars($imagem_usuario); ?>" alt="Foto do Usuário" class="header-logo" />
        <button class="sidebar-toggle">
          <span class="material-symbols-rounded">chevron_left</span>
        </button>
      </div>
      <div class="sidebar-content">
        <p class="user-name">Welcome <b><?php echo htmlspecialchars($logged); ?></b></p>
        <!-- Search Form -->
        <form action="#" class="search-form">
          <span class="material-symbols-rounded">search</span>
          <input type="search" placeholder="Search..." required />
        </form>
        <!-- Sidebar Menu -->
        <ul class="menu-list">

          <li class="menu-item">
            <a href="home.php" class="menu-link">
              <span class="material-symbols-rounded">home</span>
              <span class="menu-label">Home</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="menu.php" class="menu-link">
              <span class="material-symbols-rounded">room_service</span>
              <span class="menu-label">Menu</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="products.php" class="menu-link">
              <span class="material-symbols-rounded" aria-label="Products">storefront</span>
              <span class="menu-label">Products</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">notifications</span>
              <span class="menu-label">Notifications</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">star</span>
              <span class="menu-label">Favourites</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">group</span>
              <span class="menu-label">Customers</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">settings</span>
              <span class="menu-label">Settings</span>
            </a>
          </li>
          
        </ul>
      </div>
      <!-- Sidebar Footer -->
      <div class="sidebar-footer">
        <li class="menu-item" style="list-style: none;">
            <a href="assets/config/logOut.php" class="logout">
              <span class="material-symbols-rounded">logout</span>
              <span class="menu-label">Log Out</span>
            </a>
          </li>
      </div>
    </aside>
    <main class="main-content" style="padding: 20px; display: flex; flex-direction: row; align-items: center; justify-content: center;">

      <div class="settings-container">
        <h1>Settings</h1>
        <form action="/Telecurso-2000/assets/config/update_settings.php" method="POST" enctype="multipart/form-data">
          <label for="user">Username:</label>
          <input type="text" id="user" name="user" value="<?php echo htmlspecialchars($logged); ?>" required />

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required />

          <label for="password">New Password:</label>
          <input type="password" id="password" name="password" placeholder="Leave blank to keep current password" />

          <button type="submit">Update Settings</button>
        </form>
      </div>
      <div class="settings-container">
        <!-- Css formulario inteiro -->
        <style>
          .settings-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(61,72,89,0.10);
            padding: 32px 28px 24px 28px;
            margin: 32px auto;
            max-width: 420px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 18px;
            align-items: center;
          }
          .settings-container h1, .settings-container h2, .settings-container h3 {
            color: #222b38;
            font-weight: 700;
            margin-bottom: 18px;
            text-align: center;
          }
          .settings-container label {
            font-size: 1.05rem;
            color: #3D4859;
            margin-bottom: 6px;
            font-weight: 500;
            align-self: flex-start;
          }
          .settings-container input[type="text"],
          .settings-container input[type="email"],
          .settings-container input[type="password"],
          .settings-container input[type="file"] {
            padding: 10px 12px;
            border: 1px solid #e6eaf0;
            border-radius: 8px;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 12px;
            background: #f7f9fb;
          }
          .settings-container button[type="submit"] {
            background: #3D4859;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            font-size: 1.08rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 8px;
          }
          .settings-container button[type="submit"]:hover {
            background: #222b38;
          }
          .current-picture {
            display: flex;
            flex-direction: column;
            margin-top: 18px;
            text-align: center;
            object-fit: cover;
            background: #f7f9fb;
            /* quero que a imagem esteja centralizada e preencha todo o espaço, com o tamanho proporcional */
            display: flex;
            justify-content: center;
            align-items: center;


          }
          .current-picture img {
            box-shadow: 0 2px 10px rgba(61,72,89,0.10);
            margin-top: 8px;
            height: 120px;
            aspect-ratio: 16/9;
            
            border-radius: 8px;
          }
          @media screen and (max-width: 768px) {
            main {
              flex-direction: column;
              align-items: center;
              padding: 20px;
            }
            .settings-container {
              padding: 24px 20px 20px 20px;
              margin: 24px auto;
              max-width: 100%;
            }
            .settings-container h1, .settings-container h2, .settings-container h3 {
              font-size: 1.5rem;
            }
            .settings-container label {
              font-size: 0.9rem;
            }
            .settings-container input[type="text"],
            .settings-container input[type="email"],
            .settings-container input[type="password"],
            .settings-container input[type="file"] {
              font-size: 0.9rem;
            }
            .settings-container button[type="submit"] {
              font-size: 0.9rem;
            }
          }
          
        </style>
        <h2>Change Profile Picture</h2>
        <form action="assets/config/update_settings.php" method="POST" enctype="multipart/form-data">
          <label for="profile_picture">Upload New Picture:</label>
          <input type="file" id="profile_picture" name="profile_picture" accept="image/*" />
          <button type="submit">Change Picture</button>
        </form>
        <div class="current-picture">
          <h3>Current Profile Picture:</h3>
          <img src="<?php echo htmlspecialchars($imagem_usuario); ?>" alt="Current Profile Picture" />
        </div>
      </div>
    </main>
  </div>
  <script src="assets/js/home/home.js"></script>
</body>
</html>