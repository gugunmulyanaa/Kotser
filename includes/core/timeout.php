<?php

class PoTimeout
{

	function __construct()
	{ }

	public function rec_session($session = array())
	{
		$_SESSION['iduser'] = $session['id_user'];
		$_SESSION['namauser'] = $session['username'];
		$_SESSION['namalengkap'] = $session['nama_lengkap'];
		$_SESSION['passuser'] = $session['password'];
		$_SESSION['leveluser'] = $session['level'];
		$_SESSION['menuuser'] = $session['menu'];
		$_SESSION['login'] = 1;
	}

	public function timer()
	{
		$time = 10000;
		$_SESSION['timeout'] = time() + $time;
	}

	public function check_login()
	{
		$timeout = $_SESSION['timeout'];
		if (time() < $timeout) {
			$this->timer();
			return true;
		} else {
			unset($_SESSION['timeout']);
			return false;
		}
	}

	public function rec_session_member($session = array())
	{
		$_SESSION['iduser_member'] = $session['id_user'];
		$_SESSION['namauser_member'] = $session['username'];
		$_SESSION['namalengkap_member'] = $session['nama_lengkap'];
		$_SESSION['passuser_member'] = $session['password'];
		$_SESSION['leveluser_member'] = $session['level'];
		$_SESSION['login_member'] = 1;
	}

	public function timer_member()
	{
		$time = 10000;
		$_SESSION['timeout_member'] = time() + $time;
	}

	public function check_login_member()
	{
		$timeout = $_SESSION['timeout_member'];
		if (time() < $timeout) {
			$this->timer();
			return true;
		} else {
			unset($_SESSION['timeout_member']);
			return false;
		}
	}
}
