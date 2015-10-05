<form id="login-form" method="POST" action="/login">
    <?php if($this->keeper->has('error_msg_login')): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times"></i> <?=$this->keeper->get('error_msg_login')?>
                </div>
            </div><!--/.col-md-12-->
        </div><!--/.row-->
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group<?=($this->keeper->has('login_email_error'))?' has-error':''?>">
                <input type="email" value="<?=$this->keeper->has('login_email_value')?$this->keeper->get('login_email_value'):''?>" name="login_email" id="login_email" class="form-control" placeholder="Email" />
                <?=($this->keeper->has('login_email_error'))?$this->keeper->get('login_email_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-md-12-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="form-group<?=($this->keeper->has('login_password_error'))?' has-error':''?>">
                <input type="password" name="login_password" id="login_password" class="form-control" placeholder="Password" />
                <?=($this->keeper->has('login_password_error'))?$this->keeper->get('login_password_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-md-12-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="remember-me" class="checkbox-inline"><input id="remember-me" type="checkbox" name="rememberMe" value="yes">Keep me logged in</label>
            </div><!--/.form-group-->
        </div><!--/.col-md-12-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Sign in</button> or <a href="/" class="blue-anchor">Sign up on UOM-Connect</a>
            </div><!--/.form-group-->
        </div><!--/.col-md-12-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="#" class="blue-anchor">Forgot your password?</a>
            </div>
        </div><!--/.col-md-12-->
    </div><!--/.row-->

</form>