<form action="/login" method="post">

<fieldset>
<legend>Log In</legend>

<p><label for="username">Username:</label> <input name="username" id="username" value="{$smarty.request.username|escape}" /></p>
<p><label for="password">Password:</label> <input type="password" name="password" id="password" /></p>

<p><input type="submit" value="Log In" /></p>

<p><a href="/password_reset">Forgot your username or password?</a></p>

</fieldset>
</form>