<?php if (array_key_exists('ERROR', $data)) : ?>
<?=$data['ERROR']['username'] ?? ''?>
<?='<br>'?>
<?=$data['ERROR']['password'] ?? ''?>
<?='<br>'?>
<?=$data['ERROR']['email'] ?? ''?>
<?php endif?>

<div style="display: flex; width: 100%; height: 100vh; align-items: center; justify-content: center;">
    <form action="/register" method="POST" style="display: flex; flex-direction: column; width: 15rem; height: 20rem; border-style: solid; border-width: 2px; border-color: black; padding: 1rem">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required />

        <button type="submit" style="margin: auto 0">Register</button>
        <a type="button" href="/login">Already have an account? Login.</a>
    </form>
</div>