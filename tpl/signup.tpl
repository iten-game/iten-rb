{include file="head.tpl" title="Create Account"}

{if $error || !$registered}
	{include file="signup-form.tpl"}

{else}
	<p>Success! You will shortly receive an email with an activation link.</p>

{/if}

{include file="foot.tpl"}
