<?php

include_once '../includes/core/config.php';
if (VQMOD == TRUE) {
	require_once '../vqmod/vqmod.php';
	VQMod::bootup();
	include_once VQMod::modCheck('../includes/core/core.php');
} else {
	include_once '../includes/core/core.php';
}

$route = new PoRequest();

$mod = ucfirst($route->get('mod', FILTER_SANITIZE_STRING));

$act = $route->get('act', FILTER_SANITIZE_STRING);

switch (basename($_SERVER['PHP_SELF'])) {

	case "index.php":
		if (VQMOD == TRUE) {
			include_once VQMod::modCheck("login.php");
		} else {
			include_once "login.php";
		}
		if (class_exists($mod)) {
			$slug = new $mod();
			if (method_exists($slug, $act)) {
				$slug->$act();
			} else {
				$slug->index();
			}
		} else {
			$slug = new Login();
			$slug->index();
		}
		break;

	case "admin.php":
		if (file_exists("../" . DIR_CON . "/component/" . strtolower($mod) . "/admin_" . strtolower($mod) . ".php")) {
			if (VQMOD == TRUE) {
				include_once VQMod::modCheck("../" . DIR_CON . "/component/" . strtolower($mod) . "/admin_" . strtolower($mod) . ".php");
			} else {
				include_once "../" . DIR_CON . "/component/" . strtolower($mod) . "/admin_" . strtolower($mod) . ".php";
			}
			if (class_exists($mod)) {
				if (file_exists("../" . DIR_CON . "/lang/" . strtolower($mod) . "/" . $selectlang . ".php")) {
					if (VQMOD == TRUE) {
						include_once VQMod::modCheck("../" . DIR_CON . "/lang/" . strtolower($mod) . "/" . $selectlang . ".php");
					} else {
						include_once "../" . DIR_CON . "/lang/" . strtolower($mod) . "/" . $selectlang . ".php";
					}
				} else {
					if (file_exists("../" . DIR_CON . "/lang/" . strtolower($mod) . "/id.php")) {
						if (VQMOD == TRUE) {
							include_once VQMod::modCheck("../" . DIR_CON . "/lang/" . strtolower($mod) . "/id.php");
						} else {
							include_once "../" . DIR_CON . "/lang/" . strtolower($mod) . "/id.php";
						}
					}
				}
				$slug = new $mod();
				if (method_exists($slug, $act)) {
					$slug->$act();
				} else {
					$slug->index();
				}
			} else {
				if (VQMOD == TRUE) {
					include_once VQMod::modCheck("../" . DIR_CON . "/component/home/admin_home.php");
				} else {
					include_once "../" . DIR_CON . "/component/home/admin_home.php";
				}
				$slug = new Home();
				$slug->index();
			}
		} else {
			if (VQMOD == TRUE) {
				include_once VQMod::modCheck("../" . DIR_CON . "/component/home/admin_home.php");
			} else {
				include_once "../" . DIR_CON . "/component/home/admin_home.php";
			}
			$slug = new Home();
			$slug->error();
		}
		break;

	case "route.php":
		if ($mod == 'Login') {
			session_start();
			if (VQMOD == TRUE) {
				include_once VQMod::modCheck("login.php");
			} else {
				include_once "login.php";
			}
			if (class_exists($mod)) {
				$slug = new $mod();
				if (method_exists($slug, $act)) {
					$slug->$act();
				} else {
					$slug->index();
				}
			} else {
				$slug = new Login();
				$slug->index();
			}
		} else {
			if (file_exists("../" . DIR_CON . "/component/" . strtolower($mod) . "/admin_" . strtolower($mod) . ".php")) {
				session_start();
				if (VQMOD == TRUE) {
					include_once VQMod::modCheck("../" . DIR_CON . "/component/" . strtolower($mod) . "/admin_" . strtolower($mod) . ".php");
				} else {
					include_once "../" . DIR_CON . "/component/" . strtolower($mod) . "/admin_" . strtolower($mod) . ".php";
				}
				if (class_exists($mod)) {
					$selectlang = (isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'id');
					if (VQMOD == TRUE) {
						include_once VQMod::modCheck("../" . DIR_CON . "/lang/main/" . $selectlang . ".php");
					} else {
						include_once "../" . DIR_CON . "/lang/main/" . $selectlang . ".php";
					}
					if (file_exists("../" . DIR_CON . "/lang/" . strtolower($mod) . "/" . $selectlang . ".php")) {
						if (VQMOD == TRUE) {
							include_once VQMod::modCheck("../" . DIR_CON . "/lang/" . strtolower($mod) . "/" . $selectlang . ".php");
						} else {
							include_once "../" . DIR_CON . "/lang/" . strtolower($mod) . "/" . $selectlang . ".php";
						}
					} else {
						if (file_exists("../" . DIR_CON . "/lang/" . strtolower($mod) . "/id.php")) {
							if (VQMOD == TRUE) {
								include_once VQMod::modCheck("../" . DIR_CON . "/lang/" . strtolower($mod) . "/id.php");
							} else {
								include_once "../" . DIR_CON . "/lang/" . strtolower($mod) . "/id.php";
							}
						}
					}
					$slug = new $mod();
					if (method_exists($slug, $act)) {
						$slug->$act();
					} else {
						$slug = new PoError();
						$slug->notfound();
					}
				} else {
					$slug = new PoError();
					$slug->notfound();
				}
			} else {
				$slug = new PoError();
				$slug->notfound();
			}
		}
		break;
}
