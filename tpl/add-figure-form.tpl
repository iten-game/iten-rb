<form action="/add_existing_figure" method="post">
<input type="hidden" name="retinue" value="{$retinue->id|escape}" />
<fieldset>
<legend>Add Existing Figure</legend>
<p>
	<label for="existing">Select existing figure:</label>
	{assign var="figures" value=$user->getFigures()}
	<select name="figure" id="existing">
		<option value="">Select:</option>
		{foreach from=$figures item=figure}
			{if $figure->canJoin($retinue)}
				<option value="{$figure->id|escape}">
					{$figure->name|escape}
					({$figure->getCost($retinue)|escape}pts)
				</option>
			{/if}
		{/foreach}
	</select>
</p>
{assign var=race value=$retinue->getRace()}
<p><em>Figures that are not from the "{$race->name|escape}" retinue list will automatically be given the "Strange Ally" special ability if needed.</em></p>

<p><input type="submit" value="Add Figure" /></p>

</fieldset>
</form>

<form action="/add_figure" method="post">
<input type="hidden" name="retinue" value="{$retinue->id|escape}" />
<fieldset>
<legend>Add New Figure</legend>

{include file="figure-form.tpl"}

<p><input type="submit" value="Add Figure" /></p>
</fieldset>
</form>