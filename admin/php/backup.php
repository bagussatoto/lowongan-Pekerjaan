<?php
	require "../../php/connection.php";

    $tables = array();
    $strQuery = "SHOW TABLES";
	$result = mysqli_query($connection, $strQuery);
	while($row = mysqli_fetch_row($result))
	{
		$tables[] = $row[0];
	}
	
    $return = "";
	$return .= "DROP DATABASE IF EXISTS db_lowker;\n";
	$return .= "CREATE DATABASE IF NOT EXISTS db_lowker;\n\n";
	foreach($tables as $table)
	{
        $strQuery = "SELECT * FROM $table";
	    $result = mysqli_query($connection, $strQuery);
		$num_fields = mysqli_num_fields($result);
		
		$return.= "DROP TABLE IF EXISTS $table;";
        $strQuery = "SHOW CREATE TABLE $table;";
		$row2 = mysqli_fetch_row(mysqli_query($connection, $strQuery));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
                $strQuery = "INSERT INTO $table VALUES(";
				$return.= $strQuery;
				for($j=0; $j < $num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
    $name = 'db-lowker'.date('YmdHis').'.sql';
	$handle = fopen("../backup/$name","w+");
	fwrite($handle, $return);
	fclose($handle);

	echo "<script language=javascript>alert('Sukses Backup Database dengan Nama File : $name');</script>";
	echo "<script language=javascript>document.location.href='../dashboard.php'</script>";
?>