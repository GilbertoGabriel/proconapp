<?php

	/**
	 * Generated by Getz Framework
	 *
	 * @author Mario Sakamoto <mskamot@gmail.com>
	 * @see https://wtag.com.br/getz
	 */
	 
	use lib\getz;
	use src\logic;	 
	use src\model;	 
	
	require_once($_DOCUMENT_ROOT . "/lib/getz/Activator.php");
	
	/*
	 * Filters
	 */
	$where = "";
	
	if ($search != "")
		$where = "situacoes_registros.situacao_registro LIKE \"%" . $search . "%\"";	
		
	if ($code != "")
		$where = "situacoes_registros.id = " . $code;
	
	if (isset($_GET["friendly"]))
		$where = "situacoes_registros.situacao_registro = \"" . removeLine($_GET["friendly"]) . "\"";	
		
	$limit = "";	
		
	if ($order != "") {
		$o = explode("<gz>", $order);

		$limit = $o[0] . " " . $o[1] . " LIMIT " . 
				(($position * $itensPerPage) - $itensPerPage) . ", " . $itensPerPage;
				
	} else {
		if ($position > 0 && $itensPerPage > 0) {
			$limit = "situacoes_registros.id DESC LIMIT " . 
					(($position * $itensPerPage) - $itensPerPage) . ", " . $itensPerPage;	
		}
	}
	
	/**************************************************
	 * Webpage
	 **************************************************/		
	
	/*
	 * Page
	 */
	if ($method == "page") {
		/*
		 * SEO
		 */
		$view->setTitle(ucfirst($screen));
		$view->setDescription("");
		$view->setKeywords("");
		
		$daoFactory->beginTransaction();
		$response["situacoes_registros"] = $daoFactory->getSituacoes_registrosDao()->read($where, $limit, true);
		$daoFactory->close();
		
		if (isset($_GET["friendly"]))
			$view->setTitle($response["situacoes_registros"][0]["situacoes_registros.situacao_registro"]);

		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/header.html");
		
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . 
				(isset($_GET["friendly"]) ? "/html/@_PAGE.html" : "/html/situacoes_registros.html"), $response);
		
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/footer.html");
	}
	
	/**************************************************
	 * Webservice
	 **************************************************/	

	/*
	 * Create
	 */
	else if ($method == "api-create") {
		enableCORS();
		if (isset($_POST["request"])) {
			$request = json_decode($_POST["request"], true);
			// $request[0]["@_PARAM"] = $daoFactory->prepare($request[0]["@_PARAM"]); // Prepare with sql injection.

			$daoFactory->beginTransaction();
			$situacoes_registros = new model\Situacoes_registros();
			$situacoes_registros->setSituacao_registro(logicNull($request["situacoes_registros.situacao_registro"]));
			$situacoes_registros->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$situacoes_registros->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$situacoes_registros->setCor($request["situacoes_registros.cor"]);
			
			$resultDao = $daoFactory->getSituacoes_registrosDao()->create($situacoes_registros);

			if ($resultDao) {
				$daoFactory->commit();
				$response["message"] = "success";
			} else {							
				$daoFactory->rollback();
				$response["message"] = "error";
			}

			$daoFactory->close();
		} else {
			$response["message"] = "error";
		}
		
		echo $view->json($response);
	}
	
	/*
	 * Read
	 */
	else if ($method == "api-read") {
		enableCORS();
		
		if (isset($_POST["request"])) {
			$request = json_decode($_POST["request"], true);
			
			$limit = "situacoes_registros.id DESC LIMIT " . 
					(($request[0]["page"] * $request[0]["pageSize"]) - 
					$request[0]["pageSize"]) . ", " . $request[0]["pageSize"];	
		}
		
		$daoFactory->beginTransaction();
		$situacoes_registros = $daoFactory->getSituacoes_registrosDao()->read("", $limit, false);
		$daoFactory->close();
		
		echo $view->json($situacoes_registros);
	}
	
	/*
	 * Update
	 */
	else if ($method == "api-update") {	
		enableCORS();
		if (isset($_POST["request"])) {
			$request = json_decode($_POST["request"], true);
			// $request[0]["@_PARAM"] = $daoFactory->prepare($request[0]["@_PARAM"]); // Prepare with sql injection.
			
			$situacoes_registros = new model\Situacoes_registros();
			$situacoes_registros->setId($request["situacoes_registros.id"]);
			$situacoes_registros->setSituacao_registro(logicNull($request["situacoes_registros.situacao_registro"]));
			$situacoes_registros->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$situacoes_registros->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$situacoes_registros->setCor($request["situacoes_registros.cor"]);
			
			$daoFactory->beginTransaction();
			$resultDao = $daoFactory->getSituacoes_registrosDao()->update($situacoes_registros);

			if ($resultDao) {
				$daoFactory->commit();
				$response["message"] = "success";
			} else {							
				$daoFactory->rollback();
				$response["message"] = "error";
			}

			$daoFactory->close();
		} else {
			$response["message"] = "error";
		}
		
		echo $view->json($response);
	}
	
	/* 
	 * Delete
	 */
	else if ($method == "api-delete") {
		enableCORS();
		if (isset($_POST["request"])) {
			$request = json_decode($_POST["request"], true);
			$request["situacoes_registros.id"] = $daoFactory->prepare($request["situacoes_registros.id"]); // Prepare with sql injection.
				
			$result = true;
			$lines = explode("<gz>", $request["situacoes_registros.id"]);

			$daoFactory->beginTransaction();

			for ($i = 0; $i < sizeof($lines); $i++) {
				$where = "situacoes_registros.id = " . $lines[$i];
				
				$resultDao = $daoFactory->getSituacoes_registrosDao()->delete($where);
				$result = !$result ? false : (!$resultDao ? false : true);
			}

			if ($result) {
				$daoFactory->commit();
				$response["message"] = "success";
			} else {							
				$daoFactory->rollback();
				$response["message"] = "error";
			}

			$daoFactory->close();
		} else {
			$response["message"] = "error";
		} 

		echo $view->json($response);
	}
	
	/**************************************************
	 * System
	 **************************************************/	
	
	else {
		if (!getActiveSession($_ROOT . $_MODULE)) 
			echo "<script>goTo(\"/login/1\");</script>";
		else {
			/*
			 * Create
			 */
			if ($method == "stateCreate") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					$daoFactory->beginTransaction();
					$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
					$response["cores"] = $daoFactory->getCoresDao()->read("", "cores.id ASC", false);
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/situacoes_registros/situacoes_registrosCRT.html", $response);
				}
			}

			/*
			 * Read
			 */
			else if ($method == "stateRead") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					$daoFactory->beginTransaction();
					$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
					$response["situacoes_registros"] = $daoFactory->getSituacoes_registrosDao()->read($where, $limit, true);
					if (!is_array($response["situacoes_registros"])) {
						$response["data_not_found"][0]["value"] = "<p>Não possui registro.</p>";
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/situacoes_registros/situacoes_registrosRD.html", $response);
				}
			}

			/*
			 * Update
			 */
			else if ($method == "stateUpdate") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					$daoFactory->beginTransaction();
					$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
					$response["situacoes_registros"] = $daoFactory->getSituacoes_registrosDao()->read($where, "", true);
					$response["situacoes_registros"][0]["situacoes_registros.cores"] = $daoFactory->getCoresDao()->read("", "cores.id ASC", false);
					for ($x = 0; $x < sizeof($response["situacoes_registros"][0]["situacoes_registros.cores"]); $x++) {
						if ($response["situacoes_registros"][0]["situacoes_registros.cores"][$x]["cores.id"] == 
								$response["situacoes_registros"][0]["situacoes_registros.cor"]) {
							$response["situacoes_registros"][0]["situacoes_registros.cores"][$x]["cores.selected"] = "selected";
						}
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/situacoes_registros/situacoes_registrosUPD.html", $response);
				}
			}

			/*
			 * Called
			 */
			else if ($method == "stateCalled") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					/*
					 * Insert your foreign key here
					 */
					if ($where != "")
						$where .= " AND situacoes_registros.@_FOREIGN_KEY = " . $base;
					else 
						$where = "situacoes_registros.@_FOREIGN_KEY = " . $base;
						
					$daoFactory->beginTransaction();
					$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
					$response["situacoes_registros"] = $daoFactory->getSituacoes_registrosDao()->read($where, $limit, true);
					if (!is_array($response["situacoes_registros"])) {
						$response["data_not_found"][0]["value"] = "<p>Não possui registro.</p>";
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/situacoes_registros/situacoes_registrosCLL.html", $response);
				}
			}

			/*
			 * Screen
			 */
			else if ($method == "screen") {
				if ($base != "") {
					$arrBase = explode("<gz>", $base);
					
					if (sizeof($arrBase) > 1) {
						if ($where != "")
							$where .= " AND situacoes_registros.@_FOREIGN_KEY = " . $arrBase[1];
						else
							$where = "situacoes_registros.@_FOREIGN_KEY = " . $arrBase[1];
					}
				}
				
				$limit = "situacoes_registros.id DESC LIMIT " . (($position * 5) - 5) . ", 5";

				$daoFactory->beginTransaction();
				$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
				$response["situacoes_registros"] = $daoFactory->getSituacoes_registrosDao()->read($where, $limit, true);
				$daoFactory->close();

				echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/situacoes_registros/situacoes_registrosSCR.html", $response) . 
						"<size>" . (is_array($response["situacoes_registros"]) ? $response["situacoes_registros"][0]["situacoes_registros.size"] : 0) . "<theme>455a64";
			}

			/*
			 * Screen handler
			 */
			else if ($method == "screenHandler") {	
				$where = "";

				// Get value from combo
				$cmb = explode("<gz>", $search);

				if ($cmb[1] != "")
					$where = "situacoes_registros.id = " . $cmb[1];

				$daoFactory->beginTransaction();
				$response["situacoes_registros"] = $daoFactory->getSituacoes_registrosDao()->comboScr($where);
				$daoFactory->close();

				echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/situacoes_registros/situacoes_registrosCMB.html", $response);
			}

			/*
			 * Create
			 */
			else if ($method == "create") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response["message"] = "permission";
					
					echo $view->json($response);
				} else {
					$situacoes_registros = new model\Situacoes_registros();
					$situacoes_registros->setSituacao_registro(logicNull($form[0]));
					$situacoes_registros->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$situacoes_registros->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$situacoes_registros->setCor($form[1]);
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getSituacoes_registrosDao()->create($situacoes_registros);

					if ($resultDao) {
						$daoFactory->commit();
						$response["message"] = "success";				
					} else {							
						$daoFactory->rollback();
						$response["message"] = "error";
					}

					$daoFactory->close();

					echo $view->json($response);
				}
			}

			/*
			 * Action update
			 */
			else if ($method == "update") {	
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response["message"] = "permission";
					
					echo $view->json($response);
				} else {
					$situacoes_registros = new model\Situacoes_registros();
					$situacoes_registros->setId($code);
					$situacoes_registros->setSituacao_registro(logicNull($form[0]));
					$situacoes_registros->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$situacoes_registros->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$situacoes_registros->setCor($form[1]);
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getSituacoes_registrosDao()->update($situacoes_registros);

					if ($resultDao) {
						$daoFactory->commit();
						$response["message"] = "success";
					} else {							
						$daoFactory->rollback();
						$response["message"] = "error";
					}

					$daoFactory->close();

					echo $view->json($response);
				}
			}
			
			/* 
			 * Action delete
			 */
			else if ($method == "delete") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response["message"] = "permission";
					
					echo $view->json($response);
				} else {
					$result = true;
					$lines = explode("<gz>", $code);

					$daoFactory->beginTransaction();

					for ($i = 1; $i < sizeof($lines); $i++) {
						$where = "situacoes_registros.id = " . $lines[$i];
						
						$resultDao = $daoFactory->getSituacoes_registrosDao()->delete($where);
						$result = !$result ? false : (!$resultDao ? false : true);
					}

					if ($result) {
						$daoFactory->commit();
						$response["message"] = "success";
					} else {							
						$daoFactory->rollback();
						$response["message"] = "error";
					}

					$daoFactory->close();

					echo $view->json($response);	
				}
			}
		}
	}

?>