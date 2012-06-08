<?php
	class MY_Model extends CI_Model {
		function __construct() {
			parent::__construct();
			$entity_type = $this->db->get('entity_type')->result_array();
			foreach ($entity_type as $row) {
				$this->config->set_item('entity_type_' . $row['name'], $row['id']);
			}
		}
	}
