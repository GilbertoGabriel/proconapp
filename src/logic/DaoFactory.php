<?php

	/**
	 * Dao Factory
	 * 
	 * @author Mario Sakamoto <mskamot@gmail.com>
	 * @see https://wtag.com.br/getz 
	 */
	 
	namespace src\logic;

	use lib\getz;	
	use src\logic;
	use src\model;	
	
	class DaoFactory extends getz\Dao {
	
		public function __construct($_DAO_FACTORY_IS_OFFICIAL) {
			parent::__construct(new logic\Connection($_DAO_FACTORY_IS_OFFICIAL));
		}

		/*
		 * Generated by Getz
		 */
		
		public function getCategoriasDao() {
			return new model\CategoriasDao($this->getConnection());
		}
		
		public function getCoresDao() {
			return new model\CoresDao($this->getConnection());
		}
		
		public function getEnderecosDao() {
			return new model\EnderecosDao($this->getConnection());
		}
		
		public function getEstabelecimentosDao() {
			return new model\EstabelecimentosDao($this->getConnection());
		}
		
		public function getMarcasDao() {
			return new model\MarcasDao($this->getConnection());
		}
		
		public function getMenusDao() {
			return new model\MenusDao($this->getConnection());
		}
		
		public function getPerfil_telaDao() {
			return new model\Perfil_telaDao($this->getConnection());
		}
		
		public function getPerfisDao() {
			return new model\PerfisDao($this->getConnection());
		}
		
		public function getPermissoesDao() {
			return new model\PermissoesDao($this->getConnection());
		}
		
		public function getProduto_precosDao() {
			return new model\Produto_precosDao($this->getConnection());
		}
		
		public function getProdutosDao() {
			return new model\ProdutosDao($this->getConnection());
		}
		
		public function getSituacoes_registrosDao() {
			return new model\Situacoes_registrosDao($this->getConnection());
		}
		
		public function getTelasDao() {
			return new model\TelasDao($this->getConnection());
		}
		
		public function getUsuariosDao() {
			return new model\UsuariosDao($this->getConnection());
		}
		
		public function getCardsDao() {
			return new model\CardsDao($this->getConnection());
		}
		
		public function getEstabelecimento_produtosDao() {
			return new model\Estabelecimento_produtosDao($this->getConnection());
		}
		
		public function getEstabelecimento_produtos_precoDao() {
			return new model\Estabelecimento_produtos_precoDao($this->getConnection());
		}
		
	}
	
?>