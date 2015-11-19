<!DOCTYPE html>
        <?php
            
            if(!($this->session->userdata('username'))){
                redirect("/LoginController");
            }
            //$records is the data that was passed into this view from the HomePageController.
            //in order to use the data within $records, $records must be cast as an object and then
            //the fields can be accessed by the column name of the table where the data comes from
            //print_r($records);
            foreach($records as $rec){
                $thestreet= $rec->street;
                $thezip = $rec->zipcode;
                $theState = $rec->state;
                $theCity = $rec->city;
            }
        ?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Security Request Form</title>
  <link href="css/bootstrap.slate.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
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
                <div class="text-danger">
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
                  <!--<form class="form-horizontal" method="post">-->
                  <div class="form-group">
                    <label for="ferpa" class="col-lg-3 control-label">FERPA Score:</label>
                    <div class="col-lg-2">
                      <input type="number" class="form-control" id="ferpa" placeholder="85" name="ferpa">%
                    </div>
                  </div>
                  <!--<input type="submit" value ="SUBMIT"/>-->
                <!--</form>-->
                <?php //echo form_close(); ?>
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
            <?php $attributes = array('class' => 'form-horizontal'); 
                //echo form_open('HomePageController/checkUserData', $attributes);
            ?>
            <!--<form class="form-horizontal">-->
              <div class="row-fluid">
                <div class="col-md-10">
                  <div class="form-group">
                    <label for="username" class="col-lg-3 control-label">User Name</label>
                    <div class="col-lg-9">
                      <input type="text" name = "username" class="form-control" id="username" placeholder="full legal name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pawprint" class="col-lg-3 control-label">Pawprint or SSO</label>
                    <div class="col-lg-9">
                      <input type="text" name = "pawprint" class="form-control" id="pawprint" placeholder="pawprint or SSO">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="emplId" class="col-lg-3 control-label">EmplId</label>
                    <div class="col-lg-9">
                      <input type="text" name="emplID" class="form-control" id="emplId" placeholder="emplId">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="title" class="col-lg-3 control-label">Title</label>
                    <div class="col-lg-9">
                      <input type="text" name="title" class="form-control" id="title" placeholder="title">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="organization" class="col-lg-3 control-label">Academic Organization (Department)</label>
                    <div class="col-lg-9">
                      <input type="text" name="organization" class="form-control" id="organization" placeholder="organization">
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
                            <input type="text" name="street" class="form-control" id="street" placeholder="street" value="<?php print $thestreet; ?>">
                        </div>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-9">
                          <input type="text" name="street2" class="form-control" id="street2" placeholder="apt number">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="city" class="col-lg-3 control-label">City</label>
                        <div class="col-lg-9">
                          <input type="text" name="city" class="form-control" id="city" placeholder="city" value="<?php print $theCity;?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="zip" class="col-lg-3 control-label">Zip Code</label>
                        <div class="col-lg-9">
                          <input type="text" name="zip" class="form-control" id="zip" placeholder="zip" value="<?php print $thezip;?>">
                        </div>
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
                      <input type="text" name="phoneNumber" class="form-control" id="phoneNumber" placeholder="phone number">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="studentWorker" class="col-lg-3 control-label">I am a student worker</label>
                    <div class="col-lg-9">
                      <input type="checkbox" name="studentWorker" class="form-control" id="studentWorker">
                    </div>
                  </div>
                </div>
                <div class="col-md-2"></div>
              </div>
                <!--<input type="submit" value="Submit"/>-->
            <!--</form>-->
          </div>
        </div>
      </div>
      <!-- <div class="col-md-5">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Form Information</h3>
          </div>
          <div class="panel-body">
            <form class="form-horizontal">
              <div class="row-fluid">
                <!-- <div class="form-group">
                  <label for="requestType" class="col-lg-3 control-label">This is a(n): </label>
                  <div class="col-lg-9">
                    <input type="radio" class="form-control" name="requestType" value="new">New Request<br>
                    <input type="radio" class="form-control" name="requestType" value="additional">Additonal Request<br>
                  </div>
                </div>
              </div>
              <div class="row-fluid">
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Copy security of Current or Former Staff Member</h3>
                    </div>
                    <div class="panel-body">
                      <div class="form-group">
                        <!-- <label for="staffMember" class="col-lg-3 control-label"></label> 
                        <div class="col-lg-9">
                          <input type="radio" class="form-control" name="staffMember" value="current">Current Staff Member
                          <br>
                          <input type="radio" class="form-control" name="staffMember" value="former">Former Staff Member
                          <br>
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
                          <input type="text" class="form-control" id="staffPosition" placeholder="staff member's position">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="staffId" class="col-lg-3 control-label">Pawprint or SSO</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" id="staffId" placeholder="staff member's pawprint or SSO">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="staffEmplID" class="col-lg-3 control-label">EmplId (if known)</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" id="staffEmplID" placeholder="staff member's employee ID">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div> -->
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
                      <input type="radio" class="form-control" name="requestType" value="new">New Request
                      <br>
                      <input type="radio" class="form-control" name="requestType" value="additional">Additional Request
                      <br>
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
                        <input type="checkbox" class="form-control" name="undergraduate" value="undergraduate">UGRD
                      </div>
                      <div class="col-lg-2">
                        <input type="checkbox" class="form-control" name="graduate" value="graduate">GRD 
                      </div>
                      <div class="col-lg-2">
                        <input type="checkbox" class="form-control" name="medicine" value="medicine">MED 
                      </div>
                      <div class="col-lg-2">
                        <input type="checkbox" class="form-control" name="veterinarymedicine" value="veterinarymedicine">VETMED 
                      </div>
                      <div class="col-lg-2">
                        <input type="checkbox" class="form-control" name="law" value="law">LAW 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row-fluid">
                      <div class="col-md-1"></div>
                      <div class="col-md-11">
                        <!-- TODO: get to align to label for checkboxes above -->
                        <label for="" class="control-label">Please describe the type of access needed (i.e. view student name, address, rosters etc.) Please be specific.</label>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="col-md-1"></div>
                      <div class="col-md-11">
                        <textarea class="form-control" rows="5" id="description"></textarea>
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
                      <div class="form-group">
                        <!-- <label for="staffMember" class="col-lg-3 control-label"></label> -->
                        <div class="col-lg-1"></div>
                        <div class="col-lg-9">
                          <input type="radio" class="form-control" name="staffMember" value="current">Current Staff Member
                          <br>
                          <input type="radio" class="form-control" name="fstaffMember" value="former">Former Staff Member
                          <br>
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
                      <div class="form-group">
                        <label for="staffId" class="col-lg-3 control-label">Pawprint or SSO</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="staffID" id="staffId" placeholder="staff member's pawprint or SSO">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="staffEmplID" class="col-lg-3 control-label">EmplId (if known)</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="staffEmplID" id="staffEmplID" placeholder="staff member's employee ID">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <input type="submit" value="Submit"/>
                <?php echo form_close(); ?>

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
                </tr>
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
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Cashiers -->
    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Student Financials (Cashiers) Access</h3>
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
                </tr>
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
                </tr>
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
                </tr>
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
        <input id = "submit" class="btn btn-primary btn-lg center-block" type="submit" value="Submit">
      </div>
    </div>
  </div>
</body>

</html>
