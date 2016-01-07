{include file="head.tpl" title="Home"}

{if !$error}

<h2>Retinue List</h2>

{if $retinue_count < 1}

<p>You haven't created any retinues yet.</p>

{else}

<table>

<thead><tr>
	<th style="text-align:left">Retinue Name</th>
	<th style="text-align:left">Race</th>
	<th style="text-align:right">Figures</th>
	<th style="text-align:right">Points</th>
	<th style="text-align:center">Public</th>
</tr></thead>

<tbody>
{foreach from=$retinues item=retinue}<tr>
	{assign var=race value=$retinue->getRace()}
	<td style="text-align:left"><a href="/edit_retinue?id={$retinue->id|escape}">{$retinue->name|escape}</a></td>
	<td style="text-align:left">{$race->name|escape}</td>
	<td style="text-align:right">{$retinue->getFigureCount()|escape}</td>
	<td style="text-align:right">{$retinue->getCost()|escape}</td>
	<td style="text-align:center">{if $retinue->public}Yes{else}No{/if}</td>
</tr>{/foreach}</tbody>

</table>
{/if}

<h2>Create a new Retinue</h2>

{assign var=retinue value=false}

{include file="create-retinue-form.tpl"}

{if $figure_count > 0}

<h2>Figure Roster</h2>

{include file="figure-list.tpl" figures=$figures}

{/if}

{/if}

{include file="foot.tpl"}
