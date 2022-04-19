<?php

	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mario Sakamoto <mskamot@gmail.com>
	 * @see https://wtag.com.br/getz
	 */

	use lib\getz;
	use src\model;	 
	 
	require_once($_DOCUMENT_ROOT . "/lib/getz/Activator.php");

	if ($method == "page") {
		$daoFactory->beginTransaction();
		$response["produtos"] = $daoFactory->getProdutosDao()->read("", "produtos.id ASC", true);
        
		$daoFactory->close();
		
		$response["print"] = "true";
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/header.html");
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/table.html", $response);
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/footer.html");
	}

?>