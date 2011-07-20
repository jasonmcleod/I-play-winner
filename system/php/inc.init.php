<?
    error_reporting(E_ALL);
    ini_set('show_errors','on');

    $hostname_emu = "localhost";
    $database_emu = "iplaywinner";
    $username_emu = "root";
    $password_emu = "root";

    $emu = mysql_pconnect($hostname_emu, $username_emu, $password_emu) or trigger_error(mysql_error(),E_USER_ERROR);

    function query($query,$debug=false) {
         if($debug) {
             echo "<pre>$query</pre>";
         }

         global $database_emu, $emu;
         $return = array();

         mysql_select_db($database_emu, $emu);
         $thisQuery = mysql_query($query, $emu) or die(mysql_error());
         $return['total'] = mysql_num_rows($thisQuery);
         $return['data'] = mysql_fetch_assoc($thisQuery);
         $return['object'] = $thisQuery;

         return $return;
     }
?>