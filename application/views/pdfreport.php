<?php
$data = "<h1>Hello World</h1>";
date_default_timezone_set('America/Chicago');
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "MyZou Security Request Form";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData('', '', $title, '');
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc
    $pawprint = "";
                $phoneNum = "";
                $title = "";
                $fname = "";
                $lname = "";  
                $orgID = "";
                $isStudentWorker = FALSE;
                $thestreet = "";
                $theCity = "";
                $thezip = "";
                $theCountry = "";
                $theState = "";
                $theferpascore = null;
                $theID = "";

            
            foreach($person as $per){
                print "Pawprint: " . $per->pawprint . "<br>";
                print "Phone: " . $per->phone_number . "<br>";
                print "Title: " . $per->title . "<br>";
                print "First Name: " . $per->fname . "<br>";
                print "Last Name: " . $per->lname . "<br>";                
            }
            
            foreach($applicant as $app){
                print "Organization ID: " . $app->organizationID . "<br>";
                print "Student Workder: " . $app->isStudentWorker . "<br>";
            }
            
            foreach($address as $add){
                print "Street: " . $add->street . "<br>";
                print "City: " . $add->city . "<br>";
                print "Zip: " . $add->zipcode . "<br>";
                print "Country: " . $add->country . "<br>";
                print "State: " . $add->state . "<br>";
                        
            }
            
            foreach($ferpa as $fer){
                print "Ferpa Score: " . $fer->score . "<br>";
            }
            
            foreach($application as $appl){
                print "Application ID: " . $appl->id . "<br>";
            }
            
            print "<h3>Signature_______________________             Date:__________</h3>";
            

  $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');

?>