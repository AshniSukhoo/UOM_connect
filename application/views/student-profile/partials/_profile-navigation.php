<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#student-profile-nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="student-profile-nav">
            <ul class="nav navbar-nav">
                <li <?=(isset($profileMenu) && $profileMenu == 1)?'class="active"':''?>>
                    <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/timeline">
                        <i class="fa fa-bars"></i> Timeline
                        <?=(isset($profileMenu) && $profileMenu == 1)?'<span class="sr-only">(current)</span>':''?>
                    </a>
                </li>
                <li <?=(isset($profileMenu) && $profileMenu == 2)?'class="active"':''?>>
                    <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/about">
                        <i class="fa fa-book"></i> About
                        <?=(isset($profileMenu) && $profileMenu == 2)?'<span class="sr-only">(current)</span>':''?>
                    </a>
                </li>
                <li <?=(isset($profileMenu) && $profileMenu == 3)?'class="active"':''?>>
                    <a href="<?=base_url()?>student-profile/<?=$profileOwner->id?>/friends">
                        <i class="fa fa-users"></i> Friends <?=($profileOwner->friends()->count() > 0)?'('.$profileOwner->friends()->count().')':''?>
                        <?=(isset($profileMenu) && $profileMenu == 3)?'<span class="sr-only">(current)</span>':''?>
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav><!--/nav-->
