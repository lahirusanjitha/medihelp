<?php 
$controllermenu=$this->router->fetch_class();
$functionmenu=uri_string();
$functionmenu2=$this->router->fetch_method();

$menuprivilegearray=$menuaccess;

if($functionmenu2=='Useraccount'){
    $addcheck=checkprivilege($menuprivilegearray, 1, 1);
    $editcheck=checkprivilege($menuprivilegearray, 1, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 1, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 1, 4);
}
else if($functionmenu2=='Usertype'){
    $addcheck=checkprivilege($menuprivilegearray, 2, 1);
    $editcheck=checkprivilege($menuprivilegearray, 2, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 2, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 2, 4);
}
else if($functionmenu2=='Userprivilege'){
    $addcheck=checkprivilege($menuprivilegearray, 3, 1);
    $editcheck=checkprivilege($menuprivilegearray, 3, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 3, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 3, 4);
}
else if($functionmenu=='Employee'){
    $addcheck=checkprivilege($menuprivilegearray, 4, 1);
    $editcheck=checkprivilege($menuprivilegearray, 4, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 4, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 4, 4);
}
else if($functionmenu=='Locationtype'){
    $addcheck=checkprivilege($menuprivilegearray, 5, 1);
    $editcheck=checkprivilege($menuprivilegearray, 5, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 5, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 5, 4);
}
else if($functionmenu=='Location'){
    $addcheck=checkprivilege($menuprivilegearray, 6, 1);
    $editcheck=checkprivilege($menuprivilegearray, 6, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 6, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 6, 4);
}
else if($functionmenu=='Locationcontact'){
    $addcheck=checkprivilege($menuprivilegearray, 7, 1);
    $editcheck=checkprivilege($menuprivilegearray, 7, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 7, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 7, 4);
}
else if($functionmenu=='Doctor'){
    $addcheck=checkprivilege($menuprivilegearray, 8, 1);
    $editcheck=checkprivilege($menuprivilegearray, 8, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 8, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 8, 4);
}
else if($functionmenu=='Itenarytype'){
    $addcheck=checkprivilege($menuprivilegearray, 9, 1);
    $editcheck=checkprivilege($menuprivilegearray, 9, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 9, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 9, 4);
}
else if($functionmenu=='Itenarycategory'){
    $addcheck=checkprivilege($menuprivilegearray, 10, 1);
    $editcheck=checkprivilege($menuprivilegearray, 10, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 10, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 10, 4);
}
else if($functionmenu=='Itenarygroup'){
    $addcheck=checkprivilege($menuprivilegearray, 12, 1);
    $editcheck=checkprivilege($menuprivilegearray, 12, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 12, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 12, 4);
}

else if($functionmenu=='Jobtitle'){
    $addcheck=checkprivilege($menuprivilegearray, 13, 1);
    $editcheck=checkprivilege($menuprivilegearray, 13, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 13, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 13, 4);
}
else if($functionmenu=='Subject'){
    $addcheck=checkprivilege($menuprivilegearray, 14, 1);
    $editcheck=checkprivilege($menuprivilegearray, 14, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 14, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 14, 4);
}
else if($functionmenu=='Job'){
    $addcheck=checkprivilege($menuprivilegearray, 15, 1);
    $editcheck=checkprivilege($menuprivilegearray, 15, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 15, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 15, 4);
}
else if($functionmenu=='Confirmjob'){
    $addcheck=checkprivilege($menuprivilegearray, 16, 1);
    $editcheck=checkprivilege($menuprivilegearray, 16, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 16, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 16, 4);
}
else if($functionmenu=='ItinaryCompletion'){
    $addcheck=checkprivilege($menuprivilegearray, 17, 1);
    $editcheck=checkprivilege($menuprivilegearray, 17, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 17, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 17, 4);
}
else if($functionmenu=='Sendtoapprove'){
    $addcheck=checkprivilege($menuprivilegearray, 18, 1);
    $editcheck=checkprivilege($menuprivilegearray, 18, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 18, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 18, 4);
}
else if($functionmenu=='ChangeRequest'){
    $addcheck=checkprivilege($menuprivilegearray, 19, 1);
    $editcheck=checkprivilege($menuprivilegearray, 19, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 19, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 19, 4);
}else if($functionmenu=='RejectReason'){
    $addcheck=checkprivilege($menuprivilegearray, 20, 1);
    $editcheck=checkprivilege($menuprivilegearray, 20, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 20, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 20, 4);
}else if($functionmenu=='FeedbackType'){
    $addcheck=checkprivilege($menuprivilegearray, 21, 1);
    $editcheck=checkprivilege($menuprivilegearray, 21, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 21, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 21, 4);
}else if($functionmenu=='Feedbackreport'){
    $addcheck=checkprivilege($menuprivilegearray, 23, 1);
    $editcheck=checkprivilege($menuprivilegearray, 23, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 23, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 23, 4);
}else if($functionmenu=='Cancelreport'){
    $addcheck=checkprivilege($menuprivilegearray, 24, 1);
    $editcheck=checkprivilege($menuprivilegearray, 24, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 24, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 24, 4);
}else if($functionmenu=='Postponedreport'){
    $addcheck=checkprivilege($menuprivilegearray, 25, 1);
    $editcheck=checkprivilege($menuprivilegearray, 25, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 25, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 25, 4);
}else if($functionmenu=='Missingereport'){
    $addcheck=checkprivilege($menuprivilegearray, 26, 1);
    $editcheck=checkprivilege($menuprivilegearray, 26, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 26, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 26, 4);
}else if($functionmenu=='Actionreport'){
    $addcheck=checkprivilege($menuprivilegearray, 27, 1);
    $editcheck=checkprivilege($menuprivilegearray, 27, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 27, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 27, 4);
}
else if($functionmenu=='Locationtrack'){
    $addcheck=checkprivilege($menuprivilegearray, 28, 1);
    $editcheck=checkprivilege($menuprivilegearray, 28, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 28, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 28, 4);
}else if($functionmenu=='Feedback'){
    $addcheck=checkprivilege($menuprivilegearray, 29, 1);
    $editcheck=checkprivilege($menuprivilegearray, 29, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 29, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 29, 4);
}else if($functionmenu=='Editapproval'){
    $addcheck=checkprivilege($menuprivilegearray, 30, 1);
    $editcheck=checkprivilege($menuprivilegearray, 30, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 30, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 30, 4);
}



