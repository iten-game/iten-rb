{include file="head.tpl" title="Delete Retinue"}

{if !$error}

<p>Are you sure you want to delete your retinue '{$retinue->name|escape}'?</p>

<p>Note that any figures linked to this retinue will not be deleted.</p>

<form action="/delete_retinue" method="post">
<input type="hidden" name="confirm" value="true" />
<input type="hidden" name="id" value="{$retinue->id|escape}" />
<p><input type="submit" value="Confirm Deletion" /></p>
</form>

{/if}

{include file="foot.tpl"}