<?php
  session_start();
  //create MDS constants
  //create MDS constants
  define("MONASH_DIR", "ldap.monash.edu.au");
  define("MONASH_FILTER","o=Monash University, c=au");


$LDAPconn=@ldap_connect(MONASH_DIR);
    if($LDAPconn)
    {
      $LDAPsearch=@ldap_search($LDAPconn,MONASH_FILTER,
        "uid=".$_POST["uname"]);

      if($LDAPsearch)
      {
        $LDAPinfo =
          @ldap_first_entry($LDAPconn,$LDAPsearch);
        if($LDAPinfo)
        {
          $LDAPresult=
            @ldap_bind($LDAPconn,
            ldap_get_dn($LDAPconn, $LDAPinfo),
            $_POST["pword"]);
        }
        else
        {
          $LDAPresult=0;
        }
      }
      else
      {
        $LDAPresult=0;
      }
    }
    else
    {
      $LDAPresult=0;
    }

    if($LDAPresult)
    {
      echo "Valid User";
      $_SESSION['userid'] = true;
      $_SESSION['loggedin'] = true;
    }
    else
    {
      echo "Invalid User";
    }
?>
