<form id="signup-form" method="POST" action="<?=base_url()?>sign-up" autocomplete="off">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group<?=($this->keeper->has('firstName_error'))?' has-error':''?>">
                <input type="text" class="form-control" name="firstName" value="<?=$this->keeper->has('firstName_value')?$this->keeper->get('firstName_value'):''?>" placeholder="First name" />
                <?=($this->keeper->has('firstName_error'))?$this->keeper->get('firstName_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-sm-6-->
        <div class="col-sm-6">
            <div class="form-group<?=($this->keeper->has('lastName_error'))?' has-error':''?>">
                <input type="text" class="form-control" name="lastName" value="" placeholder="Last name" />
                <?=($this->keeper->has('lastName_error'))?$this->keeper->get('lastName_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-sm-6-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group<?=($this->keeper->has('email_error'))?' has-error':''?>">
                <input type="email" class="form-control" name="email" value="" placeholder="Email" />
                <?=($this->keeper->has('email_error'))?$this->keeper->get('email_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-sm-12-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group<?=($this->keeper->has('password_error'))?' has-error':''?>">
                <input type="password" class="form-control" name="password" value="" placeholder="Password">
                <?=($this->keeper->has('password_error'))?$this->keeper->get('password_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-sm-12-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group<?=($this->keeper->has('confirmPassword_error'))?' has-error':''?>">
                <input type="password" class="form-control" name="confirmPassword" value="" placeholder="Confirm password">
                <?=($this->keeper->has('confirmPassword_error'))?$this->keeper->get('confirmPassword_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-sm-12-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-2">
            <label for="user-type">Are you?</label>
        </div><!--/.col-sm-2-->
        <div class="col-sm-10">
            <div class="form-group<?=($this->keeper->has('userType_error'))?' has-error':''?>">
                <select id="user-type" name="userType" class="form-control">
                    <option value="student">Student</option>
                    <option value="lecturer">Lecturer</option>
                </select>
                <?=($this->keeper->has('userType_error'))?$this->keeper->get('userType_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-sm-10-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-2">
            <label>Birthday</label>
        </div><!--/.col-sm-2-->
        <div class="col-sm-3">
            <div class="form-group<?=($this->keeper->has('DOBDay_error'))?' has-error':''?>">
                <select name="DOBDay" id="DOB-day" class="form-control">
                    <option value="">Day</option>
                    <?php foreach(range(1,31) as $day): ?>
                        <option value="<?=$day?>"><?=$day?></option>
                    <?php endforeach; ?>
                </select>
                <?=($this->keeper->has('DOBDay_error'))?$this->keeper->get('DOBDay_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-sm-3-->
        <div class="col-sm-4">
            <div class="form-group<?=($this->keeper->has('DOBMonth_error'))?' has-error':''?>">
                <select name="DOBMonth" id="DOBMonth" class="form-control">
                    <option value="">Month</option>
                    <?php for ($m=1; $m<=12; $m++): ?>
                        <option value="<?=$m?>"><?=date('F', mktime(0,0,0,$m, 1, date('Y')));?></option>
                    <?php endfor; ?>
                </select>
                <?=($this->keeper->has('DOBMonth_error'))?$this->keeper->get('DOBMonth_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-sm-4-->
        <div class="col-sm-3">
            <div class="form-group<?=($this->keeper->has('DOBYear_error'))?' has-error':''?>">
                <select name="DOBYear" id="DOBYear" class="form-control">
                    <option value="">Year</option>
                    <?php foreach(range(date('Y') - 18, date('Y') - 100 ) as $year): ?>
                        <option value="<?=$year?>"><?=$year?></option>
                    <?php endforeach; ?>
                </select>
                <?=($this->keeper->has('DOBYear_error'))?$this->keeper->get('DOBYear_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-sm-3-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-2">
            <label>Gender</label>
        </div><!--/.col-sm-2-->
        <div class="col-sm-10">
            <div class="form-group<?=($this->keeper->has('gender_error'))?' has-error':''?>">
                <label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
                &nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="gender" value="male">Male</label>
                <?=($this->keeper->has('gender_error'))?$this->keeper->get('gender_error'):''?>
            </div><!--/.form-group-->
        </div><!--/.col-sm-10-->
    </div><!--/.row-->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group<?=($this->keeper->has('uomId_error'))?' has-error':''?>">
                <input type="text" name="uomId" class="form-control" value="" placeholder="UOM student's or lecturer's ID">
                <?=($this->keeper->has('uomId_error'))?$this->keeper->get('uomId_error'):''?>
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