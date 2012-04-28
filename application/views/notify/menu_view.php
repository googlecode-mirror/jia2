<div id="notify_menu" class="search_item">
	<ul>
		<li class="sd01" id="notify_01">
			<a href="#" id="active">站内信</a>
		</li>
		<li class="sd02" id="notify_02">
			<a href="#">请求</a>
		</li>
		<li class="sd02" id="notify_03">
			<a href="#">消息</a>
		</li>
	</ul>
</div>
<div class="tab_cont_box user_setting">
	<div id="letter"><? $this->load->view('notifay/letter_view') ?></div>
	<div id="request" class="hidden"><? $this->load->view('notifay/request_view') ?></div>
	<div id="message" class="hidden"><? $this->load->view('notifay/massage_view') ?></div>
</div>
<script>
window.onload = function() {
	var SDmodel = new scrollDoor();
	SDmodel.sd(["notify_01", "notify_02", "notify_03"], ["letter", "request", "message"], "sd01", "sd02");	
}
</script>