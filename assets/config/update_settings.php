<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['id'])) {
    header('Location: /Telecurso-2000/login.php');
    exit();
}

$userId = $_SESSION['id'];
$response = [];

// Atualiza dados do usuário (nome, email, senha)
if (isset($_POST['user']) && isset($_POST['email'])) {
    $user = trim($_POST['user']);
    $email = trim($_POST['email']);
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    $sql = "UPDATE usuarios SET user = ?, email = ?";
    $params = [$user, $email];
    $types = "ss";
    if (!empty($password)) {
        $sql .= ", passwords = ?";
        $params[] = $password;
        $types .= "s";
    }
    $sql .= " WHERE id = ?";
    $params[] = $userId;
    $types .= "i";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        $_SESSION['user'] = $user;
        $_SESSION['email'] = $email;
        $response['success'] = 'Dados atualizados com sucesso!';
    } else {
        $response['error'] = 'Erro ao atualizar os dados.';
    }
    $stmt->close();
}

// Atualiza foto de perfil
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $img = $_FILES['profile_picture'];
    $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
    $newName = 'user_' . $userId . '_' . time() . '.' . $ext;
    $uploadDir = dirname(__DIR__) . '/imgs/';
    $webDir = 'assets/imgs/';
    // Garante que a pasta existe
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $uploadPath = $uploadDir . $newName;
    if (move_uploaded_file($img['tmp_name'], $uploadPath)) {
        $imgPath = $webDir . $newName;
        // Confirma se o arquivo existe após upload
        if (file_exists($uploadPath)) {
            $sql = "UPDATE usuarios SET img = ? WHERE id = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param('si', $imgPath, $userId);
            if ($stmt->execute()) {
                $response['success'] = 'Imagem atualizada com sucesso!';
            } else {
                $response['error'] = 'Erro ao atualizar a imagem: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $response['error'] = 'Upload aparentemente bem-sucedido, mas arquivo não encontrado: ' . $uploadPath;
        }
    } else {
        $response['error'] = 'Erro ao salvar a imagem. Caminho: ' . $uploadPath;
    }
}

// Redireciona com mensagem
if (isset($response['success'])) {
    header('Location: /Telecurso-2000/settings.php?success=1');
    exit();
} elseif (isset($response['error'])) {
    header('Location: /Telecurso-2000/settings.php?error=1');
    exit();
} else {
    header('Location: /Telecurso-2000/settings.php');
    exit();
}
?>
