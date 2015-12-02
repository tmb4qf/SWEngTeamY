<!doctype html>
<html>
    <head>
        <title>Processing Page</title>
        <style>
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
            
        </style>
    </head>
    <body>
        <table>
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
        //print "<a href =\"\">" . "$req->appID" . " " . "$req->id" . " " . "$req->desc";
        print "<tr><td>" . anchor("ViewRequestController?applicantID=$req->id", "<button>Select</button>") . "</td>";
        print "<td>" . $req->id . "</td>";
        print "<td>" .$req->description . "</td>";
        print "<td>" .$req->status . "</td></tr>";
    }
    
?>
    </table>
    </body>
    
    
</html>

