<form id="login-form" method="POST" action="/login" class="navbar-form navbar-right">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <input type="email" class="form-control input-sm" name="login_email" value="" placeholder="Email" />
                <br/>
                <label for="remember-me" class="checkbox-inline"><input id="remember-me" type="checkbox" name="rememberMe" value="yes">Keep me logged in</label>
            </div><!--/.form-group-->
            &nbsp;&nbsp;
            <div class="form-group">
                <input name="login_password" type="password" id="login_password" class="form-control input-sm" placeholder="Password" value="">
                <br/>
                <label class="checkbox-inline">
                    <a href="<?=base_url('passwords/reset')?>" style="color: #ffffff;cursor: pointer">Forgot your password?</a>
                </label>
            </div><!--/.form-group-->
            &nbsp;&nbsp;
            <div class="form-group">
                <button type="submit" class="btn btn-primary navbar-btn btn-sm">
                    <i class="fa fa-sign-in"></i> Sign in
                </button>
                <br/>
                <label></label>
            </div><!--/.form-group-->
        </div><!--/.col-md-12-->
    </div><!--/.row-->
</form>
