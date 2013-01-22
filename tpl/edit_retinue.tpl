{capture assign="title"}View Retinue | {$retinue->name}{/capture}

{include file="head.tpl" title=$title}

{if !$error}

{if $updated}<p>Retinue has been updated.</p>{/if}

<fieldset>
<legend>Retinue Details</legend>

<form action="/edit_retinue" method="post">
	<input type="hidden" name="id" value="{$retinue->id|escape}" />
	<p><label for="name">Name:</label> <input type="text" name="name" id="name" value="{$retinue->name|escape}" /></p>
	{assign var=race value=$retinue->getRace()}
	<p>Faction: {$race->name|escape}</p>
	<p><label for="public">Public:</label> <input type="checkbox" name="public" {if $retinue->public}checked="checked"{/if} /></p>
	{if $retinue->public}
		<p><em>Permalink:</em></p>
		<ul><li><a href="/view_retinue?id={$retinue->id|escape}">http://{$smarty.server.SERVER_NAME|escape}/view_retinue?id={$retinue->id|escape}</a></li></ul>
	{/if}
	<p><label for="notes">Notes:</label></p>
	<textarea name="notes">{$retinue->notes|escape}</textarea>
	<p><input type="submit" value="Save Changes" /></p>
</form>
</fieldset>

<fieldset>
<legend>Other Actions</legend>
<form action="/clone_retinue" method="post">
	<input type="hidden" name="retinue" value="{$retinue->id|escape}" />
	<p><input type="submit" value="Clone Retinue" /> - create a copy of this retinue.</p>
</form>

<form action="/delete_retinue" method="post">
	<input type="hidden" name="id" value="{$retinue->id|escape}" />
	<p><input type="submit" value="Delete Retinue" /></p>
</form>
</fieldset>

<fieldset>
<legend>Figures</legend>
{assign var=count value=$retinue->getFigureCount()}
{if $count < 1}

	<p>This retinue is empty. Start by adding a figure!</p>

{else}

	{include file="figure-list.tpl" figures=$retinue->getFigures() retinue=$retinue}

	<p><a href="/view_retinue?id={$retinue->id|escape}&amp;printable=1">Printable version</a></p>

{/if}
</fieldset>

<fieldset>
<legend>Add a Figure</legend>

{include file="add-figure-form.tpl"}

</fieldset>

{/if}

{include file="foot.tpl"}