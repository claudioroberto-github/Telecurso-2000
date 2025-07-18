<?php
if (!is_dir('config/img_user')) {
    mkdir('config/img_user', 0777, true);
}
session_start();
include_once('assets/config/config.php');

if (isset($_POST['submit'])) {

    // Coleta os dados do formulário
    $user = $_POST['user'];
    $company = $_POST['company'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $dwelling = $_POST['dwelling'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $birth = $_POST['birth'];
    $password = $_POST['passwords'];

    // Verifica e faz upload da imagem
    if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
        $img_nome = $_FILES['img']['name'];
        $img_temp = $_FILES['img']['tmp_name'];
        $img_caminho = 'config/img_user/' . basename($img_nome);

        // Move imagem para a pasta
        if (move_uploaded_file($img_temp, $img_caminho)) {
            
        } else {
            echo "Erro ao mover imagem.<br>";
            exit;
        }
    } else {
        echo "Erro no upload da imagem.<br>";
        exit;
    }

    // Query SQL para inserir usuário
    $sql = "INSERT INTO usuarios (user, company, cnpj, email, telephone, dwelling, city, province, birth, img, passwords) 
            VALUES ('$user', '$company', '$cnpj', '$email', '$telephone', '$dwelling', '$city', '$province', '$birth', '$img_caminho', '$password')";

    if ($conexao->query($sql) === TRUE) {
        echo "<script>alert('Cadastro realizado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro: " . $conexao->error . "');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="assets/css/sign in/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
  <a href="index.php"><i id="back" class="fa-solid fa-arrow-left"></i></a>
  <div class="container">
    <div class="groupForm">
      <div class="buttonsForm">
        <div class="btnColor"></div>
        <button id="btnSignin" type="button">Sign in</button>
        <button id="btnSignup" type="button">Sign up</button>
      </div>
    </div>

    <form action="assets/config/testLogin.php" id="signin" method="POST">
      <input name="user" type="text" placeholder="Your User Name" required />
      <i class="fa-solid fa-user"></i>
      <input type="email" name="email" placeholder="Email" required />
      <i class="fas fa-envelope iEmail"></i>
      <input type="password" name="passwords" placeholder="Password" required />
      <i class="fas fa-lock iPassword"></i>
      <div class="divCheck">
        <input type="checkbox" require />
        <span>Remember Password</span>
      </div>
      <button type="submit" name="submit-login">Sign in</button>
    </form>

    <form id="signup" action="login.php" method="POST" enctype="multipart/form-data">
      <div class="inputs">
        <input name="user" type="text" placeholder="Your Name" required />
        <i class="fa-solid fa-user"></i>
        <input name="company" type="text" placeholder="The Company Name" required />
        <i class="fa-solid fa-briefcase"></i>
        <input name="cnpj" type="text" placeholder="The CNPJ" required />
        <i class="fa-solid fa-magnifying-glass-chart"></i>
        <input name="email" type="email" placeholder="Your Contact Email" required />
        <i class="fas fa-envelope"></i>
        <input name="telephone" type="text" placeholder="Your Contact of Telephone" required />
        <i class="fa-solid fa-phone"></i>
        <input name="dwelling" type="text" placeholder="Your address" required />
        <i class="fa-solid fa-location-dot"></i>
        <input name="city" type="text" placeholder="City" required />
        <i class="fa-solid fa-city"></i>
        <input name="province" type="text" placeholder="State" required />
        <i class="fa-solid fa-map-pin"></i>
        <input name="birth" type="date" placeholder="Date of Birth" required />
        <i class="fa-solid fa-calendar-days"></i>
        <input name="img" type="file" accept="image/*" required/>
        <i class="fa-solid fa-image"></i>
        <input name="passwords" type="password" placeholder="Create Your Password" required />
        <i class="fas fa-lock"></i>
        <input type="password" placeholder="Repeat your Password" required />
        <i class="fas fa-lock"></i>
      </div>
      <div class="divCheck">
        <input type="checkbox" required />
        <span>I agree to the <a href="#">Terms of Use and Conditions</a></span>
      </div>

      <div class="next-step"
        style="display: flex; align-items: center; justify-content:center; cursor:pointer; margin-top:20px;"
        id="next-step">
        <p style="margin-right:15px">Continue The Form</p>
        <button class="cart-button" style="border: none; background: none;" type="button">
          <span class="material-symbols-rounded">arrow_circle_right</span>
        </button>
      </div>

      <div class="display-colors-form"
        style="background: rgba(0,0,0,0.18); display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 1000; margin: 0; padding: 0; justify-content: center; align-items: center;">
        <div class="inputs" style="background: #f9fafb; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 32px 24px 24px 24px; display: flex; flex-direction: column; gap: 18px; max-width: 450px; min-width: 220px; align-items: center; max-height: 500px; overflow-y: auto; margin: 0 auto; position: relative;">
          <button class="close-step" style="background: none; border: none; cursor: pointer; position: absolute; top: 10px; right: 10px; font-size: 2rem;">
            <span class="material-symbols-rounded">close</span>
          </button>
          <div class="color" style="display: flex; flex-direction: column; align-items: center; width: 100%; margin-bottom: 8px;">
            <label for="cor1" style="width: 100%; text-align: center; font-size: 1.1rem; margin-bottom: 0.5rem;">Selecione uma cor para ser principal no sistema:</label>
            <input type="color" id="cor1" name="cor_principal" value="#f9fafb" style="width: 60px; height: 60px; border: #000 2px solid; border-radius: 50%; background: none; box-shadow: 0 1px 4px rgba(0,0,0,0.10); margin: 0.5rem auto 0.7rem auto; display: block; cursor: pointer; transition: box-shadow 0.2s;">
            <span id="color-coordinates1"></span>
          </div>
          <div class="color" style="display: flex; flex-direction: column; align-items: center; width: 100%; margin-bottom: 8px;">
            <label for="cor2" style="width: 100%; text-align: center; font-size: 1.1rem; margin-bottom: 0.5rem;">Selecione uma cor para ser secundaria no sistema:</label>
            <input type="color" id="cor2" name="cor_secundaria" value="#ECECFD" style="width: 60px; height: 60px; border: #000 2px solid; border-radius: 50%; background: none; box-shadow: 0 1px 4px rgba(0,0,0,0.10); margin: 0.5rem auto 0.7rem auto; display: block; cursor: pointer; transition: box-shadow 0.2s;">
            <span id="color-coordinates2"></span>
          </div>
          <div class="color" style="display: flex; flex-direction: column; align-items: center; width: 100%; margin-bottom: 8px;">
            <label for="cor3" style="width: 100%; text-align: center; font-size: 1.1rem; margin-bottom: 0.5rem;">Selecione uma cor para ser de fundo no sistema:</label>
            <input type="color" id="cor3" name="cor_fundo" value="#1F2936" style="width: 60px; height: 60px; border: #000 2px solid; border-radius: 50%; background: none; box-shadow: 0 1px 4px rgba(0,0,0,0.10); margin: 0.5rem auto 0.7rem auto; display: block; cursor: pointer; transition: box-shadow 0.2s;">
            <span id="color-coordinates3"></span>
          </div>
          <div class="color" style="display: flex; flex-direction: column; align-items: center; width: 100%; margin-bottom: 8px;">
            <label for="cor4" style="width: 100%; text-align: center; font-size: 1.1rem; margin-bottom: 0.5rem;">Selecione uma cor para ser de texto no sistema:</label>
            <input type="color" id="cor4" name="cor_texto" value="#3D4859" style="width: 60px; height: 60px; border: #000 2px solid; border-radius: 50%; background: none; box-shadow: 0 1px 4px rgba(0,0,0,0.10); margin: 0.5rem auto 0.7rem auto; display: block; cursor: pointer; transition: box-shadow 0.2s;">
            <span id="color-coordinates4"></span>
          </div>
          <div class="check-color" style="display: flex; align-items: center; gap: 8px; margin-top: 10px; margin-bottom: 0; width: 100%; justify-content: flex-start;">
            <input type="checkbox" required>
            <label style="font-size: 1rem; text-align: left; margin: 0;">Estou ciente das personalizações que fiz, e sei que podem ser modificadas mais tardes na aba Custom</label>
          </div>
        </div>
        <div class="result-color"
          style="background: #f9fafb; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 24px 16px; display: flex; flex-direction: column; gap: 12px; max-width: 450px; min-width: 220px; margin: 0 auto; align-items: center;max-height: 500px;">
          <div id="quadro-cor1"
            style="width: 100px; height: 50px; background-color: #f9fafb; border: #000 1px solid;"></div>
          <div id="quadro-cor2"
            style="width: 100px; height: 50px; background-color: #ECECFD; border: #000 1px solid;"></div>
          <div id="quadro-cor3"
            style="width: 100px; height: 50px; background-color: #1F2936; border: #000 1px solid;"></div>
          <div id="quadro-cor4"
            style="width: 100px; height: 50px; background-color: #3D4859; border: #000 1px solid;"></div>
        </div>
      </div>

      <button name="submit" type="submit">Sign up</button>
    </form>
  </div>

  <script src="assets/js/login/login.js"></script>
  <script>
    const caixa = document.querySelector('.display-colors-form');
    const onDisplay = document.getElementById('next-step');
    const closeDisplay = document.querySelector('.close-step');

    onDisplay.addEventListener('click', (e) => {
      e.preventDefault();
      caixa.style.display = 'flex';
    });
    closeDisplay.addEventListener('click', (e) => {
      e.preventDefault();
      caixa.style.display = 'none';
    });

    // Atualiza cada quadro de cor e texto ao mudar o input correspondente
    for (let i = 1; i <= 4; i++) {
      const inputCor = document.getElementById('cor' + i);
      const quadroCor = document.querySelectorAll('#quadro-cor' + i);
      const colorCoordinates = document.getElementById('color-coordinates' + i);
      if (inputCor) {
        inputCor.addEventListener('input', function () {
          // Atualiza todos os quadros de cor com o mesmo id (caso haja duplicidade)
          quadroCor.forEach(q => q.style.backgroundColor = this.value);
          if (colorCoordinates) {
            colorCoordinates.textContent = `Selected Color: ${this.value}`;
          }
        });
      }
    }
  </script>
</body>

</html>