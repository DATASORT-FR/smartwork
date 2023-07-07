<?php
/**
* This file contains classes and function for the variables management.
*
* @package    use_field
* @subpackage business_process
* @version    1.0
* @date       02 Septembre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the variables management.
*/

function exceptions_error_handler($severity, $message, $filename, $lineno) {
  if (error_reporting() == 0) {
    return;
  }
  if (error_reporting() & $severity) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
  }
}

class object_trace extends BUS_object
{

/**************************************
* Private and statics variables
**************************************/
	private static $_notvalues = array(
		'date_creation',
		'date_update',
		'value'
	);

	private static $_fields = array(
		'id',
		'session',
		'reference',
		'user',
		'domain_id',
		'domain_name',
		'situation_id',
		'situation_nodes',
		'process_id',
		'process_nodes',
		'slide',
		'display_value'
	);
	
/**************************************
* Private and statics functions
**************************************/
 	private static function calculateCtrl($str) {
		$return = false;
		$pattern = array("#\+#","#-#","#\*#","#/#","#\^#","#&#","#%#","#\.#","#,#","#\(#","#\)#","#\d#","#\s#");
		
		$str = preg_replace($pattern, '', $str);
		
		if (empty($str)) {
			$return = true;
		}
		
		return $return;
	}

   private static function calculateStr($str) {
		$tab=array();
		$operateurs=array("+","-","*","/","^","&","%");
		$fonc_math=array("a","c","s","t");
		$operateurs_prioritaires=array("*","/","&","%","^");
 
		set_error_handler('exceptions_error_handler');
		try {
			$cur=0;
			$i=0;
			while($i<strlen($str)) {
				$char=substr($str,$i,1);
				if(in_array($char,$operateurs) and !$i==0) {
					$tab[$cur+1]=$char;
					$cur +=2;
					$i++;
				}
				else {
					if (in_array($char,$fonc_math)) {
						switch($char) {
							case "a":
								if (substr($str,$i, 3) == 'age') {
									$temp = doubleval(substr($str,$i+3));
									$now = strtotime(date('Y-m-d'));
									$tab[$cur] = floor(($now - $temp)/(365 * 60 * 60 * 24));
								}
								else {
									$tab[$cur] = round(abs(doubleval(substr($str,$i+3))),3);
								}
								break;
							case "c":
								$tab[$cur] = round(cos(deg2rad(doubleval(substr($str,$i+3)))),3);
								break;
							case "s":
								$tab[$cur] = round(sin(deg2rad(doubleval(substr($str,$i+3)))),3);
								break;
							case "t":
								$tab[$cur] = round(tan(deg2rad(doubleval(substr($str,$i+3)))),3);
								break;
						}
						$lng = doubleval(substr($str,$i+3));
						settype($lng,"string");
						$i +=strlen($lng)+3;
					}
					else {
						if (!array_key_exists($cur,$tab)) {
							$tab[$cur]=$char;
						}
						else {
							$tab[$cur] .=$char;
						}
						$i++;
					}
				}
			}
			unset($i);
			if (isset($tab[0])) {
				$somme = doubleval($tab[0]);
			}
			else {
				$somme = 0;
			}
			$i=1;
			while($i<count($tab)) {
				switch($tab[$i]) {
					case "+":
						if((count($tab)-$i > 30) and (in_array($tab[$i+2],$operateurs_prioritaires))) {
							switch($tab[$i+2]) {
								case "*":
									$somme += (doubleval($tab[$i+1])*doubleval($tab[$i+3]));
									break;
								case "/":
									if(doubleval($tab[$i+3]==0)) {
										return "error";
										exit;
									}
									$somme += (doubleval($tab[$i+1])/doubleval($tab[$i+3]));
									break;
								case "&":
									$somme -= (doubleval($tab[$i+1])*doubleval($tab[$i+3]));
									break;
								case "%":
									if(doubleval($tab[$i+3]==0)) {
										return "error";
										exit;
									}
									$somme -= (doubleval($tab[$i+1])/doubleval($tab[$i+3]));
									break;
								case "^":
									$somme += pow(doubleval($tab[$i+1]),doubleval($tab[$i+3]));
									break;                            
							}
							$i +=4;   
						}
						else {
							$somme += doubleval($tab[$i+1]);
							$i +=2;
						}
						break;
					case "-":
						if((count($tab)- $i > 30) and (in_array($tab[$i+2],$operateurs_prioritaires))) {
							switch($tab[$i+2]) {
								case "*":
									$somme -= (doubleval($tab[$i+1])*doubleval($tab[$i+3]));
									break;
								case "/":
									if(doubleval($tab[$i+3]==0)) {
										return "error";
										exit;
									}
									$somme -= (doubleval($tab[$i+1])/doubleval($tab[$i+3]));
									break;
								case "&":
									$somme += (doubleval($tab[$i+1])*doubleval($tab[$i+3]));
									break;
								case "%":
									if(doubleval($tab[$i+3]==0)) {
										return "error";
										exit;
									}
									$somme += (doubleval($tab[$i+1])/doubleval($tab[$i+3]));
									break;
								case "^":
									$somme -= pow(doubleval($tab[$i+1]),doubleval($tab[$i+3]));
									break;                            
							}
							$i +=4;   
						}
						else {
							$somme -= doubleval($tab[$i+1]);
							$i +=2;
						}
						break;
					case "*":
						$somme *= doubleval($tab[$i+1]);
						$i+=2;
						break;
					case "/":
						if(doubleval($tab[$i+1]==0)) {
							return "error";
							exit;
						}
						$somme /= doubleval($tab[$i+1]);
						$i+=2;
						break;
					case "&":
						$somme *= -doubleval($tab[$i+1]);
						$i+=2;
						break;
					case "%":                
						$somme /= -doubleval($tab[$i+1]);
						$i+=2;
						break;
					case "^":
						$somme = pow( $somme , doubleval( $tab[$i+1 ] ) );
						$i+=2;
						break;                   
				}
			}
 		}
		catch (exception $e) {
			$somme = 'error';
		}
       return $somme;
    }
   	
