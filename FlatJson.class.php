<?php
/*
 * Convert JSON object to one dimension JSON object or array
 * Example of a result:
 *   id, parentId, property, value type
 *   "id" will be a series number
 *   "parentId" indeciated which node this element belongs to
 *   "property" is the name of the object 
 *   "value" is the value of the object
 *   "type" will be "object", "array", "boolean", ...but we only
     use "object" and "array"
 * See json.org for JSON definition

 * @author Chen Lin clin@one-k.com
 * 2013/12/04
 */

include_once( "define.php" );

class FlatJson
{
	// input from the user
	private $input;

	// series id for each item
	private $id;

	// an array for return the flatten data
	private $flatArray;

	// error message if failed
	public  $errorMessage = "";
	
	function __construct($str){
		$this->input = $str;
	}

	public function flatToJson(){
		$this->flatArray = array();
		$this->id = 1;
		$ary = $this->flatToArray();
		if($ary == false){
			return false;
		}
        return json_encode($ary);
	}

    public function flatToArray(){
    	$this->flatArray = array();
    	$this->id = 1;
    	$str=$this->input;
        $jsonObject= json_decode($str);
        if($jsonObject == false){
        	$this->errorMessage = "flate Json Decode failed.";
        	return;
        }
		$flatArray = array();

		$this->toArray($jsonObject, "ancestor", 0);
		return $this->flatArray;
	}

	private function toArray($item, $parentName, $parentId){

	    switch(gettype($item)){
	    	// have child
	    	case TYPE_OBJECT:
		    case TYPE_ARRAY:
		       $anItem=array(
		    	    "id"=>$this->id, 
		    	    "parentId" => $parentId,
		    	    "property" => $parentName, 
		    	    "value" => null,
		    	    "type"=> gettype($item)
		    	);
		    	$this->flatArray[ $anItem[ "id" ] ] = $anItem;
		        $parentId = $this->id;
		        $this->id++;
		        foreach($item as $key => $value){
		    	    $this->toArray($value, $key, $parentId);
		        }
		        break;

            // does not have child
	        default:
	           	    $anItem=array(
	    	    	"id"=>$this->id++, 
	    	    	"parentId" => $parentId,
	    	    	"property" => $parentName, 
	    	    	"value" => $item,
	    	    	"type"=> gettype($item)
	    	    );
	    	    $this->flatArray[ $anItem[ "id" ] ]=$anItem;
	    }
	}
}    
