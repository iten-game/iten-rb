{include file="head.tpl" title="Public Retinue Lists"}

<table>
	<thead>
		<th style="text-align:left">Name</th>
		<th style="text-align:center">Faction</th>
		<th style="text-align:right">Figures</th>
		<th style="text-align:right">Points</th>
		<th style="text-align:center">Last Updated</th>
		<th style="text-align:center">Creator</th>
	</thead>
	<tbody>{foreach from=$retinues item=retinue}<tr>
		{assign var=race value=$retinue->getRace()}
		{assign var=user value=$retinue->getCreator()}
		<td style="text-align:left"><a href="/view_retinue?id={$retinue->id|escape}">{$retinue->name|escape}</td>
		<td style="text-align:center">{$race->name|escape}</td>
		<td style="text-align:right">{$retinue->getFigureCount()|escape}</td>
		<td style="text-align:right">{$retinue->getCost()|escape}</td>
		<td style="text-align:center">{$retinue->updated|date_format:"%A, %B %e"}</td>
		<td style="text-align:center">{$user->username|capitalize}</td>
	</tr>{/foreach}</tbody>
</table>

{include file="foot.tpl"}