	private static function ctrlFormula($formula) {
		$return = true;
		
		return $return;
	}

/**************************************
* Private variables
**************************************/
    private $_fieldList = array();
    private $_nodes = array();

/**************************************
* Private functions
**************************************/
    private function EvalStr($str) {
		$error = strrpos($str, "error");
		if(!is_bool($error) && $error >=0 ) {
			return "error";
			exit;
		}

		$str=str_replace(",",".",$str);
		$str=str_replace("--","+",$str);
		$str=str_replace("+-","-",$str);
		$str=str_replace("*-","&",$str);
		$str=str_replace("/-","%",$str);
		$str=str_replace("==","=",$str);

		$positionStart = strrpos($str, "(");
		if (is_bool($positionStart) && !$positionStart) {       
			$typeCond = 0;
			if (($typeCond == 0) and (strrpos($str, "<=") > 0)) {
				$typeCond = 1;
				$aTemp = explode('<=', $str);
			}
			if (($typeCond == 0) and (strrpos($str, ">=") > 0)) {
				$typeCond = 2;
				$aTemp = explode('>=', $str);
			}
			if (($typeCond == 0) and (strrpos($str, "<") > 0)) {
				$typeCond = 3;
				$aTemp = explode('<', $str);
			}
			if (($typeCond == 0) and (strrpos($str, ">") > 0)) {
				$typeCond = 4;
				$aTemp = explode('>', $str);
			}
			if (($typeCond == 0) and (strrpos($str, "=") > 0)) {
				$typeCond = 5;
				$aTemp = explode('=', $str);
			}
			
			if ($typeCond != 0) {
				if (self::calculateCtrl($aTemp[0])) {
					$valeur1 = self::calculateStr($aTemp[0]);
				}
				else {
					$valeur1 = $aTemp[0];
				}
				if (count($aTemp) > 1) {
					if (self::calculateCtrl($aTemp[1])) {
						$valeur2 = self::calculateStr($aTemp[1]);
					}
					else {
						$valeur2 = $aTemp[1];
					}
				}
				else {
						$valeur2 = '0';					
				}
				$valeur = 0;
				switch ($typeCond) {
					case 1 :
						if ($valeur1 <= $valeur2) {
							$valeur = 1;
						}
						break;
					case 2 :
						if ($valeur1 >= $valeur2) {
							$valeur = 1;
						}
						break;
					case 3 :
						if ($valeur1 < $valeur2) {
							$valeur = 1;
						}
						break;
					case 4 :
						if ($valeur1 > $valeur2) {
							$valeur = 1;
						}
						break;
					default:
						if ($valeur1 == $valeur2) {
							$valeur = 1;
						}
				}
				return $valeur;
			}
			else {
				return self::calculateStr($str);
			}
		}
		else {
			$positionEnd=strpos(substr($str,$positionStart),")");
			$metaFunction = '';
			if (substr($str,$positionStart-7, 7) == 'average') {
				$metaFunction = 'average';
			}
			if (substr($str,$positionStart-3, 3) == 'max') {
				$metaFunction = 'max';
			}
			if (substr($str,$positionStart-3, 3) == 'min') {
				$metaFunction = 'min';
			}
			if (substr($str,$positionStart-4, 4) == 'node') {
				$metaFunction = 'node';
			}
			switch ($metaFunction) {
				case 'average' :
					$aTemp = explode(';', substr($str,$positionStart+1,$positionEnd-1));
					for($i=0; $i < count($aTemp); $i++) {
						$aTemp[$i] = self::calculateStr($aTemp[$i]);
					}
					$valeur = array_sum($aTemp)/count($aTemp);
					$str=str_replace(substr($str,$positionStart-7,$positionEnd+8),$valeur,$str);
					break;
				case 'max' :
					$aTemp = explode(';', substr($str,$positionStart+1,$positionEnd-1));
					for($i=0; $i < count($aTemp); $i++) {
						$aTemp[$i] = self::calculateStr($aTemp[$i]);
					}
					$valeur = 0;
					if (isset($aTemp[0])) {
						$valeur = $aTemp[0];
					}
					for($i=1; $i < count($aTemp); $i++) {
						if ($aTemp[$i] > $valeur) {
							$valeur = $aTemp[$i];
						}
					}
					$str=str_replace(substr($str,$positionStart-3,$positionEnd+4),$valeur,$str);
					break;
				case 'min' :
					$aTemp = explode(';', substr($str,$positionStart+1,$positionEnd-1));
					for($i=0; $i < count($aTemp); $i++) {
						$aTemp[$i] = self::calculateStr($aTemp[$i]);
					}
					$valeur = 0;
					if (isset($aTemp[0])) {
						$valeur = $aTemp[0];
					}
					for($i=1; $i < count($aTemp); $i++) {
						if ($aTemp[$i] < $valeur) {
							$valeur = $aTemp[$i];
						}
					}
					$str=str_replace(substr($str,$positionStart-3,$positionEnd+4),$valeur,$str);
					break;
				case 'node' :
					$sTemp=self::calculateStr(substr($str,$positionStart+1,$positionEnd-1));
					$valeur = 0;
					if (in_array($sTemp, $this->_nodes)) {
						$valeur = 1;
					}
					$str=str_replace(substr($str,$positionStart-4,$positionEnd+5),$valeur,$str);
					break;
				default:
					$valeur=self::calculateStr(substr($str,$positionStart+1,$positionEnd-1));
					$str=str_replace(substr($str,$positionStart,$positionEnd+1),$valeur,$str);            
			}
			return $this->EvalStr($str);
		}
    }

