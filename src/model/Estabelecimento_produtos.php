<?php 
			
	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mario Sakamoto <mskamot@gmail.com>
	 * @see https://wtag.com.br/getz
	 */
	 
	namespace src\model; 

	class Estabelecimento_produtos {
			
		private $id;
		private $cadastrado;
		private $modificado;
		private $estabelecimento;
		private $produto;
			
		public function __construct() { }
			
		public function setId($id) {
			$this->id = $id;
		}
		
		public function getId() {
			return $this->id;
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
					
		public function setEstabelecimento($estabelecimento) {
			$this->estabelecimento = $estabelecimento;
		}
		
		public function getEstabelecimento() {
			return $this->estabelecimento;
		}
					
		public function setProduto($produto) {
			$this->produto = $produto;
		}
		
		public function getProduto() {
			return $this->produto;
		}
					
	}
	
?>