<?php if($login_message){ ?>
<p><?= $login_message ?></p>
<?php } ?>

<form action="." method="post">
    <input type="hidden" name="action" value="login">
    <div>
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="text" name="password" required>
        <br>
        <input type="submit" value="Login" class="button blue">
        <br>
    </div>
</form>


