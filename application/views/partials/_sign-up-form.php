<form id="signup-form" method="POST" action="<?=base_url()?>sign-up">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="firstName" value="" placeholder="First name" />
            </div><!--/.form-group-->
        </div><!--/.col-sm-6-->
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="lastName" value="" placeholder="Last name" />
            </div><!--/.form-group-->
        </div><!--/.col-sm-6-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="email" class="form-control" name="email" value="" placeholder="Email" />
            </div><!--/.form-group-->
        </div><!--/.col-sm-12-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="password" class="form-control" name="password" value="" placeholder="Password">
            </div><!--/.form-group-->
        </div><!--/.col-sm-12-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="password" class="form-control" value="" placeholder="Confirm password">
            </div><!--/.form-group-->
        </div><!--/.col-sm-12-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-2">
            <label for="user-type">Are you?</label>
        </div><!--/.col-sm-2-->
        <div class="col-sm-10">
            <div class="form-group">
                <select id="user-type" name="userType" class="form-control">
                    <option value="student">Student</option>
                    <option value="lecturer">Lecturer</option>
                </select>
            </div><!--/.form-group-->
        </div><!--/.col-sm-10-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-2">
            <label>Birthday</label>
        </div><!--/.col-sm-2-->
        <div class="col-sm-3">
            <div class="form-group">
                <select name="DOBDay" id="DOB-day" class="form-control">
                    <option value="">Day</option>
                    <?php foreach(range(1,31) as $day): ?>
                        <option value="<?=$day?>"><?=$day?></option>
                    <?php endforeach; ?>
                </select>
            </div><!--/.form-group-->
        </div><!--/.col-sm-3-->
        <div class="col-sm-4">
            <div class="form-group">
                <select name="DOBMonth" id="DOBMonth" class="form-control">
                    <option value="">Month</option>
                    <?php for ($m=1; $m<=12; $m++): ?>
                        <option value="<?=$m?>"><?=date('F', mktime(0,0,0,$m, 1, date('Y')));?></option>
                    <?php endfor; ?>
                </select>
            </div><!--/.form-group-->
        </div><!--/.col-sm-4-->
        <div class="col-sm-3">
            <div class="form-group">
                <select name="DOBYear" id="DOBYear" class="form-control">
                    <option value="">Year</option>
                    <?php foreach(range(date('Y') - 18, date('Y') - 100 ) as $year): ?>
                        <option value="<?=$year?>"><?=$year?></option>
                    <?php endforeach; ?>
                </select>
            </div><!--/.form-group-->
        </div><!--/.col-sm-3-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-2">
            <label>Gender</label>
        </div><!--/.col-sm-2-->
        <div class="col-sm-10">
            <div class="form-group">
                <label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
                &nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="gender" value="male">Male</label>
            </div><!--/.form-group-->
        </div><!--/.col-sm-10-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="text" name="uomId" class="form-control" value="" placeholder="UOM student's or lecturer's ID">
            </div><!--/.form-group-->
        </div><!--/.col-sm-12-->
    </div><!--/.row-->

    <div class="row" style="margin-top: 20px;">
        <div class="col-sm-5 col-sm-offset-4">
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success sign-up-btn">
                    <i class="fa fa-briefcase"></i> Sign up
                </button>
            </div><!--/.form-group-->
        </div>
    </div><!--/.row-->

    <hr />
</form>