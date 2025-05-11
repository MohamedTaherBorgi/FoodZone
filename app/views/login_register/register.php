<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="login_register-assets/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="wrapper">
    <form action="register_index.php" method="post"> <!-- Goes to the same file its already in (register_index.php) and then executes the Register() method -->
      <h2>Inscription</h2>

      <div class="input-field">
        <input type="text" name="nom" required>
        <label>Entrez votre nom</label>
      </div>

      <div class="input-field">
        <input type="text" name="prenom" required>
        <label>Entrez votre prénom</label>
      </div>

      <div class="input-field">
        <input type="email" name="email" required>
        <label>Entrez votre email</label>
      </div>

      <div class="input-field">
        <input type="password" name="password" required>
        <label>Entrez votre mot de passe</label>
      </div>

      <div class="input-field">
        <input type="password" name="confirm_password" required>
        <label>Confirmez votre mot de passe</label>
      </div>

      <!-- Role Selection -->
      <div class="input-field">
        <select name="role" required hidden>
          <option value="" disabled selected>Choisissez un rôle</option>
          <option value="client" selected>Client</option>
          <option value="admin">Admin</option>
          <option value="livreur">Livreur</option>
        </select>
      </di>

      <button type="submit">S'inscrire</button>

      <div class="register">
        <p>Vous avez déjà un compte ? <a style="color: yellowgreen;" href="#"><strong>Se connecter</strong></a></p>
      </div>
    </form>
  </div>

  <script>
    // Listen for form submission
    document.querySelector('form').addEventListener('submit', function(e) {
      const password = document.querySelector('input[name="password"]').value;
      const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

      // Check if passwords match
      if (password !== confirmPassword) {
        e.preventDefault(); // Stop form submission

        // Show SweetAlert if passwords don't match
        Swal.fire({
          title: 'Erreur',
          text: 'Les mots de passe ne correspondent pas.',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    });
  </script>

</body>
</html>
