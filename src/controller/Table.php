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

	
	if($search != ""){

		$daoFactory->beginTransaction();

		$response["produtoSelect"] = $daoFactory->getProdutosDao()->read("produtos.produto LIKE \"%" . $search . "%\"", "produtos.produto ASC", true);

		$daoFactory->close();
		
	}
	

	if ($method == "page") {
		
		$daoFactory->beginTransaction();
		
		// $response["estabelecimentos_produtos_preco"] = $daoFactory->getEstabelecimento_produtos_precoDao()->read("", "produtos.id ASC", true);

		for ($x = 0; $x < sizeof($response["produtoSelect"]); $x++) {
			$response["produtoSelect"][$x]["estabelecimentos"] = $daoFactory->getEstabelecimento_produtosDao()->read(
					"estabelecimento_produtos.produto = " . $response["produtoSelect"][$x]["produtos.id"], "", true);
		}

		$daoFactory->close();

		$response["print"] = "true";
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/header.html");
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/table.html", $response);
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/table_dinamic.html", $response);
		echo $view->parse($_DOCUMENT_ROOT . $_PACKAGE . "/html/footer.html");
	}

?>