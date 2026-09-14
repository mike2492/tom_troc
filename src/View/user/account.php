<h1>Mon compte</h1>

<h2>Vos informations personnelles</h2>

<form action="index.php?controller=user&action=account" method="POST">
    <label for="email">Adresse email</label>
    <input type="email" name="email" id="email" value="<?= $user->getEmail(); ?>">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">

    <label for="username">Pseudo</label>
    <input type="text" name="username" id="username" value="<?= $user->getUsername(); ?>">
</form>