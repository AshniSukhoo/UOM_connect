<form method="post" action="<?=base_url()?>user-actions/save-edit-education/<?=$education->id?>" autocomplete="off">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-suitcase"></i> Editing Education Skill</h4>
        </div><!--/.panel-heading-->
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group<?=($this->keeper->has('institution_name_error'))?' has-error':''?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-institution"></i></span>
                            <input type="text" name="institution_name" placeholder="Enter the name of the institution attended"
                                   class="form-control"
                                   value="<?=$this->keeper->has('institution_name')?$this->keeper->get('institution_name'):$education->institution_name?>" />
                        </div><!--/.input=-group--->
                        <?=($this->keeper->has('institution_name_error'))?$this->keeper->get('institution_name_error'):''?>
                    </div><!--/.form-group-->

                    <div class="form-group<?=($this->keeper->has('major_error'))?' has-error':''?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-book"></i></span>
                            <input type="text" name="major" placeholder="Enter the major subject studied or degree"
                                   class="form-control"
                                   value="<?=$this->keeper->has('major')?$this->keeper->get('major'):$education->major?>" />
                        </div><!--/.input=-group--->
                        <?=($this->keeper->has('major_error'))?$this->keeper->get('major_error'):''?>
                    </div><!--/.form-group-->

                    <div class="form-group<?=($this->keeper->has('year_joined_error'))?' has-error':''?>">
                        <select name="year_joined" id="year_joined" class="form-control">
                            <option value="">Year started</option>
                            <?php foreach(range(date('Y'), date('Y') - 100 ) as $year): ?>
                                <option value="<?=$year?>"
                                    <?=($this->keeper->has('year_joined_value') && $this->keeper->get('year_joined_value') == $year)?'selected':($education->year_joined == $year)?'selected':''?>>
                                    <?=$year?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?=($this->keeper->has('year_joined_error'))?$this->keeper->get('year_joined_error'):''?>
                    </div><!--/.form-group-->

                    <div class="form-group<?=($this->keeper->has('year_left_error'))?' has-error':''?>">
                        <select name="year_left" id="year_left" class="form-control">
                            <option value="">Year completed</option>
                            <?php foreach(range(date('Y'), date('Y') - 100 ) as $year): ?>
                                <option value="<?=$year?>"
                                    <?=($this->keeper->has('year_left_value') && $this->keeper->get('year_left_value') == $year)?'selected':($education->year_left != null && $education->year_left != '' && $education->year_left == $year)?'selected':''?>>
                                    <?=$year?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted"><sup>#</sup>Leave unselected if still studying</small>
                        <?=($this->keeper->has('year_left_error'))?$this->keeper->get('year_left_error'):''?>
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