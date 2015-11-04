<!HTML>
<head>
<title>Weapons</title>
<style>{literal}
td,th {
text-align:center;
white-space:nowrap;
}
{/literal}</style>
</head>
<body>
<table style="width:100%">
<thead><tr>
<th style="text-align:left">Weapon</th>
<th>Type</th>
<th>Range</th>
<th>Combat<br/>Bonus</th>
<th>Grit<br/>Penalty</th>
<th>Cost</th>
</tr></thead>

<tbody>{foreach from=$weapons item=weapon}
	<tr>
		<td style="text-align:left">{$weapon->name|escape}</td>
		<td>{$weapon->type|escape}</td>
		<td>{if $weapon->range < 0}-{else}{$weapon->range|escape}&quot;{/if}</td>
		<td>{if $weapon->bonus < 1}0{else}+{$weapon->bonus|escape}{/if}</td>
		<td>{if $weapon->grit_penalty < 1}-{else}-{$weapon->grit_penalty|escape}{/if}</td>
		<td>{$weapon->getCost()|escape}</td>
	</tr>
{/foreach}</tbody>
</table>
