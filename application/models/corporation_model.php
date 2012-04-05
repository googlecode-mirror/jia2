<?php
	class Corporation_model extends CI_Model {
		protected $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('Corporation');
		}
		
		function fetch() {
			
		}
	}
