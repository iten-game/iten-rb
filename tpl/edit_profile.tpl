{include file="head.tpl" title="Edit Profile"}

{if $updated}
<p>Your profile has been updated.</p>
{/if}

<form action="/edit_profile" method="post">

<p>To make changes to your account, please enter your password:</p>
<p><label for="password">Password:</label> <input type="password" name="password" id="password" /></p>

<fieldset>
<legend>Email Address</legend>
<p><label for="email">Email address:</label> <input type="email" name="email" id="email" value="{$user->email|escape}" /></p>
</fieldset>

<fieldset>
<legend>Privacy</legend>
<p><label for="allow_emails">Allow other users to send you messages:</label> <input type="checkbox" name="allow_emails" id="allow_emails" {if $user->allow_emails}checked="checked"{/if} /></p>
</fieldset>

<fieldset>
<legend>Password</legend>
<p><label for="password1">New Password:</label> <input type="password" name="password1" id="password1" value="" /></p>
<p><label for="password2">Confirm Password:</label> <input type="password" name="password2" id="password2" value="" /></p>
</fieldset>

<p><input type="submit" value="Save Changes" /></p>

</form>

{include file="foot.tpl"}