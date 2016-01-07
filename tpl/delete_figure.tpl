{include file="head.tpl" title="Delete Figure"}

{if !$error}

<p>Are you sure you want to delete this figure?</p>

{include file="figure-list.tpl" figures=$figures delete_confirm=$delete_confirm}

{if $figure->linked()}

<p>This figure is a member of the following retinues:</p>

{assign var=retinues value=$figure->getRetinues()}
<ul>{foreach from=$retinues item=retinue}
	<li><a href="/edit_retinue?id={$retinue->id|escape}">{$retinue->name|escape}</a></li>
{/foreach}</ul>

{/if}

<form action="/delete_figure" method="post">
<input type="hidden" name="confirm" value="true" />
<input type="hidden" name="figure" value="{$figure->id|escape}" />
<p><input type="submit" value="Confirm Deletion" /></p>
</form>

{/if}

{include file="foot.tpl"}