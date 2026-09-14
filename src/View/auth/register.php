<div class="auth-page">
    <div class="auth-page__form">
        <h1>Inscription</h1>

        <form method="POST" action="index.php?controller=auth&action=register">
            <div class="field">
                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                <?php if (!empty($errors['username'])): ?>
                    <p class="field-error"><?= htmlspecialchars($errors['username']) ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                <?php if (!empty($errors['email'])): ?>
                    <p class="field-error"><?= htmlspecialchars($errors['email']) ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password">
                <?php if (!empty($errors['password'])): ?>
                    <p class="field-error"><?= htmlspecialchars($errors['password']) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn--primary btn--block">S'inscrire</button>
        </form>

        <p class="auth-page__switch">Déjà inscrit ? <a href="index.php?controller=auth&action=login">Connectez-vous</a></p>
    </div>

    <figure class="auth-page__media">
        <img src="assets/images/mask-group-2.png" alt="Bibliothèque remplie de livres">
    </figure>
</div>