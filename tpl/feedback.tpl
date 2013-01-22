{include file="head.tpl" title="Submit Feedback"}

{if !$error}
	{if $message_sent}
		<p>Your message has been sent.</p>

	{else}
		<form action="/feedback" method="post">
			<fieldset>
			<legend>Submit Feedback</legend>
			<p>Please enter your message below:</p>
			<textarea name="message">{$smarty.request.message|escape}</textarea>
			<p><input type="submit" value="Submit Feedback" /></p>
			</fieldset>
		</form>
	{/if}
{/if}

{include file="foot.tpl"}