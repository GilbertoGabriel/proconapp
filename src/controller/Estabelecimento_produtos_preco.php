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
		$where = "estabelecimento_produtos_preco.preco LIKE \"%" . $search . "%\"";	
		
	if ($code != "")
		$where = "estabelecimento_produtos_preco.id = " . $code;
	
	if (isset($_GET["friendly"]))
		$where = "estabelecimento_produtos_preco.preco = \"" . removeLine($_GET["friendly"]) . "\"";	
		
	$limit = "";	
		
	if ($order != "") {
		$o = explode("<gz>", $order);

		$limit = $o[0] . " " . $o[1] . " LIMIT " . 
				(($position * $itensPerPage) - $itensPerPage) . ", " . $itensPerPage;
				
	} else {
		if ($position > 0 && $itensPerPage > 0) {
			$limit = "estabelecimento_produtos_preco.id DESC LIMIT " . 
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
		$response["estabelecimento_produtos_preco"] = $daoFactory->getEstabelecimento_produtos_precoDao()->read($where, $limit, true);
		$daoFactory->close();
		
		if (isset($_GET["friendly"]))
			$view->setTitle($response["estabelecimento_produtos_preco"][0]["estabelecimento_produtos_preco.preco"]);

		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/header.html");
		
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . 
				(isset($_GET["friendly"]) ? "/html/@_PAGE.html" : "/html/estabelecimento_produtos_preco.html"), $response);
		
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
			$estabelecimento_produtos_preco = new model\Estabelecimento_produtos_preco();
			$estabelecimento_produtos_preco->setPreco(logicZero(controllerDouble($request["estabelecimento_produtos_preco.preco"])));
			$estabelecimento_produtos_preco->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$estabelecimento_produtos_preco->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$estabelecimento_produtos_preco->setEstabelecimeto_produtos($request["estabelecimento_produtos_preco.estabelecimeto_produtos"]);
			
			$resultDao = $daoFactory->getEstabelecimento_produtos_precoDao()->create($estabelecimento_produtos_preco);

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
			
			$limit = "estabelecimento_produtos_preco.id DESC LIMIT " . 
					(($request[0]["page"] * $request[0]["pageSize"]) - 
					$request[0]["pageSize"]) . ", " . $request[0]["pageSize"];	
		}
		
		$daoFactory->beginTransaction();
		$estabelecimento_produtos_preco = $daoFactory->getEstabelecimento_produtos_precoDao()->read("", $limit, false);
		$daoFactory->close();
		
		echo $view->json($estabelecimento_produtos_preco);
	}
	
	/*
	 * Update
	 */
	else if ($method == "api-update") {	
		enableCORS();
		if (isset($_POST["request"])) {
			$request = json_decode($_POST["request"], true);
			// $request[0]["@_PARAM"] = $daoFactory->prepare($request[0]["@_PARAM"]); // Prepare with sql injection.
			
			$estabelecimento_produtos_preco = new model\Estabelecimento_produtos_preco();
			$estabelecimento_produtos_preco->setId($request["estabelecimento_produtos_preco.id"]);
			$estabelecimento_produtos_preco->setPreco(logicZero(controllerDouble($request["estabelecimento_produtos_preco.preco"])));
			$estabelecimento_produtos_preco->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$estabelecimento_produtos_preco->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$estabelecimento_produtos_preco->setEstabelecimeto_produtos($request["estabelecimento_produtos_preco.estabelecimeto_produtos"]);
			
			$daoFactory->beginTransaction();
			$resultDao = $daoFactory->getEstabelecimento_produtos_precoDao()->update($estabelecimento_produtos_preco);

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
			$request["estabelecimento_produtos_preco.id"] = $daoFactory->prepare($request["estabelecimento_produtos_preco.id"]); // Prepare with sql injection.
				
			$result = true;
			$lines = explode("<gz>", $request["estabelecimento_produtos_preco.id"]);

			$daoFactory->beginTransaction();

			for ($i = 0; $i < sizeof($lines); $i++) {
				$where = "estabelecimento_produtos_preco.id = " . $lines[$i];
				
				$resultDao = $daoFactory->getEstabelecimento_produtos_precoDao()->delete($where);
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
					$response["estabelecimento_produtos"] = $daoFactory->getEstabelecimento_produtosDao()->read("", "estabelecimento_produtos.id ASC", false);
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos_preco/estabelecimento_produtos_precoCRT.html", $response);
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
					$response["estabelecimento_produtos_preco"] = $daoFactory->getEstabelecimento_produtos_precoDao()->read($where, $limit, true);
					if (!is_array($response["estabelecimento_produtos_preco"])) {
						$response["data_not_found"][0]["value"] = "<p>N??o possui registro.</p>";
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos_preco/estabelecimento_produtos_precoRD.html", $response);
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
					$response["estabelecimento_produtos_preco"] = $daoFactory->getEstabelecimento_produtos_precoDao()->read($where, "", true);
					$response["estabelecimento_produtos_preco"][0]["estabelecimento_produtos_preco.estabelecimento_produtos"] = $daoFactory->getEstabelecimento_produtosDao()->read("", "estabelecimento_produtos.id ASC", false);
					for ($x = 0; $x < sizeof($response["estabelecimento_produtos_preco"][0]["estabelecimento_produtos_preco.estabelecimento_produtos"]); $x++) {
						if ($response["estabelecimento_produtos_preco"][0]["estabelecimento_produtos_preco.estabelecimento_produtos"][$x]["estabelecimento_produtos.id"] == 
								$response["estabelecimento_produtos_preco"][0]["estabelecimento_produtos_preco.estabelecimeto_produtos"]) {
							$response["estabelecimento_produtos_preco"][0]["estabelecimento_produtos_preco.estabelecimento_produtos"][$x]["estabelecimento_produtos.selected"] = "selected";
						}
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos_preco/estabelecimento_produtos_precoUPD.html", $response);
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
						$where .= " AND estabelecimento_produtos_preco.estabelecimeto_produtos  = " . $base;
					else 
						$where = "estabelecimento_produtos_preco.estabelecimeto_produtos  = " . $base;
					

						echo $base;


					$daoFactory->beginTransaction();
					$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
					$response["estabelecimento_produtos_preco"] = $daoFactory->getEstabelecimento_produtos_precoDao()->read($where, "", true);
					
					if (!is_array($response["estabelecimento_produtos_preco"])) {
						$response["data_not_found"][0]["value"] = "<p>N??o possui registro.</p>";
					}
					
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos_preco/estabelecimento_produtos_precoCLL.html", $response);
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
							$where .= " AND estabelecimento_produtos_preco.@_FOREIGN_KEY = " . $arrBase[1];
						else
							$where = "estabelecimento_produtos_preco.@_FOREIGN_KEY = " . $arrBase[1];
					}
				}
				
				$limit = "estabelecimento_produtos_preco.id DESC LIMIT " . (($position * 5) - 5) . ", 5";

				$daoFactory->beginTransaction();
				$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
				$response["estabelecimento_produtos_preco"] = $daoFactory->getEstabelecimento_produtos_precoDao()->read($where, $limit, true);
				$daoFactory->close();

				echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos_preco/estabelecimento_produtos_precoSCR.html", $response) . 
						"<size>" . (is_array($response["estabelecimento_produtos_preco"]) ? $response["estabelecimento_produtos_preco"][0]["estabelecimento_produtos_preco.size"] : 0) . "<theme>455a64";
			}

			/*
			 * Screen handler
			 */
			else if ($method == "screenHandler") {	
				$where = "";

				// Get value from combo
				$cmb = explode("<gz>", $search);

				if ($cmb[1] != "")
					$where = "estabelecimento_produtos_preco.id = " . $cmb[1];

				$daoFactory->beginTransaction();
				$response["estabelecimento_produtos_preco"] = $daoFactory->getEstabelecimento_produtos_precoDao()->comboScr($where);
				$daoFactory->close();

				echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos_preco/estabelecimento_produtos_precoCMB.html", $response);
			}

			/*
			 * Create
			 */
			else if ($method == "create") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response["message"] = "permission";
					
					echo $view->json($response);
				} else {
					$estabelecimento_produtos_preco = new model\Estabelecimento_produtos_preco();
					$estabelecimento_produtos_preco->setPreco(logicZero(controllerDouble($form[0])));
					$estabelecimento_produtos_preco->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$estabelecimento_produtos_preco->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$estabelecimento_produtos_preco->setEstabelecimeto_produtos($form[1]);
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getEstabelecimento_produtos_precoDao()->create($estabelecimento_produtos_preco);

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
					$estabelecimento_produtos_preco = new model\Estabelecimento_produtos_preco();
					$estabelecimento_produtos_preco->setId($code);
					$estabelecimento_produtos_preco->setPreco(logicZero(controllerDouble($form[0])));
					$estabelecimento_produtos_preco->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$estabelecimento_produtos_preco->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$estabelecimento_produtos_preco->setEstabelecimeto_produtos($form[1]);
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getEstabelecimento_produtos_precoDao()->update($estabelecimento_produtos_preco);

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
						$where = "estabelecimento_produtos_preco.id = " . $lines[$i];
						
						$resultDao = $daoFactory->getEstabelecimento_produtos_precoDao()->delete($where);
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