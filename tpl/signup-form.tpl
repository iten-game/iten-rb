<form action="/signup" method="post">
<fieldset>
<legend>Create Account</legend>

<p><label for="email">Email Address:</label> <input name="email" type="email" id="email" value="{$smarty.request.email|escape}" /></p>
<p><label for="username">Username:</label> <input name="username" id="username" value="{$smarty.request.username|escape}" /></p>

<p><em>An activation link and your new account password will be emailed to the email address you provide.</em></p>

<p><input type="submit" value="Create Account" /></p>

</fieldset>
</form>