	private function evalFormula($formula, $type, $traceItem) {
		if (($type == 2) or ($type == 3)) {
			$value = 0;
		}
		else {
			$value = '';
		}
		if (self::ctrlFormula($formula)) {
			$stemp = $formula;
			preg_match_all("#\[(.*)\]#isU", $stemp, $matchesResult);
			for($i=0; $i < count($matchesResult[1]); $i++) {
				$field = $matchesResult[1][$i];
				if (isset($this->_fieldList[$field])) {
					if ($this->_fieldList[$field]['calculate'] != 1) {
						switch ($this->_fieldList[$field]['nature']) {
							case 1 :
								$this->evalVariable($field, $traceItem);
								break;
							case 2 :
								$this->evalTable($field, $traceItem);
								break;
							case 3 :
								$this->evalResult($field, $traceItem);
								break;
							default :
								$this->evalVariable($field, $traceItem);
						}
					}
					if ($this->_fieldList[$field]['nature'] == 1) {
						$value = $this->convVariable($this->_fieldList[$field]['value'], $this->_fieldList[$field]['type'], $type);
					}
					else {
						$value = $this->_fieldList[$field]['value'];
					}
					// Spec Separation Begin
					if ($type == 1) {
//						if ($this->_fieldList[$field]['nature'] == 1) {
//							if ($this->_fieldList[$field]['type_base'] == 6) {
//								$value = number_format($value, 0, ",", " ");
//							}
//						}
						if ($this->_fieldList[$field]['nature'] == 3) {
							if ($this->_fieldList[$field]['type_base'] == 5) {
								$value = number_format($value, 0, ",", " ");
							}
						}
					}
					// Spec Separation End
					$stemp = preg_replace("#\[" . $field . "\]#isU", $value, $stemp);
				}
			}

			// Meta fonction IF
			$positionStart = strrpos($stemp, "if(");
			while (!is_bool($positionStart) or $positionStart) {
				$str = substr($stemp,$positionStart + 3);
				$j=0;
				$pos = -1;
				while($j < strlen($str)) {
					$char=substr($str,$j,1);
					if ($char == '(') {
						$pos--;
					}
					if ($char == ')') {
						$pos++;
					}
					if ($pos == 0) {
						break;
					}
					$j++;
				}
				
				if ($pos == 0) {
					$str = substr($str,0,$j);				

					$aTemp = explode(';', $str);
					$cond = 0;
					if (isset($aTemp[0])) {
						$cond = $this->EvalStr($aTemp[0]);
					}
					$valeur = '0';
					if ($cond > 0) {
						if (isset($aTemp[1])) {
							$valeur = $aTemp[1];
						}
					}
					else {
						if (isset($aTemp[2])) {
							$valeur = $aTemp[2];
						}
					}
					$stemp = str_replace('if(' . $str . ')', $valeur, $stemp);
					$positionStart = strrpos($stemp, "if(");
				}
				else {
					break;
				}
			}

			switch ($type) {
				case 2 :
					$value = floor((float) $this->EvalStr($stemp));
					break;
				case 3 :
					$value = round((float) $this->EvalStr($stemp),2);
					break;
				default :
					$value = $stemp;
			}
			unset($stemp);
			unset($matchesResult);
		}
		return $value;
	}

