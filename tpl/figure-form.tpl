<table>

<tr>
<td width="20%">Attributes</td>
<td width="20%">Weapons</td>
<td width="20%">Equipment</td>
<td width="20%">Special Abilities</td>
<td width="20%">Psyker Powers</td>
</tr>

<tr>

<td width="20%" valign="top">

<p><label for="name">Name:</label> <input type="text" name="name" id="name" value="{$smarty.request.name|escape}" placeholder="eg Inquisitor Cryptmann" /></p>

<p><label for="notes">Notes:</label> <input type="text" name="notes" id="notes" value="{$smarty.request.notes|escape}" /></p>

<p><label for="grit">Grit:</label> <input type="number" name="grit" id="grit" value="{$smarty.request.grit|escape|default:6}" min="2" max="6" /></p>

<p><label for="fv">FV:</label> <input type="number" name="fv" id="fv" value="{$smarty.request.fv|escape|default:0}" min="0" max="10" /></p>

<p><label for="sv">SV:</label> <input type="number" name="sv" id="sv" value="{$smarty.request.sv|escape|default:0}" min="0" max="10" /></p>

<p><label for="speed">Speed:</label> <input type="number" name="speed" id="speed" value="{$smarty.request.speed|escape|default:0}" min="0" max="10" /></p>

<p><label for="leader">Leader:</label> <input type="checkbox" name="leader" id="leader" {if $smarty.request.leader != ''}checked="checked"{/if} /></p>

<p><label for="armour">Armour:</label> <select name="armour" id="armour">
	{assign var=armour value=$RB->getArmour()}
	{foreach from=$armour item=this}
		<option value="{$this->id|escape}"
		{if $this->id == $smarty.request.armour}
			selected="selected"
		{/if}
		>
		{$this->name|escape} ({$this->to_hit|escape}+ to hit, {$this->getCost()|escape}pts)
		</option>
	{/foreach}
</select></p>

</td><td width="20%" valign="top">

<select name="weapons[]" id="weapons" multiple="multiple" size="20">
	{assign var=weapons value=$RB->getWeapons()}
	{foreach from=$weapons item=weapon}
		<option value="{$weapon->id|escape}"
		{if isset($smarty.request.weapons) && in_array($weapon->id, $smarty.request.weapons)}selected="selected"{/if}
		>
		{$weapon->name|escape} ({$weapon->getCost()|escape}pts)
		</option>
	{/foreach}
</select>

</td><td width="20%" valign="top">

<select name="equipment[]" id="equipment" multiple="multiple" size="20">
	{assign var=equipment value=$RB->getEquipment()}
	{foreach from=$equipment item=item}
		<option value="{$item->id|escape}"
			{if isset($smarty.request.equipment) && in_array($item->id, $smarty.request.equipment)}selected="selected"{/if}
		>
		{$item->name|escape} ({$item->getCost()|escape}pts)
		</option>
	{/foreach}
</select>


</td><td width="20%" valign="top">

<select name="abilities[]" id="abilities" multiple="multiple" size="20">
	{assign var=abilities value=$RB->getSpecialAbilities()}
	{foreach from=$abilities item=ability}
		<option value="{$ability->id|escape}"
		{if isset($smarty.request.abilities) && in_array($ability->id, $smarty.request.abilities)}selected="selected"{/if}
		>
		{$ability->name|escape} ({$ability->getCost()|escape}pts)
		</option>
	{/foreach}
</select>

</td><td width="20%" valign="top">

<select name="powers[]" id="powers" multiple="multiple" size="20">
	{assign var=powers value=$RB->getPsykerPowers()}
	{foreach from=$powers item=power}
		<option value="{$power->id|escape}"
		{if isset($smarty.request.powers) && in_array($power->id, $smarty.request.powers)}selected="selected"{/if}
		>
		{$power->name|escape} ({$power->getCost()|escape}pts)
		</option>
	{/foreach}
</select>

</td></tr>

</table>
