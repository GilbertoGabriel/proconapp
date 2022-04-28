<?php 

	/**
	 * Generated by Getz Framework 
	 *
	 * @author Mario Sakamoto <mskamot@gmail.com>
	 * @see https://wtag.com.br/getz
	 */
	 
	/*
	 * SPL
	 */	 	
	spl_autoload_register(function ($class) {
		require_once("../../" . $class . ".php");
	});	 
			
	use lib\getz;
			
	$table = "estabelecimento_produtos_preco";
			
	/*
	 * $fields = array("field" => "type");
	 *
	 * types: string16, string32, string64,
	 * integer, double,
	 * date, datetime, time, new, now,
	 * email, cpf, cnpj, cep, phone, cellphone,
	 * photo, photoWithPosition, position, upload
	 */ 
	$fields = array("id" => "integer",
			"preco" => "double",
			"cadastrado" => "new",
			"modificado" => "now"
	);
				
	/*
	 *$fk = array("table" => "field");
	 */
	$fk = array("estabelecimento_produtos" => "estabelecimeto_produtos"
	);
			
	/*
	 * $fkFields = array("field" => "type");
	 *
	 * types: session, base, standard, advanced, autocomplete
	 */ 
	$fkFields = array("estabelecimento_produtos" => "standard"
	);
				
	// Set the table if this screen call another
	$call = "";
	
	// Set the column for answer after the call
	$answer = "estabelecimento_produtos";

	/*
	 * Builder
	 */
	$builder = new getz\Builder();
	$builder->model($table, $fields, $fk);
	$builder->view($table, $fields, $fk, $fkFields, $call);
	$builder->controller($table, $fields, $fk, $fkFields, $answer);
	$builder->dao($table, $fields, $fk);	 
	$builder->handler($table, $fields, $fk);
	$builder->response($table, $fields, $fk);
	$builder->daoFactory($table, $fields, $fk);
				
?>