	private function convVariable($valueInit, $typeInit, $type=0) {
		
		switch ($typeInit) {
			case 2 :
				$value = $valueInit;
				break;
			case 3 :
				$value = $valueInit;
				break;
			case 4 :
				switch ($type) {
					case 2 :
					case 3 :
						if (empty($valueInit)) {
							$valueInit = date('Y-m-d');
						}
						$dateValue = DateTime::createFromFormat('Y-m-d', $valueInit);
						$value = strtotime($dateValue->format('Y-m-d'));
						break;
					case 4 :
						$value = $valueInit;
						break;
					default :
						if (!empty($valueInit)) {
							$dateValue = DateTime::createFromFormat('Y-m-d', $valueInit);
							$value = $dateValue->format('d/m/Y');
						}
						else {
							$value = $valueInit;
						}
				}
				break;
			default :
				$value = $valueInit;
		}
		settype($value,"string");
		
		unset($dateValue);
		
		return $value;
	}
	
	private function evalVariable($name, $traceItem) {
		$fieldItem = $this->_fieldList[$name];

		$type = $fieldItem['type'];
		if (isset($traceItem[$name])) {
			switch ($type) {
				case 2 :
					if (empty($traceItem[$name])) {
						$value = 0;
					}
					else {
						$value = intval($traceItem[$name]);
					}
					break;
				case 3 :
					if (empty($traceItem[$name])) {
						$value = 0;
					}
					else {
						$value = doubleval($traceItem[$name]);
					}
					break;
				case 8 :
					if (empty($traceItem[$name])) {
						$value = date('d/m/Y');
					}
					else {
						$value = $traceItem[$name];
					}
					break;
				default :
					$value = $traceItem[$name];
			}
		}
		else {
			switch ($type) {
				case 2 :
				case 3 :
					$value = 0;
					break;
				default :
					$value = '';
			}
		}
		$fieldItem['value'] = $value;
		$fieldItem['calculate'] = 1;
		$this->_fieldList[$name] = $fieldItem;
	}

