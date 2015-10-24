<?php
define('CURRENT_YEAR', 2008);

class OracleDB
{
	private $conn = null;
	private $debug = false;
	private $error = null;
	
	public function __construct($debug = false)
	{
		$this -> conn = oci_connect("GANGTEMP", "gdb");
		$this -> debug = $debug;
	}
	
	public function __destruct()
	{
		oci_close($this -> conn);
	}
	
	public function getLastError()
	{
		return $this -> error;
	}
	
	public function fetchAll($sql, $key_column = '')
	{
		$stmt = oci_parse($this -> conn, $sql);
		oci_execute($stmt);
		
		$results = array();
		$nrows = oci_fetch_all($stmt, $results, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
		oci_free_statement($stmt);
		
		if (empty($key_column))
		{
			return $results;
		}
		else
		{
			$ret_array = array();
			foreach ($results as $row)
			{
				$ret_array[$row[$key_column]] = $row;
			}
			return $ret_array;
		}
	}
	
	public function fetchOne($sql)
	{

		$stmt = oci_parse($this -> conn, $sql);
		oci_execute($stmt);		

		$results = array();
		
		$nrows = oci_fetch_all($stmt, $results, 0, -1, OCI_NUM + OCI_FETCHSTATEMENT_BY_COLUMN);
		
		oci_free_statement($stmt);
		
		if (isset($results[0][0]))
		{
			return $results[0][0];
		}
		else
		{
			return false;
		}
	}
	
	public function fetchRow($sql)
	{
		$stmt = oci_parse($this -> conn, $sql);
		oci_execute($stmt);
		
		$results = array();
		$nrows = oci_fetch_all($stmt, $results, 0, -1, OCI_NUM + OCI_FETCHSTATEMENT_BY_COLUMN);
		oci_free_statement($stmt);
		// print_r($results);
		if (count($results) > 0)
		{
			$ret = array();
			foreach ($results as $item)
			{
				$ret[] = $item[0];
			}
			return $ret;
		}
		else
		{
			return false;
		}
	}
	
	public function executeQuery($sql)
	{
		$stmt = oci_parse($this -> conn, $sql);
		
		$ret = oci_execute($stmt);
		if ($ret === false)
		{
			$this -> error = oci_error($stmt);
		}
		else
		{
			$this -> error = null;
		}
		oci_free_statement($stmt);
		
		if ( (strpos($sql, 'INSERT') !== false) || (strpos($sql, 'UPDATE') !== false) )
		{
			$sql = strtr($sql, array("'" => "''"));
			$matches = array();
			preg_match('/(INSERT INTO|UPDATE)\s(.*?)\s.*$/i', $sql, $matches);
			$table_name = strtoupper($matches[2]);
			// ToLog($table_name,  $sql);
		}
		
		return $ret;
	}
	
	public function prepareUpdateSql($table, $columns, $values, $date_columns = null)
	{
		$sql = 'UPDATE ' . $table . ' SET ';
		
		$first_set = true;
		foreach ($columns as $c)
		{	
			if (!isset($values[$c]) || $values[$c] == -1)
			{
				$values[$c] = '';
			}
			
			if (true)
			{
				if (!$first_set)
				{
					$sql .= ', ';
				}
				else
				{
					$first_set = false;
				}
				
				if (!isset($date_columns[$c]))
				{
					$sql .= ($c . '=\'' . $values[$c] . '\'');
				}
				else
				{
					if ($date_columns[$c] == 1)
					{
						$sql .= ($c . '=to_date(\'' . $values[$c] . '\', \'DD.MM.YYYY\')');
					}
					else if ($date_columns[$c] == 2)
					{
						$sql .= ($c . '=UPPER(\'' . $values[$c] . '\')');
					}
					else if ($date_columns[$c] == 3)
					{
						$sql .= ($c . '=NULL');
					}
				}
			}
		}
		
		if ($first_set)
		{
			return false;
		}
		else
		{
			return $sql;
		}
	}
	
	public function prepareInsertSql($table, $columns, $values, $extra_values = null, $date_columns = null)
	{
		
		$sql = 'INSERT INTO ' . $table . ' ( ';
		
		$column_names = '';
		$column_values = '';
		foreach ($columns as $c)
		{
			if (isset($values[$c]) && /* !empty($values[$c]) && */ ($values[$c] != -1))
			{
				if (!empty($column_names))
				{
					$column_names .= ', ';
				}
				$column_names .= $c;
				
				if (!empty($column_values))
				{
					$column_values .= ', ';
				}
				
				if (!isset($date_columns[$c]))
				{
					$column_values .= ('\'' . $values[$c] . '\'');
				}
				else
				{
					if ($date_columns[$c] == 1)
					{
						$column_values .= 'to_date(\'' . $values[$c] . '\', \'DD.MM.YYYY\')';
					}
					else if ($date_columns[$c] == 2)
					{
						$column_values .= 'UPPER(\'' . $values[$c] . '\')';
					}
				}
			}
		}
		
		if (empty($column_names))
		{
			return false;
		}
		
		if ($extra_values != null)
		{
			foreach ($extra_values as $key => $ev)
			{
				$column_names .= ', ' . $key;
				$column_values .= ', '  . $ev;
			}
		}
		$dddd = date("H:i:s j, n, Y");
		$tmp= $dddd. "  -  ".$sql . $column_names . ') VALUES (' . $column_values . ')' . "\n";
		$myFile = "log.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		fwrite($fh, $tmp);
		fclose($fh);

		
		return $sql . $column_names . ') VALUES (' . $column_values . ')';
	}
}

$db = new OracleDB();
?>