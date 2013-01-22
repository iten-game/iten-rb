
<table id="figure-list">
	<thead><tr>
		<th class="fl-name">Name</th>
		<th class="fl-grit">Grit</th>
		<th class="fl-fv">FV</th>
		<th class="fl-sv">SV</th>
		<th class="fl-speed">Speed</th>
		<th class="fl-cost">Points</th>
		<th class="fl-notes">Notes</th>
		{if !$delete_confirm && !$printable}<th class="fl-actions">Actions</th>{/if}
		{if !$read_only && !$retinue}<th class="fl-inuse">In Use?</th>{/if}
	</tr></thead>
	<tbody>{foreach from=$figures item=figure}<tr>
		<td class="fl-name">
			{$figure->name|escape}
			{assign var=race value=$figure->getRace()}
			{if $retinue}
				{if $retinue->race != $race->id}
					<br/><em>({$race->name|escape})</em>
				{/if}
			{else}
				<br/><em>({$race->name|escape})</em>
			{/if}
		</td>
		<td class="fl-grit">{$figure->grit}+</td>
		<td class="fl-fv">+{$figure->fv}</td>
		<td class="fl-sv">+{$figure->sv}</td>
		<td class="fl-speed">+{$figure->s}</td>
		{if $retinue}
			<td class="fl-cost">{$figure->getCost($retinue)}</td>
		{else}
			<td class="fl-cost">{$figure->getCost()}</td>
		{/if}
		<td class="fl-notes">
			{if $figure->leader}Leader.{/if}

			{assign var=armour value=$figure->getArmour()}
			{$armour->name|escape} ({$armour->to_hit}+ to hit).

			{assign var=weapons value=$figure->getWeapons()}
			{foreach from=$weapons item=weapon}{$weapon->name} ({$weapon->getCost()|escape}pts). {/foreach}

			{assign var=abilities value=$figure->getSpecialAbilities($retinue)}
			{foreach from=$abilities item=ability}{$ability->name} ({$ability->getCost($figure)|escape}pts). {/foreach}

			{assign var=powers value=$figure->getPsykerPowers()}
			{foreach from=$powers item=power}{$power->name} ({$power->getCost($figure)|escape}pts). {/foreach}

			{$figure->notes|escape}
		</td>
		{if !$delete_confirm && !$printable}<td class="fl-actions">
			{if $read_only}
				{if $user}
					{if $user->id != $retinue->user}
						<form action="/clone_figure" method="post">
							<input type="hidden" name="figure" value="{$figure->id}" />
							<input type="submit" value="Clone" />
						</form>
					{/if}
				{else}
					(not logged in)
				{/if}
			{else}
				{if $user->id == $figure->user}
					<form action="/edit_figure" method="get">
						<input type="hidden" name="figure" value="{$figure->id}" />
						<input type="submit" value="Edit" />
					</form>
				{/if}
				<form action="/clone_figure" method="post">
					<input type="hidden" name="figure" value="{$figure->id}" />
					{if $retinue}
						<input type="hidden" name="retinue" value="{$retinue->id}" />
					{/if}
					<input type="submit" value="Clone" />
				</form>
				{if $retinue}
					<form action="/remove_figure" method="post">
						<input type="hidden" name="retinue" value="{$retinue->id}" />
						<input type="hidden" name="figure" value="{$figure->id}" />
						<input type="submit" value="Remove" />
					</form>
				{else}
					<form action="/delete_figure" method="post">
						<input type="hidden" name="figure" value="{$figure->id}" />
						<input type="submit" value="Delete" />
					</form>
				{/if}
			{/if}
		</td>{/if}
		{if !$read_only && !$retinue}<td class="fl-inuse">{if $figure->linked()}Yes{else}No{/if}</td>{/if}
	</tr>{/foreach}</tbody>
	{if $retinue}
		<tfoot><tr>
			<td colspan="5" style="text:align:right;font-weight:bold">Total:</td>
			<td class="fl-cost" style="font-weight:bold">{$retinue->getCost()}</td>
		</tr></tfoot>
	{/if}
</table>