	private function evalTable($name, $traceItem) {
		$fieldItem = $this->_fieldList[$name];

		$type = $fieldItem['type'];
		switch ($type) {
			case 2 :
			case 3 :
				$value = 0;
				break;
			default :
				$value = '';
		}
		if (!empty($fieldItem['col1_field'])) {
			$formula = $fieldItem['col1_field'];
			$col1 = $this->evalFormula($formula, $type, $traceItem);
			$tableValueList1 = array();
			$tableValueObject = new object_table_value();
			$tableValueObject->filterSet('field_id',$fieldItem['id']);
			$tableValueList = $tableValueObject->displayList(0)->returnGet();
			for($i=0; $i < count($tableValueList); $i++) {
				if ($fieldItem['col1_byrange'] == 1) {
					if ($tableValueList[$i]['col1_min'] <= $col1) {
						if (($tableValueList[$i]['col1_max'] >= $col1) or ($tableValueList[$i]['col1_max'] == 0)) {
							$tableValueList1[] = $tableValueList[$i];
						}
					}
				}
				else {
					if ($tableValueList[$i]['col1_min'] == $col1) {
						$tableValueList1[] = $tableValueList[$i];
					}
				}
			}
		}
		if (!empty($fieldItem['col2_field'])) {
			$formula = $fieldItem['col2_field'];
			$col2 = $this->evalFormula($formula, $type, $traceItem);
			$tableValueList2 = array();
			for($i=0; $i < count($tableValueList1); $i++) {
				if ($fieldItem['col2_byrange'] == 1) {
					if ($tableValueList1[$i]['col2_min'] <= $col2) {
						if (($tableValueList1[$i]['col2_max'] >= $col2) or ($tableValueList1[$i]['col2_max'] == 0)) {
							$tableValueList2[] = $tableValueList1[$i];
						}
					}
				}
				else {
					if ($tableValueList1[$i]['col2_min'] == $col2) {
						$tableValueList2[] = $tableValueList1[$i];
					}
				}
			}
			
			if (!empty($fieldItem['col3_field'])) {
				$formula = $fieldItem['col3_field'];
				$col3 = $this->evalFormula($formula, $type, $traceItem);
				$tableValueList3 = array();
				for($i=0; $i < count($tableValueList2); $i++) {
					if ($fieldItem['col3_byrange'] == 1) {
						if ($tableValueList2[$i]['col3_min'] <= $col3) {
							if (($tableValueList2[$i]['col3_max'] >= $col3) or ($tableValueList2[$i]['col3_max'] == 0)) {
								$tableValueList3[] = $tableValueList2[$i];
							}
						}
					}
					else {
						if ($tableValueList2[$i]['col3_min'] == $col3) {
							$tableValueList3[] = $tableValueList2[$i];
						}
					}
				}
				if (isset($tableValueList3[0])) {
					$value = $tableValueList3[0]['value'];
				}
			}	
			else {
				if (isset($tableValueList2[0])) {
					$value = $tableValueList2[0]['value'];
				}
			}
			
		}
		else {
			if (isset($tableValueList1[0])) {
				$value = $tableValueList1[0]['value'];
			}
		}

		$fieldItem['value'] = $value;
		$fieldItem['calculate'] = 1;


		$this->_fieldList[$name] = $fieldItem;
	}

	private function evalResult($name, $traceItem) {
		$fieldItem = $this->_fieldList[$name];

		$type = $fieldItem['type'];
		$formula = $fieldItem['formula'];
		$value = $this->evalFormula($formula, $type, $traceItem);

		$fieldItem['value'] = $value;
		$fieldItem['calculate'] = 1;

		$this->_fieldList[$name] = $fieldItem;
	}

	private function evalDisplayVariable($name, $traceItem) {
		$fieldItem = $this->_fieldList[$name];

		$formula = $fieldItem['display_func'];
		if (empty($formula)) {
			$value = 1;
		}
		else {
			$value = $this->evalFormula($formula, 2, $traceItem);
		}
		$fieldItem['display'] = $value;

		$this->_fieldList[$name] = $fieldItem;
	}

	private function evalDisplayResult($name, $traceItem) {
		$fieldItem = $this->_fieldList[$name];

		$formula = $fieldItem['display_func'];
		if (empty($formula)) {
			$value = 1;
		}
		else {
			$value = $this->evalFormula($formula, 2, $traceItem);
		}
		$fieldItem['display'] = $value;

		$this->_fieldList[$name] = $fieldItem;
	}

/**************************************
* Methods for the object
**************************************/

	/**
	* constructor trace
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('trace');
		$this->idSet('id');
		$this->selectLabelFieldSet('code');

		/* Table structure for the object */
		$this->tableSet('dmg_trace');
		$this->creationDateSet('date_creation');
		$this->updateDateSet('date_update');

		$this->fieldTableSet('id');
		$this->fieldTableSet('date_creation');
		$this->fieldAttrSet('date_creation', 'date', array(
			'auto' => true));
		$this->fieldTableSet('date_update');
		$this->fieldAttrSet('date_update', 'date', array(
			'auto' => true));
		$this->fieldTableSet('session');
		$this->fieldTableSet('reference');
		$this->fieldTableSet('user');
		$this->fieldTableSet('domain_id');
		$this->fieldTableSet('domain_name');
		$this->fieldTableSet('situation_id');
		$this->fieldTableSet('situation_nodes');
		$this->fieldTableSet('process_id');
		$this->fieldTableSet('process_nodes');
		$this->fieldTableSet('slide');
		$this->fieldTableSet('value');
		$this->fieldTableSet('display_value');

