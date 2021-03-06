<?php 
			
	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mario Sakamoto <mskamot@gmail.com>
	 * @see https://wtag.com.br/getz
	 */
	 
	namespace src\model; 

	class Estabelecimentos {
			
		private $id;
		private $estabelecimento;
		private $cnpj;
		private $telefone;
		private $celular;
		private $celular2;
		private $email;
		private $cadastrado;
		private $modificado;
		private $logradouro;
		private $bairro;
		private $numero;
		private $cidade;
		private $cep;
			
		public function __construct() { }
			
		public function setId($id) {
			$this->id = $id;
		}
		
		public function getId() {
			return $this->id;
		}
					
		public function setEstabelecimento($estabelecimento) {
			$this->estabelecimento = $estabelecimento;
		}
		
		public function getEstabelecimento() {
			return $this->estabelecimento;
		}
					
		public function setCnpj($cnpj) {
			$this->cnpj = $cnpj;
		}
		
		public function getCnpj() {
			return $this->cnpj;
		}
					
		public function setTelefone($telefone) {
			$this->telefone = $telefone;
		}
		
		public function getTelefone() {
			return $this->telefone;
		}
					
		public function setCelular($celular) {
			$this->celular = $celular;
		}
		
		public function getCelular() {
			return $this->celular;
		}
					
		public function setCelular2($celular2) {
			$this->celular2 = $celular2;
		}
		
		public function getCelular2() {
			return $this->celular2;
		}
					
		public function setEmail($email) {
			$this->email = $email;
		}
		
		public function getEmail() {
			return $this->email;
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
					
		public function setLogradouro($logradouro) {
			$this->logradouro = $logradouro;
		}
		
		public function getLogradouro() {
			return $this->logradouro;
		}
					
		public function setBairro($bairro) {
			$this->bairro = $bairro;
		}
		
		public function getBairro() {
			return $this->bairro;
		}
					
		public function setNumero($numero) {
			$this->numero = $numero;
		}
		
		public function getNumero() {
			return $this->numero;
		}
					
		public function setCidade($cidade) {
			$this->cidade = $cidade;
		}
		
		public function getCidade() {
			return $this->cidade;
		}
					
		public function setCep($cep) {
			$this->cep = $cep;
		}
		
		public function getCep() {
			return $this->cep;
		}
					
	}
	
?>