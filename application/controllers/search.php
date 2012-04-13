<?php
	class Search extends MY_Controller {
		public $jiadb;
		public $limit = 10;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb;
		}
		
		function index() {
			$data['main_content'] = 'search_view';
			$data['title'] = '搜索';
			$data['css'] = array('common.css','index.css','search.css');
			$data['js'] = array('search.js','tab.js');
			if($this->input->post('keywords')) {
				$user_result = $this->_user();
				$data['user_rows'] = $user_result['rows'];
				unset($user_result['rows']);
				$data['user_result'] = $user_result;
			}
			$this->load->view('includes/template_view', $data);
		}
		
		function do_search() {
			$this->_require_ajax();
			$object = $this->input->post('object');
			$keywords = $this->input->post('keywords');
			$limit = 10;
			$offset = $this->input->post('offsect') ? $this->input->post('offsect') : 0;
			switch ($object) {
				case 'user':
					// 搜索用户
					$user_result = $this->_user();
					$user_rows = $user_result['rows'];
					unset($user_result['rows']);
					foreach($user_result as $row) {
					?>
					<li>
						<div>
							<h3><?=$row['name'] ?></h3>
							<img src="<?=$row['avatar']?>" />
						</div>
					</li>
					<?
					}
					break;
				case 'corporation':
					// 搜索社团
					break;
				case 'activity':
					// 搜索社团
					break;
				default:
					// 三个都搜索
					$user_result = $this->_user();
					$user_rows = $user_result['rows'];
					unset($user_result['rows']);
					foreach($user_result as $row) {
					?>
					<li>
						<div>
							<h3><?=$row['name'] ?></h3>
							<img src="<?=avatar_url($row['avatar'], 'personal', 'big') ?>" />
						</div>
					</li>
					<?
					}
					break;
			}
		}
		
		function _user() {
			$keywords = $this->input->post('keywords');
			$offset = $this->input->post('offset');
			$this->jiadb->_table = 'user';
			$where = array('name REGEXP' => $keywords);
			$user_result = $this->jiadb->fetchAll($where, '', array($this->limit, $offset));
			if($user_result) {
				$user_result['rows'] = count_rows('user', $where);
			} else {
				$user_result['rows'] = 0;
			}
			return $user_result;
		}
		
		function _corporation() {
			
		}
		
		function _activity() {
			
		}
	}
