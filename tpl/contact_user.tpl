{capture assign=title}
Contact User | {$contactee->username|escape|capitalize}
{/capture}
{include file="head.tpl" title=$title}

{if !$error}
	{if $message_sent}
		<p>Your message has been sent.</p>

	{else}
		<form action="/contact_user" method="post">
			<input type="hidden" name="id" value="{$contactee->username|escape}" />
			<fieldset>
			<legend>Contact User</legend>
			<p>Please enter your message below:</p>
			<textarea name="message">{$smarty.request.message|escape}</textarea>
			<p><input type="submit" value="Send Message" /></p>
			</fieldset>
		</form>
	{/if}
{/if}

{include file="foot.tpl"}