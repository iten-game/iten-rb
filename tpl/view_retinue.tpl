{capture assign=title}
View Retinue | {$retinue->name} {* not escaped as it will be escaped in head.tpl *}
{/capture}
{include file="head.tpl" title=$title}

{if !$error}
<p>Retinue Name: {$retinue->name|escape}</p>

{assign var=race value=$retinue->getRace()}
<p>Faction: {$race->name}</p>

{assign var=creator value=$retinue->getCreator()}
<p>Created by: <a href="/contact_user?id={$creator->username|escape}">{$creator->username|escape|capitalize}</a></p>

{if $retinue->notes}
	<p>Notes: <em>{$retinue->notes|escape|nl2br}</em></p>
{/if}

{if $user->id == $retinue->user}
	<p>You are the owner of this retinue. <a href="/edit_retinue?id={$retinue->id|escape}">Click here to edit it</a>.</p>

{elseif $user}
	<form action="/clone_retinue" method="post">
		<input type="hidden" name="retinue" value="{$retinue->id|escape}"/>
		<p><input type="submit" value="Clone This Retinue" /></p>
	</form>

{else}
	<p>If you were logged in, you could clone this retinue list and make your own version! <a href="/">Click here to log in or sign up.</a></p>

{/if}

<p><a href="/view_retinue?id={$retinue->id|escape}&amp;printable=1">Printable version</a></p>

{include file="figure-list.tpl" figures=$retinue->getFigures() read_only=true}

{/if}

{include file="foot.tpl"}