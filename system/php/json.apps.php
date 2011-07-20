<?
    include('inc.init.php');

    $rows = query("SELECT * FROM apps ORDER BY title ASC");
    if($rows['total']>0) {

        $output = "[";
        do {
            $output.= "{";
            foreach($rows['data'] as $key => $value) {
                if($key!="password") {
                    // if its a number or an array don't wrap it in quotes
                    if(is_numeric($value) || substr($value,0,1)=="[" && substr($value,strlen($value)-1,1) == "]") {
                        $output.= '"' . $key . '":' . $value . ',';
                    } else {
                        $output.= '"' . $key . '":"' . str_replace('"','\"',$value) . '",';
                    }
                }
            }
            $output= substr($output,0,strlen($output)-1);
            $output.="},\n";
        } while ($rows['data'] = mysql_fetch_assoc($rows['object']));
        $output = substr($output,0,strlen($output)-2);
        $output.= "]";

        echo $output;
    }

?>