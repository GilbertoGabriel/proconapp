<?php 
			
	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mario Sakamoto <mskamot@gmail.com>
	 * @see https://wtag.com.br/getz
	 */
	 
	namespace src\model; 

	class Estabelecimento_produtos_preco {
			
		private $id;
		private $preco;
		private $cadastrado;
		private $modificado;
		private $estabelecimeto_produto;
			
		public function __construct() { }
			
		public function setId($id) {
			$this->id = $id;
		}
		
		public function getId() {
			return $this->id;
		}
					
		public function setPreco($preco) {
			$this->preco = $preco;
		}
		
		public function getPreco() {
			return $this->preco;
		}
					
		public function setCadastrado($cadastrado) {
			$this->cadastrado = $cadastrado;
		}
		
		public function getCadastrado() {
			return $this->cadastrado;
		}
					
		public function setModificado($modificado) {
			$this->modificado = $modificado;
		}
		
		public function getModificado() {
			return $this->modificado;
		}
					
		public function setEstabelecimeto_produto($estabelecimeto_produto) {
			$this->estabelecimeto_produto = $estabelecimeto_produto;
		}
		
		public function getEstabelecimeto_produto() {
			return $this->estabelecimeto_produto;
		}
					
	}
	
?>