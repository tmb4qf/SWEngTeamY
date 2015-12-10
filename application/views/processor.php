<!doctype html>
<html>
    <head>
        <title>Processing Page</title>
        <link href="<?php echo base_url();?>/assets/css/bootstrap.slate.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/bootstrap.js"></script>
        <!--<style>
            div{
                width: 400px;
                float: left;
                border: 1px solid black;
                border-right: 0;
                //border-bottom: 0;
            }
            
            table{
                margin: 0 auto;
                border-collapse: collapse;
                border: 1px solid black;
                
            }
            
            tr, td, th{
                border: 1px solid black;
                border-width: 1px 0px 1px 0px;
                padding: 20px;
                text-align: left;
                
            }
            
            tr:nth-child(2n + 2){
                background-color: #ccc;
            }
            
            button{
                width: 100px;
      
            }
            
        </style>-->
    </head>
    <body>
        <div class="row-fluid">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                <table class="table table-hover">
                    <tr>
                        <th>Application</th>
                        <th>Applicant ID</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                    <?php


                    //    foreach($requests as $req){
                    //        print $req->appID . " ";
                    //        print $req->id . " ";
                    //        print $req->desc . " ";
                    //        print "<br>";
                    //    }


                        foreach($requests as $req){
                            if($req->status==1) $status = "Pending";
                            elseif($req->status==2) $status = "Accepted";
                            else $status = "Not submitted yet";


                            print "<tr><td><a href=\"".base_url()."index.php/ViewRequestController?applicantID=".$req->id."\" class=\"btn btn-primary\">Select</a>". "</td>";
                            print "<td>" .$req->id."</td>";
                            print "<td>" .$req->description."</td>";
                            print "<td>" .$status."</td></tr>";
                        }
                    ?>
                </table>
            </div>
            <div class="col-md-3"></div>
        </div>
    </body>
    
    
</html>