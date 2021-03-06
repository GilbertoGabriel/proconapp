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
		$where = "categorias.categoria LIKE \"%" . $search . "%\"";	
		
	if ($code != "")
		$where = "categorias.id = " . $code;
	
	if (isset($_GET["friendly"]))
		$where = "categorias.categoria = \"" . removeLine($_GET["friendly"]) . "\"";	
		
	$limit = "";	
		
	if ($order != "") {
		$o = explode("<gz>", $order);

		$limit = $o[0] . " " . $o[1] . " LIMIT " . 
				(($position * $itensPerPage) - $itensPerPage) . ", " . $itensPerPage;
				
	} else {
		if ($position > 0 && $itensPerPage > 0) {
			$limit = "categorias.id DESC LIMIT " . 
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
		$response["categorias"] = $daoFactory->getCategoriasDao()->read($where, $limit, true);
		$daoFactory->close();
		
		if (isset($_GET["friendly"]))
			$view->setTitle($response["categorias"][0]["categorias.categoria"]);

		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/header.html");
		
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . 
				(isset($_GET["friendly"]) ? "/html/@_PAGE.html" : "/html/categorias.html"), $response);
		
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
			$categorias = new model\Categorias();
			$categorias->setCategoria(logicNull($request["categorias.categoria"]));
			
			if (isset($_FILES["upload"])) {
				$upload = new getz\Upload($_FILES["upload"], 1200);
				$categorias->setFoto($upload->getName());
			} else 
				$categorias->setFoto("");
				
			$categorias->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$categorias->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$categorias->setCor($request["categorias.cor"]);
			
			$resultDao = $daoFactory->getCategoriasDao()->create($categorias);

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
			
			$limit = "categorias.id DESC LIMIT " . 
					(($request[0]["page"] * $request[0]["pageSize"]) - 
					$request[0]["pageSize"]) . ", " . $request[0]["pageSize"];	
		}
		
		$daoFactory->beginTransaction();
		$categorias = $daoFactory->getCategoriasDao()->read("", $limit, false);
		$daoFactory->close();
		
		echo $view->json($categorias);
	}
	
	/*
	 * Update
	 */
	else if ($method == "api-update") {	
		enableCORS();
		if (isset($_POST["request"])) {
			$request = json_decode($_POST["request"], true);
			// $request[0]["@_PARAM"] = $daoFactory->prepare($request[0]["@_PARAM"]); // Prepare with sql injection.
			
			$categorias = new model\Categorias();
			$categorias->setId($request["categorias.id"]);
			$categorias->setCategoria(logicNull($request["categorias.categoria"]));
			
			$where = "categorias.id = " . $request["categorias.id"];
			
			$daoFactory->beginTransaction();
			$categoriasDao = $daoFactory->getCategoriasDao()->read($where, "", false);
			$daoFactory->close();
				
			if (isset($_FILES["upload"])) {
				if ($categoriasDao[0]["categorias.foto"] != "") {	
					unlink($_DOCUMENT_ROOT . "/res/img/ldpi/" . $categoriasDao[0]["categorias.foto"]);
					unlink($_DOCUMENT_ROOT . "/res/img/mdpi/" . $categoriasDao[0]["categorias.foto"]);
					unlink($_DOCUMENT_ROOT . "/res/img/hdpi/" . $categoriasDao[0]["categorias.foto"]);
				}
				
				$upload = new getz\Upload($_FILES["upload"], 1200);
				$categorias->setFoto($upload->getName());
			} else 
				$categorias->setFoto($categoriasDao[0]["categorias.foto"]);
				
			$categorias->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$categorias->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
			$categorias->setCor($request["categorias.cor"]);
			
			$daoFactory->beginTransaction();
			$resultDao = $daoFactory->getCategoriasDao()->update($categorias);

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
			$request["categorias.id"] = $daoFactory->prepare($request["categorias.id"]); // Prepare with sql injection.
				
			$result = true;
			$lines = explode("<gz>", $request["categorias.id"]);

			$daoFactory->beginTransaction();

			for ($i = 0; $i < sizeof($lines); $i++) {
				$where = "categorias.id = " . $lines[$i];
				
				$categoriasDao = $daoFactory->getCategoriasDao()->read($where, "", false);
				
				if ($categoriasDao[0]["categorias.foto"] != "") {	
					unlink($_DOCUMENT_ROOT . "/res/img/ldpi/" . $categoriasDao[0]["categorias.foto"]);
					unlink($_DOCUMENT_ROOT . "/res/img/mdpi/" . $categoriasDao[0]["categorias.foto"]);
					unlink($_DOCUMENT_ROOT . "/res/img/hdpi/" . $categoriasDao[0]["categorias.foto"]);
				}
				
				$resultDao = $daoFactory->getCategoriasDao()->delete($where);
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
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/categorias/categoriasCRT.html", $response);
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
					$response["categorias"] = $daoFactory->getCategoriasDao()->read($where, $limit, true);
					if (!is_array($response["categorias"])) {
						$response["data_not_found"][0]["value"] = "<p>N??o possui registro.</p>";
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/categorias/categoriasRD.html", $response);
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
					$response["categorias"] = $daoFactory->getCategoriasDao()->read($where, "", true);
					$response["categorias"][0]["categorias.cores"] = $daoFactory->getCoresDao()->read("", "cores.id ASC", false);
					for ($x = 0; $x < sizeof($response["categorias"][0]["categorias.cores"]); $x++) {
						if ($response["categorias"][0]["categorias.cores"][$x]["cores.id"] == 
								$response["categorias"][0]["categorias.cor"]) {
							$response["categorias"][0]["categorias.cores"][$x]["cores.selected"] = "selected";
						}
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/categorias/categoriasUPD.html", $response);
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
						$where .= " AND categorias.@_FOREIGN_KEY = " . $base;
					else 
						$where = "categorias.@_FOREIGN_KEY = " . $base;
						
					$daoFactory->beginTransaction();
					$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
					$response["categorias"] = $daoFactory->getCategoriasDao()->read($where, $limit, true);
					if (!is_array($response["categorias"])) {
						$response["data_not_found"][0]["value"] = "<p>N??o possui registro.</p>";
					}
					$daoFactory->close();

					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.html", getMenu($daoFactory, $_USER, $screen));
					echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/categorias/categoriasCLL.html", $response);
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
							$where .= " AND categorias.@_FOREIGN_KEY = " . $arrBase[1];
						else
							$where = "categorias.@_FOREIGN_KEY = " . $arrBase[1];
					}
				}
				
				$limit = "categorias.id DESC LIMIT " . (($position * 5) - 5) . ", 5";

				$daoFactory->beginTransaction();
				$response["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = \"" . $screen . "\"", "", true);
				$response["categorias"] = $daoFactory->getCategoriasDao()->read($where, $limit, true);
				$daoFactory->close();

				echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/categorias/categoriasSCR.html", $response) . 
						"<size>" . (is_array($response["categorias"]) ? $response["categorias"][0]["categorias.size"] : 0) . "<theme>455a64";
			}

			/*
			 * Screen handler
			 */
			else if ($method == "screenHandler") {	
				$where = "";

				// Get value from combo
				$cmb = explode("<gz>", $search);

				if ($cmb[1] != "")
					$where = "categorias.id = " . $cmb[1];

				$daoFactory->beginTransaction();
				$response["categorias"] = $daoFactory->getCategoriasDao()->comboScr($where);
				$daoFactory->close();

				echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/categorias/categoriasCMB.html", $response);
			}

			/*
			 * Create
			 */
			else if ($method == "create") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response["message"] = "permission";
					
					echo $view->json($response);
				} else {
					$categorias = new model\Categorias();
					$categorias->setCategoria(logicNull($form[0]));
					
					/*
					 * Upload File
					 */
					if (isset($_FILES["upload"])) {
						$upload = new getz\Upload($_FILES["upload"], 1200);
						$categorias->setFoto($upload->getName());
					} else 
						$categorias->setFoto("");
						
					$categorias->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$categorias->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$categorias->setCor($form[1]);
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getCategoriasDao()->create($categorias);

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
					$categorias = new model\Categorias();
					$categorias->setId($code);
					$categorias->setCategoria(logicNull($form[0]));
					
					/*
					 * Get object
					 */
					$where = "categorias.id = " . $code;
					
					$daoFactory->beginTransaction();
					$categoriasDao = $daoFactory->getCategoriasDao()->read($where, "", false);
					$daoFactory->close();
						
					/*
					 * Upload File
					 */
					if (isset($_FILES["upload"])) {
						if ($categoriasDao[0]["categorias.foto"] != "") {	
							/*
							 * Unlink
							 */
							unlink($_DOCUMENT_ROOT . "/res/img/ldpi/" . $categoriasDao[0]["categorias.foto"]); 
							unlink($_DOCUMENT_ROOT . "/res/img/mdpi/" . $categoriasDao[0]["categorias.foto"]);
							unlink($_DOCUMENT_ROOT . "/res/img/hdpi/" . $categoriasDao[0]["categorias.foto"]);
						}
						
						$upload = new getz\Upload($_FILES["upload"], 1200);
						$categorias->setFoto($upload->getName());
					} else 
						$categorias->setFoto($categoriasDao[0]["categorias.foto"]);
						
					$categorias->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$categorias->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$categorias->setCor($form[1]);
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getCategoriasDao()->update($categorias);

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
						$where = "categorias.id = " . $lines[$i];
						
						/*
						 * Unlink
						 */
						$categoriasDao = $daoFactory->getCategoriasDao()->read($where, "", false);
						
						if ($categoriasDao[0]["categorias.foto"] != "") {	
							unlink($_DOCUMENT_ROOT . "/res/img/ldpi/" . $categoriasDao[0]["categorias.foto"]);
							unlink($_DOCUMENT_ROOT . "/res/img/mdpi/" . $categoriasDao[0]["categorias.foto"]);
							unlink($_DOCUMENT_ROOT . "/res/img/hdpi/" . $categoriasDao[0]["categorias.foto"]);
						}
						
						$resultDao = $daoFactory->getCategoriasDao()->delete($where);
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