<?php

    print "Records From database <br/>";
    foreach($records as $rec){
        print $rec->id . "   " . $rec->name . "    " . $rec->age . "<br/>";
    }
    
?>

