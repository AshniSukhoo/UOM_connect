<form method="post" action="<?=base_url()?>user-actions/save-basic-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-info"></i> Editing basic information</h4>
        </div><!--/.panel-heading-->
        <div class="panel-body">
	        <div class="row">
		        <div class="col-md-12">
			        <div class="form-group<?=($this->keeper->has('country_error'))?' has-error':''?>">
				        <div class="input-group">
					        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-globe"></i></span>
					        <input type="text" name="country" placeholder="Enter your country name" class="form-control" value="<?=$this->keeper->has('country')?$this->keeper->get('country'):(($profileOwner->basicInfo != null && $profileOwner->basicInfo->country != '')?$profileOwner->basicInfo->country:'')?>" />
				        </div><!--/.input=-group--->
			        </div><!--/.form-group-->

			        <div class="form-group<?=($this->keeper->has('city_error'))?' has-error':''?>">
				        <div class="input-group">
					        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-building"></i></span>
					        <input type="text" name="city" placeholder="Enter your city name" class="form-control" value="<?=$this->keeper->has('city')?$this->keeper->get('city'):(($profileOwner->basicInfo != null && $profileOwner->basicInfo->city != '')?$profileOwner->basicInfo->city:'')?>" />
				        </div><!--/.input-group-->
			        </div><!--/.form-group-->

			        <div class="form-group">
				        <div class="input-group">
					        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
					        <input type="text" name="address" placeholder="Enter your postal address" class="form-control" value="<?=$this->keeper->has('address')?$this->keeper->get('address'):(($profileOwner->basicInfo != null && $profileOwner->basicInfo->address != '')?$profileOwner->basicInfo->address:'')?>" />
				        </div><!--/.input-group-->
			        </div><!--/.form-group-->

			        <div class="form-group" style="width: inherit">
				        <div class="input-group">
					        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
					        <input type="text" name="emails" placeholder="Type email address and press enter to add" class="form-control" value="<?=$this->keeper->has('emails')?$this->keeper->get('emails'):(($profileOwner->basicInfo != null && $profileOwner->basicInfo->emails != '')?rtrim($profileOwner->basicInfo->emails->reduce(function($results, $item) {
						        return $results.$item.',';
					        }, ''), ','):'')?>" />
				        </div><!--/.input-group-->
			        </div><!--/.form-group-->
		        </div><!--/.col-md-12-->
	        </div><!--.row-->
        </div><!--/panel-body-->
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/about" class="btn btn-default">
                        <i class="fa fa-times"></i> Cancel
                    </a>
                </div><!--/.col-md-12-->
            </div><!--/.row-->
        </div><!--/.panel-footer-->
    </div><!--/.panel-default-->
</form>