<!DOCTYPE html>
        <?php
            
            if(empty($this->session->userdata('username'))){
                redirect("/LoginController");
            }
            
        
        ?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Security Request Form</title>
  <link href="/assets/css/bootstrap.slate.css" rel="stylesheet">
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
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="ferpa" class="col-lg-3 control-label">FERPA Score:</label>
                    <div class="col-lg-2">
                      <input type="number" class="form-control" id="ferpa" placeholder="85">%
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
                    <label for="username" class="col-lg-3 control-label">User Name</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" id="username" placeholder="full legal name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pawprint" class="col-lg-3 control-label">Pawprint or SSO</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" id="pawprint" placeholder="pawprint or SSO">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="emplId" class="col-lg-3 control-label">EmplId</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" id="emplId" placeholder="emplId">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="title" class="col-lg-3 control-label">Title</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" id="title" placeholder="title">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="organization" class="col-lg-3 control-label">Academic Organization (Department)</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" id="organization" placeholder="organization">
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
                          <input type="text" class="form-control" id="street" placeholder="street">
                        </div>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" id="street2" placeholder="apt number">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="city" class="col-lg-3 control-label">City</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" id="city" placeholder="city">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="zip" class="col-lg-3 control-label">Zip Code</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" id="zip" placeholder="zip">
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
                      <input type="text" class="form-control" id="phoneNumber" placeholder="phone number">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="studentWorker" class="col-lg-3 control-label">I am a student worker</label>
                    <div class="col-lg-9">
                      <input type="checkbox" class="form-control" id="studentWorker">
                    </div>
                  </div>
                </div>
                <div class="col-md-2"></div>
              </div>
            </form>
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
      </div>
    </div>
    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Student Records Access</h3>
          </div>
          <div class="panel-body">
            <!-- TODO: complete panel content -->
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Admissions Access</h3>
          </div>
          <div class="panel-body">
            <!-- TODO: complete panel content -->
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Student Financials (Cashiers) Access</h3>
          </div>
          <div class="panel-body">
            <!-- TODO: complete panel content -->
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Student Financial Aid Access</h3>
          </div>
          <div class="panel-body">
            <!-- TODO: complete panel content -->
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Reserved Access</h3>
          </div>
          <div class="panel-body">
            <!-- TODO: complete panel content -->
          </div>
        </div>
      </div>
    </div>
    
  </div>
</body>

</html>
