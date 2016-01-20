<form method="post" action="<?=base_url()?>user-actions/save-new-work" autocomplete="off">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-suitcase"></i> Adding Work information</h4>
        </div><!--/.panel-heading-->
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group<?=($this->keeper->has('job_title_error'))?' has-error':''?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-"></i></span>
                            <input type="text" name="job_title" placeholder="Enter job title" class="form-control" value="<?=$this->keeper->has('job_title')?$this->keeper->get('job_title'):''?>" />
                        </div><!--/.input=-group--->
                        <?=($this->keeper->has('job_title_error'))?$this->keeper->get('job_title_error'):''?>
                    </div><!--/.form-group-->

                    <div class="form-group<?=($this->keeper->has('company_name_error'))?' has-error':''?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-"></i></span>
                            <input type="text" name="company_name" placeholder="Enter the name of the company you work for" class="form-control" value="<?=$this->keeper->has('company_name')?$this->keeper->get('company_name'):''?>" />
                        </div><!--/.input=-group--->
                        <?=($this->keeper->has('company_name_error'))?$this->keeper->get('company_name_error'):''?>
                    </div><!--/.form-group-->

                    <div class="form-group<?=($this->keeper->has('date_joined_error'))?' has-error':''?>">
                        <select name="date_joined" id="date_joined" class="form-control">
                            <option value="">Year started</option>
                            <?php foreach(range(date('Y'), date('Y') - 100 ) as $year): ?>
                                <option value="<?=$year?>" <?=($this->keeper->has('date_joined_value') && $this->keeper->get('date_joined_value') == $year)?'selected':''?>><?=$year?></option>
                            <?php endforeach; ?>
                        </select>
                        <?=($this->keeper->has('date_joined_error'))?$this->keeper->get('date_joined_error'):''?>
                    </div><!--/.form-group-->

                    <div class="form-group<?=($this->keeper->has('date_left_error'))?' has-error':''?>">
                        <select name="date_left" id="date_left" class="form-control">
                            <option value="">Year left</option>
                            <?php foreach(range(date('Y'), date('Y') - 100 ) as $year): ?>
                                <option value="<?=$year?>" <?=($this->keeper->has('date_left_value') && $this->keeper->get('date_left_value') == $year)?'selected':''?>><?=$year?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted"><sup>#</sup>Leave unselected if still working</small>
                        <?=($this->keeper->has('date_left_error'))?$this->keeper->get('date_left_error'):''?>
                    </div><!--/.form-group-->

                </div><!--/.col-md-12-->
            </div><!--/.row-->
        </div><!--/.panel-body-->
        <?php if($profileOwner->is($this->auth->user())): ?>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">
                            <i class="fa fa-save"></i> Save
                        </button>
                        <a href="<?=$this->auth->user()->profile_uri.'/about'?>" class="btn btn-default">
                            <i class="fa fa-times"></i> Cancel
                        </a>
                    </div><!--/.col-md-12-->
                </div><!--/.row-->
            </div><!--/.panel-footer-->
        <?php endif; ?>
    </div><!--/.panel-->
</form>