{capture assign=title}
Edit Figure | {$figure->name} {* don't escape as it will be escaped in head.tpl *}
{/capture}
{include file="head.tpl" title=$title}

{if $updated}
	<p>Figure has been updated.</p>
{/if}

<form action="/edit_figure" method="post">
	<input type="hidden" name="figure" value="{$figure->id|escape}" />

	{include file="figure-form.tpl"}

	<p><input type="submit" value="Save Changes" /></p>
</form>

{include file="foot.tpl"}