<html>
<body>
<?php
    $OzStates[1] = "New South Wales";
    $OzStates[2] = "South Australia";
    $OzStates[4] = "Queensland";
    $OzStates[6] = "Victoria";

    echo "Size of array is ".
      sizeof($OzStates)."<br />";
    

    echo "Value of current element is ".
      current($OzStates)."<br />";
    next($OzStates);
    

    echo "Value of current element is ".
      current($OzStates)."<br />";
    

    echo "Index of current element is ".
      key($OzStates)."<br />";
    prev($OzStates);
    

    echo "Value of current element is ".
      current($OzStates)."<br />";
    end($OzStates);
    

    echo "Value of current element is ".
      current($OzStates)."<br /><br />";
    reset($OzStates);

    while(list($Index, $Contents) = each($OzStates))
    {
    	echo $Index." - ".$Contents."<br />";
    }

    reset($OzStates);
    echo "<br />";

    while(list(, $Contents) = each($OzStates))
    {
    	echo $Contents."<br />";
    }
?>

</body>
</html>
