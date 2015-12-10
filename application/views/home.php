<!DOCTYPE html>
        <?php
        
            
            if(!($this->session->userdata('username'))){
                redirect("/LoginController");
            }
            
                $reservedChecks = array_reverse($reservedChecks);
                $studentChecks = array_reverse($studentChecks);
                $financialChecks = array_reverse($financialChecks);
                $admissionsChecks = array_reverse($admissionsChecks);
                //print_r($studentChecks);
                

                $pawprint = "";
                $phoneNum = "";
                $title = "";
                $fname = "";
                $lname = "";  
                $orgID = "";
                $isStudentWorker = FALSE;
                $theCity = "";
                $theZip = "";
                $theCountry = "";
                $theState = "";
                $theferpascore = null;
                $theID = "";
                $theStreet = "";

            
            $desc = $app[0]->description;
            foreach($person as $per){
                $pawprint = $per->pawprint;
                $phoneNum = $per->phone_number;
                $title = $per->title;
                $fname = $per->fname;
                $lname = $per->lname;                
            }
            
            foreach($applicant as $app){
                $orgID = $app->organizationID;
                $isStudentWorker = $app->isStudentWorker;
            }
            
            foreach($address as $add){
                $theStreet = $add->street;
                $theCity = $add->city;
                $theZip = $add->zipcode;
                $theCountry = $add->country;
                $theState = $add->state;
                        
            }
            
            foreach($ferpa as $fer){
                $theferpascore = $fer->score;
            }
            
            foreach($application as $appl){
                $theID = $appl->id;
            }
            
            foreach($dropdown as $key => $value){
                $theList[$key] = $value->name;
            }
           
            
            if($theferpascore == null || $theferpascore < 50){
                redirect("/InvalidFerpa");
            }
        ?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Security Request Form</title>

  <link href="<?php echo base_url();?>/assets/css/bootstrap.slate.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="<?php echo base_url();?>/assets/js/bootstrap.js"></script>
  <script src="<?php echo base_url();?>/assets/js/FormValidation.js"></script>
  
  <script>
    $(function(){
       console.log("JACK! THIS WORK"); 
    });
  </script>
</head>

<body>
  <div class="container">
    <?php echo anchor('LogoutController', 'Logout'); ?>
    <div class="jumbotron">
      <h1>myZou SECURITY Request Form</h1>
      <p>University of Missouri, Columbia</p>
      <!-- TODO: add popup modal with instructions when button is selected-->
      <p><a class="btn btn-primary btn-lg">Instructions</a></p>
    </div>

     <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Instructions</h4>
          </div>
          <div class="modal-body">
            <p>Filler text:   In an effort to streamline the process of requesting myZou security for Staff and Faculty a new
            form has been developed to assist you in identifying the type of access your users will
            require. This form will be helpful to ensure that all the information to make a request are
            gathered such as User identification, FERPA confirmation, requested access by your department
            and appropriate signatures.</p>

            <p>This form will take the place of requesting myZou access by email. The form can be obtained by
            going to the Registrar’s Faculty and Staff website (http://registrar.missouri.edu/facultystaff/index.
            php). Please complete the form online, print it out and collect the required
            signatures. Then send the completed form by Campus Mail to Student Information Systems at
            130 Jesse Hall. Once Student Information Systems has processed your request you will be
            contacted if there are any questions or when the access has been granted.</p>

            <p>If you have any questions regarding filling out the form or what type of access should be
            requested please send your inquiries to the same myZou (mailto:myzou@missouri.edu) email
            address. But please remember the actual requests must be made by using the new myZou
            Security Request Form <a href="http://registrar.missouri.edu/forms/security%20req
            uest%20form.pdf">here</a>.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <!-- FERPA -->
    <div class="row-fluid" id="ferpa-section">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">FERPA</h3>
          </div>
          <div class="panel-body">
            <div class="row-fluid">
              <div class="col-md-1"></div>
              <div class="col-md-10">
                <div class="">
                  A passing score of 85% on the FERPA Quiz is required before access to student data is approved. Request access to the FERPA tutorial and access to the FERPA quiz
                  <a href="http://myzoutraining.missouri.edu/ferpareq.php">here</a>.
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="col-md-1"></div>
              <div class="col-md-8">
                  <?php $attributes = array('class' => 'form-horizontal'); 
                    echo form_open('HomePageController/checkUserData', $attributes);
                  ?>
