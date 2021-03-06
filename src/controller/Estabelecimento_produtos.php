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
		$where = "estabelecimento_produtos.modificado LIKE \"%" . $search . "%\"";	
		
	if ($code != "")
		$where = "estabelecimento_produtos.id = " . $code;
	
	if (isset($_GET["friendly"]))
		$where = "estabelecimento_produtos.modificado = \"" . removeLine($_GET["friendly"]) . "\"";	
		
	$limit = "";	
		
	if ($order != "") {
		$o = explode("<gz>", $order);

		$limit = $o[0] . " " . $o[1] . " LIMIT " . 
				(($position * $itensPerPage) - $itensPerPage) . ", " . $itensPerPage;
				
	} else {
		if ($position > 0 && $itensPerPage > 0) {
			$limit = "estabelecimento_produtos.id DESC LIMIT " . 
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
		$response["estabelecimento_produtos"] = $daoFactory->getEstabelecimento_produtosDao()->read($where, $limit, true);
		$daoFactory->close();
		
		if (isset($_GET["friendly"]))
			$view->setTitle($response["estabelecimento_produtos"][0]["estabelecimento_produtos.modificado"]);

		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/header.html");
		
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . 
				(isset($_GET["friendly"]) ? "/html/@_PAGE.html" : "/html/estabelecimento_produtos.html"), $response);
		
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
			$estabelecimento_produtos = new model\Estabelecimento_produtos();
			$estabelecimento_produtos->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$estabelecimento_produtos->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$estabelecimento_produtos->setEstabelecimento($request["estabelecimento_produtos.estabelecimento"]);
			$estabelecimento_produtos->setProduto($request["estabelecimento_produtos.produto"]);
			
			$resultDao = $daoFactory->getEstabelecimento_produtosDao()->create($estabelecimento_produtos);

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
			
			$limit = "estabelecimento_produtos.id DESC LIMIT " . 
					(($request[0]["page"] * $request[0]["pageSize"]) - 
					$request[0]["pageSize"]) . ", " . $request[0]["pageSize"];	
		}
		
		$daoFactory->beginTransaction();
		$estabelecimento_produtos = $daoFactory->getEstabelecimento_produtosDao()->read("", $limit, false);
		$daoFactory->close();
		
		echo $view->json($estabelecimento_produtos);
	}
	
	/*
	 * Update
	 */
	else if ($method == "api-update") {	
		enableCORS();
		if (isset($_POST["request"])) {
			$request = json_decode($_POST["request"], true);
			// $request[0]["@_PARAM"] = $daoFactory->prepare($request[0]["@_PARAM"]); // Prepare with sql injection.
			
			$estabelecimento_produtos = new model\Estabelecimento_produtos();
			$estabelecimento_produtos->setId($request["estabelecimento_produtos.id"]);
			$estabelecimento_produtos->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$estabelecimento_produtos->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$estabelecimento_produtos->setEstabelecimento($request["estabelecimento_produtos.estabelecimento"]);
			$estabelecimento_produtos->setProduto($request["estabelecimento_produtos.produto"]);
			
			$daoFactory->beginTransaction();
			$resultDao = $daoFactory->getEstabelecimento_produtosDao()->update($estabelecimento_produtos);

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
			$request["estabelecimento_produtos.id"] = $daoFactory->prepare($request["estabelecimento_produtos.id"]); // Prepare with sql injection.
				
			$result = true;
			$lines = explode("<gz>", $request["estabelecimento_produtos.id"]);

			$daoFactory->beginTransaction();

			for ($i = 0; $i < sizeof($lines); $i++) {
				$where = "estabelecimento_produtos.id = " . $lines[$i];
				
				$resultDao = $daoFactory->getEstabelecimento_produtosDao()->delete($where);
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
					$response["estabelecimentos"] = $daoFactory->getEstabelecimentosDao()->read("", "estabelecimentos.id ASC", false);
					$response["produtos"] = $daoFactory->getProdutosDao()->read("", "produtos.id ASC", false);
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos/estabelecimento_produtosCRT.html", $response);
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
					$response["estabelecimento_produtos"] = $daoFactory->getEstabelecimento_produtosDao()->read($where, $limit, true);
					if (!is_array($response["estabelecimento_produtos"])) {
						$response["data_not_found"][0]["value"] = "<p>N??o possui registro.</p>";
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos/estabelecimento_produtosRD.html", $response);
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
					$response["estabelecimento_produtos"] = $daoFactory->getEstabelecimento_produtosDao()->read($where, "", true);
					$response["estabelecimento_produtos"][0]["estabelecimento_produtos.estabelecimentos"] = $daoFactory->getEstabelecimentosDao()->read("", "estabelecimentos.id ASC", false);
					for ($x = 0; $x < sizeof($response["estabelecimento_produtos"][0]["estabelecimento_produtos.estabelecimentos"]); $x++) {
						if ($response["estabelecimento_produtos"][0]["estabelecimento_produtos.estabelecimentos"][$x]["estabelecimentos.id"] == 
								$response["estabelecimento_produtos"][0]["estabelecimento_produtos.estabelecimento"]) {
							$response["estabelecimento_produtos"][0]["estabelecimento_produtos.estabelecimentos"][$x]["estabelecimentos.selected"] = "selected";
						}
					}
					$response["estabelecimento_produtos"][0]["estabelecimento_produtos.produtos"] = $daoFactory->getProdutosDao()->read("", "produtos.id ASC", false);
					for ($x = 0; $x < sizeof($response["estabelecimento_produtos"][0]["estabelecimento_produtos.produtos"]); $x++) {
						if ($response["estabelecimento_produtos"][0]["estabelecimento_produtos.produtos"][$x]["produtos.id"] == 
								$response["estabelecimento_produtos"][0]["estabelecimento_produtos.produto"]) {
							$response["estabelecimento_produtos"][0]["estabelecimento_produtos.produtos"][$x]["produtos.selected"] = "selected";
						}
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos/estabelecimento_produtosUPD.html", $response);
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
						$where .= " AND estabelecimento_produtos.@_FOREIGN_KEY = " . $base;
					else 
						$where = "estabelecimento_produtos.@_FOREIGN_KEY = " . $base;
						
					$daoFactory->beginTransaction();
					$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
					$response["estabelecimento_produtos"] = $daoFactory->getEstabelecimento_produtosDao()->read($where, $limit, true);
					if (!is_array($response["estabelecimento_produtos"])) {
						$response["data_not_found"][0]["value"] = "<p>N??o possui registro.</p>";
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos/estabelecimento_produtosCLL.html", $response);
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
							$where .= " AND estabelecimento_produtos.@_FOREIGN_KEY = " . $arrBase[1];
						else
							$where = "estabelecimento_produtos.@_FOREIGN_KEY = " . $arrBase[1];
					}
				}
				
				$limit = "estabelecimento_produtos.id DESC LIMIT " . (($position * 5) - 5) . ", 5";

				$daoFactory->beginTransaction();
				$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
				$response["estabelecimento_produtos"] = $daoFactory->getEstabelecimento_produtosDao()->read($where, $limit, true);
				$daoFactory->close();

				echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos/estabelecimento_produtosSCR.html", $response) . 
						"<size>" . (is_array($response["estabelecimento_produtos"]) ? $response["estabelecimento_produtos"][0]["estabelecimento_produtos.size"] : 0) . "<theme>455a64";
			}

			/*
			 * Screen handler
			 */
			else if ($method == "screenHandler") {	
				$where = "";

				// Get value from combo
				$cmb = explode("<gz>", $search);

				if ($cmb[1] != "")
					$where = "estabelecimento_produtos.id = " . $cmb[1];

				$daoFactory->beginTransaction();
				$response["estabelecimento_produtos"] = $daoFactory->getEstabelecimento_produtosDao()->comboScr($where);
				$daoFactory->close();

				echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/estabelecimento_produtos/estabelecimento_produtosCMB.html", $response);
			}

			/*
			 * Create
			 */
			else if ($method == "create") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response["message"] = "permission";
					
					echo $view->json($response);
				} else {
					$estabelecimento_produtos = new model\Estabelecimento_produtos();
					$estabelecimento_produtos->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$estabelecimento_produtos->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$estabelecimento_produtos->setEstabelecimento($form[0]);
					$estabelecimento_produtos->setProduto($form[1]);
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getEstabelecimento_produtosDao()->create($estabelecimento_produtos);

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
					$estabelecimento_produtos = new model\Estabelecimento_produtos();
					$estabelecimento_produtos->setId($code);
					$estabelecimento_produtos->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$estabelecimento_produtos->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$estabelecimento_produtos->setEstabelecimento($form[0]);
					$estabelecimento_produtos->setProduto($form[1]);
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getEstabelecimento_produtosDao()->update($estabelecimento_produtos);

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
						$where = "estabelecimento_produtos.id = " . $lines[$i];
						
						$resultDao = $daoFactory->getEstabelecimento_produtosDao()->delete($where);
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