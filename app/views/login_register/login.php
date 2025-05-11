<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="login_register-assets/style.css">
</head>
<body>
  <div class="wrapper">
    <form action="" method="POST"> <!-- Goes to the same file its already in (login_index.php) and then executes the Login() method -->
      <h2>Connexion</h2>
      <div class="input-field">
        <input type="email" name="email" required>
        <label>Entrez votre email</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Entrez votre mot de passe</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember" name="remember">
          <p>Se souvenir de moi</p>
        </label>
        <a href="#" style="color: yellowgreen;"><strong>Mot de passe oublié ?</strong></a>
      </div>
      <button type="submit">Se connecter</button>
      <div class="register">
        <p>Vous n'avez pas encore de compte ? <a style="color: yellowgreen;" href="register.php"><strong>S'inscrire</strong></a></p>
      </div>
    </form>
  </div>
</body>
</html>