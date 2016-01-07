{include file="head.tpl" title="Welcome"}

<p>Welcome to the {$SITE_NAME}. This site provides an easy way to build a retinue list for <em>In the Emperor's Name</em>.</p>

<p>As an anonymous user, you can browse the public retinue lists shown on the right. Once you've created an account, you can create your own lists and figures, "clone" other user's public lists, and share them with other <em>ItEN</em> players around the world!</p>

<div style="width:45%;float:left">

<h2>Log In</h2>

{include file="login-form.tpl"}

<h2>Create Account</h2>

{include file="signup-form.tpl"}

</div>

<div style="width:45%;float:right">

<h2>Public Retinues</h2>

<ul>
{assign var=retinues value=$RB->getPublicRetinues(20)}
{assign var=count value=0}
{foreach from=$retinues item=retinue}
	{assign var=count value=$count+1}
	{assign var=race value=$retinue->getRace()}
	{assign var=user value=$retinue->getCreator()}
	<li><a href="/view_retinue?id={$retinue->id|escape}">{$retinue->name|escape}</a> ({$race->name|escape}) by {$user->username|escape|capitalize}</li>
{/foreach}
</ul>
{if $count < 1}
	<p><em>None found.</em></p>

{else}
	<p><a href="/public_retinues">More...</a></p>

{/if}
</div>

{include file="foot.tpl"}

