<!-- top nav -->
<div class="navbar navbar-blue navbar-static-top">
    <?php if($this->auth->check()): ?>
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand logo">UC</a>
        </div>
        <nav class="collapse navbar-collapse" role="navigation">
            <form class="navbar-form navbar-left" method="get" action="<?=base_url('search-users')?>" autocomplete="off">
                <div class="input-group input-group-sm" style="max-width:360px;">
                    <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" value="<?=($this->input->get('srch-term') != false) ? $this->input->get('srch-term') : ''?>">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?=($this->auth->user()->user_type == 'student')?'/student-profile/':'/lecturer-profile/';?><?=$this->auth->user()->id?>">
                        <i class="fa fa-user"></i> <?=$this->auth->user()->first_name?>
                    </a>
                </li>
                <li>
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url('change-password')?>"><i class="fa fa-keyboard-o"></i> Change Password</a></li>
                        <li><a href="<?=base_url('passwords/reset')?>"><i class="fa fa-key"></i> Forgot Password</a></li>
                        <li><a href="<?=base_url('contact-us')?>"><i class="fa fa-question-circle"></i> Help</a></li>
                        <li><a href="<?=base_url('logout')?>"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </li>
            </ul><!--/.nav navbar-nav navbar-right-->
        </nav><!--/nav-->
    <?php else: ?>
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand logo my-logo-navbrand">
                    UOM-Connect
                </a>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <?php if(!isset($noNavLogin) || $noNavLogin == false): ?>
                <nav class="collapse navbar-collapse" role="navigation">
                    <?php $this->load->view('partials/_login-form'); ?>
                </nav>
            <?php endif; ?>
        </div><!--/.container-->
    <?php endif; ?>
</div>
<!-- /top nav -->