function checkprivilege($arraymenu, $menuID, $type){
    foreach($arraymenu as $array){
        if($array->menuid==$menuID){
            if($type==1){
                return $array->add;
            }
            else if($type==2){
                return $array->edit;
            }
            else if($type==3){
                return $array->statuschange;
            }
            else if($type==4){
                return $array->remove;
            }
        }
    }
}
?>
<textarea class="d-none" id="actiontext"><?php if($this->session->flashdata('msg')) {echo $this->session->flashdata('msg');} ?></textarea>

<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <div class="sidenav-menu-heading">Core</div>
            <a class="nav-link p-0 px-3 py-2 text-dark" href="<?php echo base_url().'Dashboard/index'; ?>">
                <div class="nav-link-icon"><i class="fas fa-desktop"></i></div>
                Dashboard
            </a>
        <?php if(menucheck($menuprivilegearray, 17) == 1 | menucheck($menuprivilegearray, 18) == 1 | menucheck($menuprivilegearray, 27) == 1 | menucheck($menuprivilegearray, 28) == 1 | menucheck($menuprivilegearray, 13) == 1) { ?>
    <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapsematerialinfo" aria-expanded="false" aria-controls="collapsematerialinfo">
        <div class="nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
        Master Files
        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>

            <div class="collapse <?php if( $controllermenu=="Jobtitle" | $controllermenu=="Employee" | $controllermenu=="Itenarytype" | $controllermenu=="Itenartctegory" | $controllermenu=="Itenarysubcatagory" | $controllermenu=="Itenarygroup" | $controllermenu=="Locationtype" | $controllermenu=="Location" | $controllermenu=="Doctor" | $controllermenu=="Subject" | $controllermenu=="Job" | $controllermenu=="Confirmjob" | $controllermenu=="RejectReason" | $controllermenu=="FeedbackType" | $controllermenu=="Jobtitle" ){echo 'show';} ?>" id="collapsematerialinfo" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                    <!-- <?php //} if(menucheck($menuprivilegearray, 4)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php //echo base_url().'Employee'; ?>">Employee</a> -->
                    <?php } if(menucheck($menuprivilegearray, 5)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Locationtype'; ?>">Location Type</a>
                    <?php } if(menucheck($menuprivilegearray, 6)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Location'; ?>">Location</a>
                    <?php } if(menucheck($menuprivilegearray, 14)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Subject'; ?>">Specialty </a>
                    <?php } if(menucheck($menuprivilegearray, 8)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Doctor'; ?>">Doctors</a> 
                    <?php } if(menucheck($menuprivilegearray, 20)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'RejectReason'; ?>">Reject Reason</a> 
                    <?php } if(menucheck($menuprivilegearray, 21)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'FeedbackType'; ?>">Feedback Type</a> 
                    <?php } if(menucheck($menuprivilegearray, 21)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Locationtrack'; ?>">Track Location</a> 
                    <?php } ?>
                </nav>
            </div>

            <?php if(menucheck($menuprivilegearray, 9) == 1 | menucheck($menuprivilegearray, 10) == 1 | menucheck($menuprivilegearray, 12) == 1) { ?>
    <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#itenaryfilesinfo" aria-expanded="false" aria-controls="itenaryfilesinfo">
        <div class="nav-link-icon"><i class="fas fa-sticky-note"></i></div>
        Itinerary Files
        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>

            <div class="collapse <?php if( $controllermenu=="Itenarytype" | $controllermenu=="Itenarycategory" | $controllermenu=="Itenarygroup"){echo 'show';} ?>" id="itenaryfilesinfo" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                <?php } if(menucheck($menuprivilegearray, 9)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Itenarytype'; ?>">Itinerary Type</a>
                    <?php } if(menucheck($menuprivilegearray, 10)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Itenarycategory'; ?>">Itinerary Category</a>
                    <?php } if(menucheck($menuprivilegearray, 12)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Itenarygroup'; ?>">Itinerary Status</a>
                <?php } ?>
                </nav>
            </div>

            <?php if(menucheck($menuprivilegearray, 13) == 1 | menucheck($menuprivilegearray, 15) == 1 | menucheck($menuprivilegearray, 16) == 1 | menucheck($menuprivilegearray, 18) ==1 | menucheck($menuprivilegearray, 18) ==1 | menucheck($menuprivilegearray, 22) == 1 | menucheck($menuprivilegearray, 29) == 1 | menucheck($menuprivilegearray, 30) == 1) { ?>
    <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#jobmanagementinfo" aria-expanded="false" aria-controls="jobmanagementinfo">
        <div class="nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
        Itinary Management
        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>

            <div class="collapse <?php if( $controllermenu=="Jobtitle" | $controllermenu=="Job" | $controllermenu=="Confirmjob" | $controllermenu=="ItinaryCompletion" |$controllermenu=="Sendtoapprove" |$controllermenu=="ChangeRequest" | $controllermenu=="Sendtoapprove" |$controllermenu=="MonthlyItinaryStatus" |$controllermenu=="Feedback" |$controllermenu=="Editapproval" ){echo 'show';} ?>" id="jobmanagementinfo" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                <!-- <?php //} if(menucheck($menuprivilegearray, 13)==1){ ?>
                <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php //echo base_url().'Jobtitle'; ?>">Jobtitle </a>  -->
                <?php } if(menucheck($menuprivilegearray, 15)==1){ ?>
                <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Job'; ?>">Monthly Itinary </a>
                <?php } if(menucheck($menuprivilegearray, 18)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Sendtoapprove'; ?>">Send to Approve Level </a>  
                <?php } if(menucheck($menuprivilegearray, 16)==1){ ?>
                <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Confirmjob'; ?>">Approvel Level </a> 
                <?php } if(menucheck($menuprivilegearray, 29)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Feedback'; ?>">Feed Back </a> 
                <?php } if(menucheck($menuprivilegearray, 17)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'ItinaryCompletion'; ?>">Itinary Completetion Level </a> 
                <?php } if(menucheck($menuprivilegearray, 19)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'ChangeRequest'; ?>">Itinary Actions</a> 
                <?php } if(menucheck($menuprivilegearray, 30)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Editapproval'; ?>">Edit Aproval</a> 
                <?php } ?> 
                </nav>
            </div>

            <?php if(menucheck($menuprivilegearray, 23) == 1 | menucheck($menuprivilegearray, 24) == 1 | menucheck($menuprivilegearray, 25) == 1 | menucheck($menuprivilegearray, 26) == 1) { ?>
    <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#reportsinfo" aria-expanded="false" aria-controls="reportsinfo">
        <div class="nav-link-icon"><i class="fas fa-sticky-note"></i></div>
        Reports
        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>

            <div class="collapse <?php if( $controllermenu=="Feedbackreport" | $controllermenu=="Cancelreport" | $controllermenu=="Postponedreport" | $controllermenu=="Missingereport"){echo 'show';} ?>" id="reportsinfo" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                <?php } if(menucheck($menuprivilegearray, 23)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Feedbackreport'; ?>">Feed Back Report</a>
                    <?php } if(menucheck($menuprivilegearray, 24)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Cancelreport'; ?>">Cancel Report </a>
                    <?php } if(menucheck($menuprivilegearray, 25)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Postponedreport'; ?>">Postponed Report </a>
                    <?php } if(menucheck($menuprivilegearray, 26)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Missingereport'; ?>">Missing Report </a>
                    <?php } if(menucheck($menuprivilegearray, 27)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Actionreport'; ?>">Action Report </a>
                <?php } ?>
                </nav>
            </div>

            
            <?php if(menucheck($menuprivilegearray, 1)==1 | menucheck($menuprivilegearray, 2)==1 | menucheck($menuprivilegearray, 3)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                <div class="nav-link-icon"><i class="fas fa-user"></i></div>
                User Account
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($functionmenu=="Useraccount" | $functionmenu=="Usertype" | $functionmenu=="Userprivilege"){echo 'show';} ?>" id="collapseUser" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <?php if(menucheck($menuprivilegearray, 1)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'User/Useraccount'; ?>">User Account</a>
                    <?php } if(menucheck($menuprivilegearray, 2)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'User/Usertype'; ?>">Type</a>
                    <?php } if(menucheck($menuprivilegearray, 3)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'User/Userprivilege'; ?>">Privilege</a>
                    <?php } ?>
                </nav>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title"><?php echo ucfirst($_SESSION['name']); ?></div>
        </div>
    </div>
</nav>