<!--                  <form class="form-horizontal" method="post">
                </form>-->
                 <div class="form-group">
                    <label for="ferpa" class="col-lg-3 control-label">FERPA Score:</label>
                    <div class="col-lg-2">
                      <input type="number" value="<?php print $theferpascore; ?>" class="form-control" id="ferpa" placeholder="85" name="ferpa" >
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- User Info -->
    <div class="row-fluid">
      <div class="col-md-7">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">User Information</h3>
          </div>
          <div class="panel-body">
 
            <form class="form-horizontal">
            <div class="row-fluid">
              <div class="col-md-10">
                <div class="form-group">
                  <label for="fname" class="col-lg-3 control-label">First Name</label>
                  <div class="col-lg-9">
                    <input required type="text" name = "fname" class="form-control" id="fname" placeholder="first name" value="<?php print $fname; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="lname" class="col-lg-3 control-label">Last Name</label>
                  <div class="col-lg-9">
                    <input required type="text" name = "lname" class="form-control" id="lname" placeholder="last name" value="<?php print $lname; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="pawprint" class="col-lg-3 control-label">Pawprint or SSO</label>
                  <div class="col-lg-9">
                    <input required type="text" value="<?php print $pawprint; ?>" name = "pawprint" class="form-control" id="pawprint" placeholder="pawprint or SSO">
                  </div>
                </div>
                <div class="form-group">
                  <label for="emplId" class="col-lg-3 control-label">EmplId</label>
                  <div class="col-lg-9">
                    <input required type="text" value="<?php print "1111111"; ?>"name="emplID" class="form-control" id="emplId" placeholder="emplId">
                  </div>
                </div>
                <div class="form-group">
                  <label for="title" class="col-lg-3 control-label">Title</label>
                  <div class="col-lg-9">
                    <input type="text" value="<?php print $title; ?>" name="title" class="form-control" id="title" placeholder="title">
                  </div>
                </div>
                <div class="form-group">
                  <label for="organization" class="col-lg-3 control-label">Academic Organization (Department)</label>
                  <div class="col-lg-9">
                    <!--<input type="text" name="organization" class="form-control" id="organization" placeholder="organization">-->                         