		$this->fieldCompoSet('code', 'append', 'domain_name');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'reference');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'session');

		$this->orderTableSet(0,'domain_id');
		$this->orderTableSet(0,'session');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'domain_id');
		$this->orderTableSet(1,'reference');
		$this->orderTableSet(1,'id');
	}

   public function displayList()
    {

		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', $this->dbnameGet() . ' - Object DisplayList for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		$error = '';

		try {
			$tb_trace = new Smart_select('dmg_trace', 'trace');
			$tb_trace->fieldSet('id');
			$tb_trace->fieldSet('session');
			$tb_trace->fieldSet('reference');
			$tb_trace->fieldSet('user');
			$tb_trace->fieldSet('domain_id');
			$tb_trace->fieldSet('domain_name');
			$tb_trace->fieldSet('situation_id');
			$tb_trace->fieldSet('situation_nodes');
			$tb_trace->fieldSet('process_id');
			$tb_trace->fieldSet('process_nodes');
			$tb_trace->fieldSet('slide');
			$traceList = $tb_trace->findAll();
		
			$fct_return->returnSet($traceList);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$traceList = array();
			$fct_return->errorSet($traceList);
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;
	}	

    public function display($id)
    {
		$fct_return = parent::display($id);

		if ($fct_return->statusGet()) {
			$item = $fct_return->returnGet();
			if (isset($item['value'])) {
				$arrayValue = json_decode($item['value'], true);
			}
			else {
				$arrayValue = array();
			}
			foreach($arrayValue as $key=>$value) {
				$updateFlag = true;
				if ((in_array($key, self::$_notvalues)) or (in_array($key, self::$_fields))) {
					$updateFlag = false;
				}
				if ($updateFlag) {
					$item[$key] = $value;
				}
			}
			unset($item['value']);
			if (empty($item['display_value'])) {
				$item['display_value'] = '';
			}
			$item['display_value'] = json_decode($item['display_value'], true);
			$fct_return->returnSet($item);
		}
		return $fct_return;
	}
	
	
    public function insert($argArray, $dbName = '')
    {
		$arrayValue = array();
		$item = array();
		foreach($argArray as $key=>$value) {
			$updateFlag = true;
			if (in_array($key, self::$_notvalues)) {
				$updateFlag = false;
			}
			if (in_array($key, self::$_fields)) {
				$updateFlag = false;
				$item[$key] = $value;
			}
			if ($updateFlag) {
				$arrayValue[$key] = $value;
			}
		}
		$item['value'] = json_encode($arrayValue);
		$fct_return = parent::insert($item);
		return $fct_return;
	}

    public function init()
    {
		$domainId = 0;
		$reference = '';
		$sessionId = '';
		$userId = 0;

		$noident = 1;
		$argFunc = func_get_args();
		if (is_array($argFunc[0])) {
			foreach($argFunc[0] as $key=>$value) {
				switch (strtoupper($key)) {
					case "DOMAIN_ID" :
						$domainId = trim($value);
						break;
					case "REFERENCE" :
						$reference = trim($value);
						break;
					case "SESSION" :
						$sessionId = trim($value);
						break;
					case "USER" :
						$userId = trim($value);
						break;
				}
			}
		}
		else {
			for($temp=0; $temp < count($argFunc); $temp++) {
				$atemp = explode(':', $argFunc[$temp]);
				if (count($atemp) > 1) {
					switch (strtoupper(trim($atemp[0]))) {
						case "DOMAIN_ID" :
								$domainId = trim($atemp[1]);
						break;
						case "REFERENCE" :
							$reference = trim($atemp[1]);
							break;
						case "SESSION" :
							$sessionId = trim($atemp[1]);
							break;
						case "USER" :
							$userId = trim($atemp[1]);
							break;
					}
				}
				else {
					switch ($noident) {
						case 1 :
							$domainId = $argFunc[$temp];
							break;
						case 2 :
							$reference = trim($argFunc[$temp]);
							break;
						case 3 :
							$sessionId = trim($argFunc[$temp]);
							break;
						case 4 :
							$userId = $argFunc[$temp];
							break;
					}
					$noident++;
				}
			}
		} 

		$fct_return = new return_function;

		$tb_domain = new Smart_select('dmg_domain', 'dgm');
		$tb_domain->fieldSet('id');
		$tb_domain->fieldSet('name');
		$tb_domain->whereSet('id', $domainId);
		$domain = $tb_domain->find();
		$domainName = $domain['name'];

		$tb_trace = new Smart_select('dmg_trace', 'trace');
		$tb_trace->fieldSet('id');
		$tb_trace->fieldSet('session');
		$tb_trace->fieldSet('reference');
		$tb_trace->fieldSet('user');
		$tb_trace->fieldSet('domain_id');
		$tb_trace->fieldSet('domain_name');
		$tb_trace->fieldSet('situation_id');
		$tb_trace->fieldSet('situation_nodes');
		$tb_trace->fieldSet('process_id');
		$tb_trace->fieldSet('process_nodes');
		if (empty($reference)) {
			$tb_trace->whereSet('domain_id', $domainId);
			$tb_trace->whereSet('session', $sessionId, 'and');
			$trace = $tb_trace->find();
		}
		else {
			$tb_trace->whereSet('domain_id', $domainId);
			$tb_trace->whereSet('reference', $reference, 'and');
			$trace = $tb_trace->find();
			if (empty($trace)) {
				$tb_trace->whereSet('domain_id', $domainId);
				$tb_trace->whereSet('session', $sessionId, 'and');
				$trace = $tb_trace->find();
				if (!empty($trace)) {
					$trace['session'] = '';
					$trace['reference'] = $reference;
					$fct_return = parent::update($trace);
				}
			}
		}
		if (empty($trace)) {
			$tb_trace = new Smart_record('dmg_trace', 'trace');
			$tb_trace->fieldSet('session', $sessionId);
			$tb_trace->fieldSet('reference', $reference);
			$tb_trace->fieldSet('user', $userId);
			$tb_trace->fieldSet('domain_id', $domainId);
			$tb_trace->fieldSet('domain_name', $domainName);
			$id = $tb_trace->insert();

			$trace = array();
			$trace['id'] = $id;
			$trace['session'] = $sessionId;
			$trace['reference'] = $reference;
			$trace['user'] = $userId;
			$trace['domain_id'] = $domainId;
			$trace['domain_name'] = $domainName;
			$trace['situation_id'] = 0;
			$trace['situation_nodes'] = '';
			$trace['process_id'] = 0;
			$trace['process_nodes'] = '';
			$trace['value'] = '{}';
		}
		
		$fct_return->returnSet($trace);
		return $fct_return;
	}

    public function update($argArray, $dbName = '')
    {
		$id = $argArray['id'];
		$fct_return = $this->display($id);
		if ($fct_return->statusGet()) {
			$traceItem = $fct_return->returnGet();
			foreach($argArray as $key=>$value) {
				if (preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $value)) {
					$aTemp = explode('/',$value);
					$value = $aTemp[2] .'-' . $aTemp[1] .'-' . $aTemp[0];
				}
				if (!in_array($key, self::$_notvalues)) {
					$traceItem[$key] = $value;
				}
			}
			$domainId = $traceItem['domain_id'];
			if (empty($traceItem['situation_nodes'])) {
				$traceItem['situation_nodes'] = '';
			}
			if (empty($traceItem['process_nodes'])) {
				$traceItem['process_nodes'] = '';
			}
			$this->_nodes = array_merge(explode(';', $traceItem['situation_nodes']), explode(';', $traceItem['process_nodes']));
		
			$variableObject = new object_field_variable();
			$variableObject->filterSet('domain_id',$domainId);
			$variableList = $variableObject->displayList(0)->returnGet();
			for($i=0; $i < count($variableList); $i++) {
				$variable = $variableList[$i];
				if ($variable['type_id'] == 9) {
					$aTemp = explode(';', $variable['variable_object_items']);
					for($j=0; $j < count($aTemp); $j++) {
						for($k=0; $k < count($variableList); $k++) {
							$variableItem = $variableList[$k];
							if ($variableItem['id'] == $aTemp[$j]) {
	
								$fieldItem = array();
								$fieldItem['id'] = $variable['id'];
								$fieldItem['nature'] = $variableItem['nature'];
								$type = 1;
								switch ($variableItem['type_id']) {
									case 2 :
										$type = 2;
										break;
									case 3 :
										$type = 3;
										break;
									case 6 :
										$type = 3;
										break;
									case 8 :
										$type = 4;
										break;
									default :
										$type = 1;
								}
								// Spec Separation Begin
								$fieldItem['type_base'] = $variableItem['type_id'];
								// Spec Separation End
								$fieldItem['type'] = $type;
								$fieldItem['calculate'] = 0;
								$fieldItem['display_func'] = $variable['display_func'];
								$this->_fieldList[$variable['name'] . '_' . $variableItem['name']] = $fieldItem;
							}
						}
					}
				}
				else {
					$fieldItem = array();
					$fieldItem['id'] = $variable['id'];
					$fieldItem['nature'] = $variable['nature'];
					$type = 1;
					switch ($variable['type_id']) {
						case 2 :
							$type = 2;
							break;
						case 3 :
							$type = 3;
							break;
						case 6 :
							$type = 3;
							break;
						case 8 :
							$type = 4;
							break;
						default :
							$type = 1;
					}
					// Spec Separation Begin
					$fieldItem['type_base'] = $variable['type_id'];
					// Spec Separation End
					$fieldItem['type'] = $type;
					$fieldItem['calculate'] = 0;
					$fieldItem['display_func'] = $variable['display_func'];
					$this->_fieldList[$variable['name']] = $fieldItem;
				}
			}

			$tableObject = new object_field_table();
			$tableObject->filterSet('domain_id',$domainId);
			$tableList = $tableObject->displayList(0)->returnGet();
			for($i=0; $i < count($tableList); $i++) {
				$tableItem = $tableList[$i];
				$fieldItem = array();
				$fieldItem['id'] = $tableItem['id'];
				$fieldItem['nature'] = $tableItem['nature'];
				// Spec Separation Begin
				$fieldItem['type_base'] = $tableItem['type_id'];
				// Spec Separation End
				$fieldItem['type'] = $tableItem['type_id'];
				$fieldItem['col1_field'] = $tableItem['table_col1_field'];
				$fieldItem['col1_byrange'] = $tableItem['table_col1_byrange'];
				$fieldItem['col2_field'] = $tableItem['table_col2_field'];
				$fieldItem['col2_byrange'] = $tableItem['table_col2_byrange'];
				$fieldItem['col3_field'] = $tableItem['table_col3_field'];
				$fieldItem['col3_byrange'] = $tableItem['table_col3_byrange'];
				$fieldItem['function'] = $tableItem['table_function'];
				$fieldItem['calculate'] = 0;
				$this->_fieldList[$tableItem['name']] = $fieldItem;
			}

			$resultObject = new object_field_result();
			$resultObject->filterSet('domain_id',$domainId);
			$resultList = $resultObject->displayList(0)->returnGet();
			for($i=0; $i < count($resultList); $i++) {
				$resultItem = $resultList[$i];
				$fieldItem = array();
				$fieldItem['id'] = $resultItem['id'];
				$fieldItem['nature'] = $resultItem['nature'];
				switch ($resultItem['type_id']) {
					case 2 :
						$type = 2;
						break;
					case 3 :
						$type = 3;
						break;
					case 4 :
						$type = 4;
						break;
					case 5 :
						$type = 3;
						break;
					case 6 :
						$type = 1;
						break;
					default :
						$type = 1;
				}
				// Spec Separation Begin
				$fieldItem['type_base'] = $resultItem['type_id'];
				// Spec Separation End
				$fieldItem['type'] = $type;
				$fieldItem['formula'] = $resultItem['result_formula'];
				$fieldItem['display_func'] = $resultItem['display_func'];
				$fieldItem['function'] = $resultItem['result_function'];
				$fieldItem['calculate'] = 0;
				$this->_fieldList[$resultItem['name']] = $fieldItem;
			}

			foreach($this->_fieldList as $name=>$fieldItem) {
				if ($fieldItem['calculate'] == 0) {
					switch ($fieldItem['nature']) {
						case 1 :
							$this->evalVariable($name, $traceItem);
							break;
						case 2 :
							$this->evalTable($name, $traceItem);
							break;
						case 3 :
							$this->evalResult($name, $traceItem);
							break;
						default :
							$this->evalVariable($name, $traceItem);
					}
				}
			}

			foreach($this->_fieldList as $name=>$fieldItem) {
				if ($fieldItem['calculate'] == 1) {
					switch ($fieldItem['nature']) {
						case 1 :
							$this->evalDisplayVariable($name, $traceItem);
							break;
						case 3 :
							$this->evalDisplayResult($name, $traceItem);
							break;
					}
				}
			}

			$displayArray = array();
			foreach($this->_fieldList as $name=>$fieldItem) {
				if (($fieldItem['nature'] == 1) or ($fieldItem['nature'] == 3)) {
					$displayArray[$name] = $fieldItem['display'];
				}
			}
		
			foreach($this->_fieldList as $name=>$fieldItem) {
				$traceItem[$name] = $fieldItem['value'];
			}
			$traceItem['display_value'] = json_encode($displayArray);
		
			$item = array();
			$arrayValue = array();
			foreach($traceItem as $key=>$value) {
				$updateFlag = true;
				if (in_array($key, self::$_notvalues)) {
					$updateFlag = false;
				}
				if (in_array($key, self::$_fields)) {
					$updateFlag = false;
					$item[$key] = $value;
				}
				if ($updateFlag) {
					$arrayValue[$key] = $value;
				}
			}
			$item['value'] = json_encode($arrayValue);
			$fct_return = parent::update($item);
		}
		return $fct_return;
	}
	
}