<?php

if (isset($user)) {
        header('Location: /home');

} else {
	$tpl->display('front.tpl');

}

