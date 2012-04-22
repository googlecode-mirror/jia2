<? $this->load->view('includes/header_view') ?>
<? $this->load->view('includes/css_view') ?>
<? $this->load->view('includes/js_view') ?>
<body>
<div id="content">
<? if($this->uri->segment(2) != 'login' && $this->uri->segment(2) != 'regist'): ?>
<? $this->load->view('includes/nav_view') ?>
<? endif ?>
<div id="container">
<? $this->load->view($main_content) ?> 
<? $this->load->view('includes/slider_bar_view') ?> 
</div>
</div>
<? $this->load->view('includes/footer_view') ?>
</body>
</html>