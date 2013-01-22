<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lte IE 6]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" class="lteIE6">
<![endif]-->
<!--[if !IE]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<!-- <![endif]-->
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>{$title|escape} | {$SITE_NAME|escape}</title>

<link rel="stylesheet" type="text/css" href="http://iten-game.org/wp-content/themes/modularity-lite/style.css" />
<link rel="stylesheet" href="http://iten-game.org/wp-content/themes/modularity-lite/css/print.css" type="text/css" media="print" />
<!--[if IE]><link rel="stylesheet" href="http://iten-game.org/wp-content/themes/modularity-lite/library/styles/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<!--[if lte IE 7]><link type="text/css" href="http://iten-game.org/wp-content/themes/modularity-lite/library/styles/ie-nav.css" rel="stylesheet" media="all" /><![endif]-->

<link rel="stylesheet" type="text/css" href="/css/style.css" />

<style type="text/css" media="screen">{literal}
	html { margin-top: 28px !important; }
	* html body { margin-top: 28px !important; }

	table,tbody,thead,tfoot,td,tr,th {
		background-color:inherit !important;
	}
{/literal}</style>

<link rel="shortcut icon" type="image/jpg" href="http://iten-game.org/wp-content/uploads/2011/08/icon.jpg"/>
</head>

<body class="page page-template-full-width-page-php">
<div id="top">

<div id="masthead">
 <h4 class="left"><a href="/" title="Home" class="logo">{$title|escape} | {$SITE_NAME|escape}</a></h4>
</div>

<div class="main-nav"><ul>
{if $user}
<li>Logged in as {$user->username|escape|capitalize}</li>
<li><a href="/home">home</a></li>
<li><a href="/public_retinues">public retinues</a></li>
<li><a href="/feedback">feedback</a></li>
<li><a href="/edit_profile">edit profile</a></li>
<li><a href="/logout">log out</a></li>
{else}
<li><a href="/">home</a></li>
<li><a href="/public_retinues">public retinues</a></li>
<li><a href="/login">log in</a></li>
<li><a href="/signup">sign up</a></li>
{/if}
</ul></div>

<div class="clear"></div>
</div>

<div class="container">
<div class="container-inner">
	<div id="header-image">
	<img src="http://iten-game.org/wp-content/uploads/2011/08/iten-header.jpg" width="950" height="200" alt="" />
	</div>
	<div class="first last">
				<div class="page type-page hentry" id="post-92">

{if $error}
	<p class="error">Error: {$error|escape}</p>
{/if}