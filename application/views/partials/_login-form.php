<form id="login-form" method="POST" action="/login" class="navbar-form navbar-right">
    <div class="form-group">
        <input name="email" type="text" class="form-control" placeholder="Email" value="" />
        <br/>
        <label class="checkbox-inline"><input type="checkbox" name="rememberMe" value="yes">Keep me logged in</label>
    </div><!--/.form-group-->
    &nbsp;&nbsp;
    <div class="form-group">
        <input name="password" type="password" class="form-control" placeholder="Password" value="">
        <br>
        <label>
            <a href="#" style="color: #ffffff;cursor: pointer">Forgot your password?</a>
        </label>
    </div><!--/.form-group-->
    &nbsp;&nbsp;
    <div class="form-group">
        <button type="submit" class="btn btn-primary navbar-btn">
            <i class="fa fa-sign-in"></i> Sign in
        </button>
        <br>
        <label></label>
    </div>
</form>