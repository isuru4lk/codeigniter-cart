<?php
class Product_model extends CI_Model {

	function getall()
	{
		$results = $this->db->get('products')->result();

		foreach ($results as &$result) {
			if ($result->option_values) {
				$result->option_values = explode(',', $result->option_values);
			}
		}

	return $results;
	}

	function get($id)
	{
        $results = $this->db->get_where('products',array('id'=>$id))->result();
        $results = $results[0]; 
        
        if($results->option_value){
                $results->option_value = explode(',',$results->option_value);
        }

	return $results;
    }
}