<!--                      <input type="text" name="organization" class="form-control" id="organization" placeholder="organization">-->
                           <?php
                           $formAttr = 'type="text" class="form-control" id="organization" class="form-control"';
                           print form_dropdown('organization', $theList, '0', $formAttr); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-2"></div>
            </div>
            <div class="row-fluid">
              <div class="col-md-11">
                <div class="panel panel-default">
                  <div class="panel-heading">Campus Address</div>
                  <div class="panel-body">
                    <div class="form-group">
                      <label for="street2" class="col-lg-3 control-label">Street</label>
                      <div class="col-lg-9">
                          <input type="text" name="street" class="form-control" id="street" placeholder="street" value="<?php echo $theStreet; ?>">
                      </div>
                      <div class="col-lg-3"></div>
                      <div class="col-lg-9">
                        <input type="text" name="street2" class="form-control" id="street2" placeholder="apt number">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="city" class="col-lg-3 control-label">City</label>
                      <div class="col-lg-9">
                        <input required type="text" name="city" class="form-control" id="city" placeholder="city" value="<?php echo $theCity;  ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="zip" class="col-lg-3 control-label">Zip Code</label>
                      <div class="col-lg-9">
                        <input required type="text" name="zip" class="form-control" id="zip" placeholder="zip" value="<?php echo $theZip;?>">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="col-md-10">
                <div class="form-group">
                  <label for="phoneNumber" class="col-lg-3 control-label">Phone Number</label>
                  <div class="col-lg-9">
                    <input required type="text" name="phoneNumber" class="form-control" id="phoneNumber" placeholder="phone number" value="<?php print $phoneNum;?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="studentWorker" class="col-lg-3 control-label">I am a student worker</label>
                  <div class="col-lg-9">
                    <input type="checkbox" name="studentWorker" class="form-control" id="studentWorker" <?php print $isStudentWorker ? "checked" : "" ?>>
                  </div>
                </div>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Form Info -->
    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Form Information</h3>
          </div>
          <div class="panel-body">
            <form class="form-horizontal">
              <div class="row-fluid">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="requestType" class="col-lg-3 control-label">This is a(n): </label>
                    <div class="col-lg-9">
                      <div class="row">
                        <div class="col-lg-12">
                          <input <?php print $theID ? "disabled" : "checked";  ?> class = "col-lg-1" id="newRequest" type="radio" class="form-control" name="requestType" value="new">
                          <label class = "col-lg-11" for="newRequest" class="control-label">New Request</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <input <?php print $theID ? "checked" : "disabled";  ?> class="col-lg-1" id="addtlRequest" type="radio" class="form-control" name="requestType" value="additional">
                          <label class="col-lg-11" for="addtlRequest" class="control-label">Additional Request</label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row-fluid">
                    <!-- TODO: fix indentation of label -->
                      <div class="col-md-1"></div>
                      <div class="col-md-11">
                        <label for="requestType" class="control-label">Select the Academic Career(s). Please check all that apply. </label>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="col-md-1"></div>
                      <div class="col-lg-2">
                        <input <?php print $careerType[4] == 0 ? "" : "checked"; ?> type="checkbox" class="form-control" name="undergraduate" value=1>UGRD
                      </div>
                      <div class="col-lg-2">
                        <input <?php print $careerType[3] == 0 ? "" : "checked"; ?> type="checkbox" class="form-control" name="graduate" value=2>GRD 
                      </div>
                      <div class="col-lg-2">
                        <input <?php print $careerType[2] == 0 ? "" : "checked"; ?> type="checkbox" class="form-control" name="medicine" value=4>MED 
                      </div>
                      <div class="col-lg-2">
                        <input <?php print $careerType[1] == 0 ? "" : "checked"; ?> type="checkbox" class="form-control" name="veterinarymedicine" value=8>VETMED 
                      </div>
                      <div class="col-lg-2">
                        <input type="checkbox" class="form-control" name="law" value=16 <?php print $careerType[0] == 0 ? "" : "checked"; ?>>LAW 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row-fluid">
                      <div class="col-md-1"></div>
                      <div class="col-md-11">
                        <!-- TODO: get to align to label for checkboxes above -->
                        <label for="description" class="control-label">Please describe the type of access needed (i.e. view student name, address, rosters etc.) Please be specific.</label>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="col-md-1"></div>
                      <div class="col-md-11">
                        <textarea class="form-control" rows="5" id="description" name="description"><?php print $desc; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Copy security of Current or Former Staff Member</h3>
                    </div>
                    <div class="panel-body">
                      <div class="form-group row">
                        <div class="col-lg-12">
                          <input class="col-lg-1" type="checkbox" class="form-control" name="staffMember" value="current">
                          <label class="col-lg-11" for="staffMember" class="col-lg-10 control-label">I want to copy the credentials of a staff member:</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="staffName" class="col-lg-3 control-label">Name</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" id="staffName" placeholder="staff member's name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="staffPosition" class="col-lg-3 control-label">Position</label>
                        <div class="col-lg-9">
                          <input type="text" name="staffPosition" class="form-control" id="staffPosition" placeholder="staff member's position">
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label for="staffId" class="col-lg-3 control-label">Pawprint or SSO</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="staffEmplID" id="staffEmplID" placeholder="staff member's employee ID">
                        </div>
                      </div> -->
                      <div class="form-group">
                        <label for="staffId" class="col-lg-3 control-label">Pawprint or SSO</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="staffID" id="staffId" placeholder="staff member's pawprint or SSO">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                

            <!--</form>-->
          </div>
        </div>
      </div>
    </div>
     <!-- Student Records -->
    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Student Records Access</h3>
          </div>
          <div class="panel-body">
            <!-- TODO: complete panel content -->
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th>Role</th>
                  <th>Role Description</th>
                  <th>Access Type</th>
                </tr>
              </thead>
              <tbody>
                        <?php
                        $x = 1;
                        $y=2;
                        $z = 0;
                        $b=1;
                foreach($studentrecords as $sr){
    $view = $sr->isViewable;
                    $update = $sr->isUpdateable;
                    
                    if($view == 0){
                        $view = "disabled";
                    }else{
                        $view = "";
                    }
                    
                    if($update == 0){
                        $update = "disabled";
                    }else{
                        $update = "";
                    }
                    if(isset($studentChecks[$z])){
                        $r1 = $studentChecks[$z] == 0 ? "" : "checked";
                    }
                    if(isset($studentChecks[$b])){
                        $r2 = $studentChecks[$b] == 0 ? "" : "checked";
                    }
                    
                print 
               
                "<tr>
                  <td>" . $sr->roleName . "</td>
                  <td>" . $sr->roleDesc . "</td>"
                  . "<td>
                    <div class=\"checkbox\">
                      <label>
                        <input " . $r1 . "  name=\"studentview". $sr->roleID ."\"type=\"checkbox\" value=\"$x\"". $view . ">View
                      </label>
                      <label>
                        <input " . $r2 . "  name=\"studentupdate". $sr->roleID . "\"type=\"checkbox\" value=\"$y\"" .$update ."> Update
                      </label>
                    </div>
                  </td>
                </tr>";
                $x = $x*4;
                    $y = $y*4;
                    $z+=2;
                    $b+=2;
                }
               ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Admissions -->
    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Admissions Access</h3>
          </div>
          <div class="panel-body">
            <!-- TODO: complete panel content -->
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th>Test</th>
                  <th>Permission Needed?</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $x=1;
                $z=0;
                foreach($admissions as $role){
                    if(isset($admissionsChecks[$z])){
                        $r1 = $admissionsChecks[$z] == 0 ? "" : "checked";
                    }
                    
                    
                print 
               
                "<tr>
                  <td>" . $role->name . "</td>"
                  . "<td>
                    <div class=\"checkbox\">
                      <label>
                        <input " . $r1 . " name=\"admissions". $role->typeID ."\"type=\"checkbox\" value=\"$x\">
                      </label>
                    </div>
                  </td>
                </tr>";
                $x*=2;
                $z++;
                }
               ?>
