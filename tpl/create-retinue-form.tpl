<form action="create_retinue" method="post">
<fieldset>
<legend>Create Retinue</legend>

<p><label for="name">Retinue Name:</label> <input name="name" id="name" value="{$smarty.request.name|escape}" placeholder="e.g. {$user->username|escape|capitalize}'s Ultramarines" /></p>
<p><label for="race">Race:</label> <select name="race" id="race">
<option value="">Select:</option>
{assign var=races value=$RB->getRaces()}
{foreach from=$races item=race}
<option value="{$race->id|escape}" {if $smarty.request.race == $race->id}selected="selected"{/if}>{$race->name|escape}</option>
{/foreach}
</select></p>

<p><input type="submit" value="Create Retinue" /></p>

</fieldset>
</form>
