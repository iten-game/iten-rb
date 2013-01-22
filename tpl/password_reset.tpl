{include file="head.tpl" title="Reset Password"}

{if $password_updated}
<p>A new password has been set to the owner of that account.</p>

{include file="login-form.tpl"}

{/if}

{if !$error && !$password_updated}

<p>Please enter one or both of the fields below and click the "Reset Password" button. A new password will be emailed to your account.</p>

<form action="/password_reset" method="post">

<fieldset>
<legend>Reset Password</legend>

<p><label for="email">Email address:</label> <input type="email" name="email" id="email" value="{$smarty.request.email|escape}" /></p>
<p>and/or</p>
<p><label for="username">Username:</label> <input type="text" name="username" id="username" value="{$smarty.request.username|escape}" /></p>

<p><input type="submit" value="Reset Password" /></p>
</fieldset>

</form>

{/if}

{include file="foot.tpl"}