<!--                <tr>
                  <td>Advanced Inquiry</td>
                  <td>Look, having nuclear—my uncle was a great professor and scientist and engineer, Dr. John Trump at MIT; good genes, very good genes, OK, very smart, the Wharton School of Finance, very good, very smart—you know, if you’re a conservative Republican, if I were a liberal, if, like, OK, if I ran as a liberal Democrat, they would say I'm one of the smartest people anywhere in the world—it’s true!</td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> View
                      </label>
                      <label>
                        <input type="checkbox"> Update
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>3Cs</td>
                  <td>So under President Trump, here’s what would happen: The head of Ford will call me back, I would say within an hour after I told him the bad news, but it could be he’d want to be cool and he’ll wait until the next day. You know, they want to be a little cool.</td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> View
                      </label>
                      <label>
                        <input type="checkbox"> Update
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Advisor Update</td>
                  <td>Bacon ipsum dolor amet brisket shoulder fatback biltong cow. Ham hock andouille jowl kielbasa. Flank t-bone doner leberkas pork chop tenderloin cupim pork belly short ribs venison shoulder beef. </td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> View
                      </label>
                      <label>
                        <input type="checkbox"> Update
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Department SOC Update</td>
                  <td>Bacon ipsum dolor amet ipsum incididunt nulla pancetta, pariatur velit dolore sint. Mollit ground round deserunt chuck ut turkey cupim commodo beef ribs non tri-tip laborum biltong. Reprehenderit picanha nisi turducken, aliquip ham hock voluptate cupidatat irure rump.</td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> View
                      </label>
                      <label>
                        <input type="checkbox"> Update
                      </label>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
     Cashiers 
    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Student Financials (Cashiers) Access</h3>
          </div>
          <div class="panel-body">
             TODO: complete panel content 
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th>Role</th>
                  <th>Role Description</th>
                  <th>Access Type</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Basic Inquiry</td>
                  <td>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..</td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> View
                      </label>
                      <label>
                        <input type="checkbox"> Update
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Advanced Inquiry</td>
                  <td>Look, having nuclear—my uncle was a great professor and scientist and engineer, Dr. John Trump at MIT; good genes, very good genes, OK, very smart, the Wharton School of Finance, very good, very smart—you know, if you’re a conservative Republican, if I were a liberal, if, like, OK, if I ran as a liberal Democrat, they would say I'm one of the smartest people anywhere in the world—it’s true!</td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> View
                      </label>
                      <label>
                        <input type="checkbox"> Update
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>3Cs</td>
                  <td>So under President Trump, here’s what would happen: The head of Ford will call me back, I would say within an hour after I told him the bad news, but it could be he’d want to be cool and he’ll wait until the next day. You know, they want to be a little cool.</td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> View
                      </label>
                      <label>
                        <input type="checkbox"> Update
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Advisor Update</td>
                  <td>Bacon ipsum dolor amet brisket shoulder fatback biltong cow. Ham hock andouille jowl kielbasa. Flank t-bone doner leberkas pork chop tenderloin cupim pork belly short ribs venison shoulder beef. </td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> View
                      </label>
                      <label>
                        <input type="checkbox"> Update
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Department SOC Update</td>
                  <td>Bacon ipsum dolor amet ipsum incididunt nulla pancetta, pariatur velit dolore sint. Mollit ground round deserunt chuck ut turkey cupim commodo beef ribs non tri-tip laborum biltong. Reprehenderit picanha nisi turducken, aliquip ham hock voluptate cupidatat irure rump.</td>
                  <td>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> View
                      </label>
                      <label>
                        <input type="checkbox"> Update
                      </label>
                    </div>
                  </td>
                </tr>-->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Aid -->
    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Student Financial Aid Access</h3>
          </div>
          <div class="panel-body">
            <!-- TODO: complete panel content -->
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th>Role</th>
                  <th>Role Description</th>
                  <th>Access Type</th>
                </tr>
              </thead>
              <tbody>
               <?php
                $x = 1;
                $y=2;
                $z=0;
                $b=1;
                foreach($studentaid as $sa){
                $view = $sa->isViewable;
                    $update = $sa->isUpdateable;
                    
                    if($view == 0){
                        $view = "disabled";
                    }else{
                        $view = "";
                    }
                    
                    if($update == 0){
                        $update = "disabled";
                    }else{
                        $update = "";
                    }
                    
                    if(isset($reservedChecks[$z])){
                        $r1 = $financialChecks[$z] == 0 ? "" : "checked";
                    }
                    if(isset($studentChecks[$b])){
                        $r2 = $financialChecks[$b] == 0 ? "" : "checked";
                    }
                    
                print 
               
                "<tr>
                  <td>" . $sa->roleName . "</td>
                  <td>" . $sa->roleDesc . "</td>"
                  . "<td>
                    <div class=\"checkbox\">
                      <label>
                        <input " . $r1 . " name=\"financialview". $sa->roleID ."\"type=\"checkbox\" value=\"$x\"". $view . ">View
                      </label>
                      <label>
                        <input " . $r2 . " name=\"financialupdate". $sa->roleID . "\"type=\"checkbox\" value=\"$y\"" .$update ."> Update
                      </label>
                    </div>
                  </td>
                </tr>";
                $x = $x*4;
                    $y = $y*4;
                   $z+=2;
                   $b+=2;
                }
               ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Reserved -->
    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Reserved Access</h3>
          </div>
          <div class="panel-body">
            <!-- TODO: complete panel content -->
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th>Role</th>
                  <th>Access Type</th>
                </tr>
              </thead>
              <tbody>
                             <?php
                 $x = 1;
                 $y=2;
                 $z=0;
                 $b=1;
                foreach($reserved as $rs){
                    
                    $view = $rs->isViewable;
                    $update = $rs->isUpdateable;
                    
                    if($view == 0){
                        $view = "disabled";
                    }else{
                        $view = "";
                    }
                    
                    if($update == 0){
                        $update = "disabled";
                    }else{
                        $update = "";
                    }
                    
                    if(isset($reservedChecks[$z])){
                    $r1 = $reservedChecks[$z] == 0 ? "" : "checked";
                    }
                    if(isset($reservedChecks[$b])){
                    $r2 = $reservedChecks[$b] == 0 ? "" : "checked";
                    }

                    
                print 
               
                "<tr>
                  <td>" . $rs->roleName . "</td>
                  <td></td>"
                  . "<td>
                    <div class=\"checkbox\">
                      <label>
                        <input " . $r1 . " name=\"reservedview". $rs->roleID ."\"type=\"checkbox\" value=\"$x\"". $view . ">View
                      </label>
                      <label>
                        <input " . $r2 . " name=\"reservedupdate". $rs->roleID . "\"type=\"checkbox\" value=\"$y\"" .$update ."> Update
                      </label>
                    </div>
                  </td>
                </tr>";
                $x = $x*4;
                    $y = $y*4;
                    $z+=2;
                    $b+=2;
                }
               ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- TODO: add authorization section. -->
    <!-- submit -->
    <div class="row-fluid">
      <div class="col-md-12">
        <input class="btn btn-primary btn-lg" type="submit" value="Submit" id="submit" onclick="submitForm()"/>   
                <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</body>

</html>
