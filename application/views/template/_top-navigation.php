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
            <form class="navbar-form navbar-left">
                <div class="input-group input-group-sm" style="max-width:360px;">
                    <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav">
                <li>
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="#postModal" role="button" data-toggle="modal"><i class="fa fa-plus"></i> Post</a>
                </li>
                <li>
                    <a href="#"><span class="badge">badge</span></a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="">More</a></li>
                        <li><a href="">More</a></li>
                        <li><a href="">More</a></li>
                        <li><a href="">More</a></li>
                        <li><a href="">More</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
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
            <nav class="collapse navbar-collapse" role="navigation">
                <?php include(APPPATH.'views/partials/_login-form.php'); ?>
            </nav>
        </div><!--/.container-->
    <?php endif; ?>
</div>
<!-- /top nav -->