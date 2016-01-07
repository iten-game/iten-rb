<?php

class RB_User extends RB_DB_Users {

	function getRetinues() {
		$retinue = new RB_Retinue;
		$retinue->user = $this->id;
		return $retinue->findSet();
	}

	function getFigures() {
		$figure = new RB_Figure;
		$figure->user = $this->id;
		return $figure->findSet();
	}

	function setPassword($password, $update=true) {

		$this->password_alg = PASSWORD_HASH_ALG;
		$this->password_iterations = PASSWORD_HASH_ITERATIONS;

		$fh = fopen('/dev/urandom', 'rb');
		$this->password_salt = substr(bin2hex(fread($fh, 128)), 0, 255);
		fclose($fh);

		$this->password_hash = $this->hashPassword($password);

		if ($update) $this->update();
	}

	function hashPassword($password) {
		for ($i = 0 ; $i < $this->password_iterations ; $i++) {
			$password = hash(
				$this->password_alg,
				$this->password_salt.$password
			);
		}
		return $password;
	}
}
