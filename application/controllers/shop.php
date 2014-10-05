<?php
class Shop extends CI_Controller {

	function index()
	{
		$this->load->model('Product_model');
		$data['products'] = $this->Product_model->getall();

		$this->load->view('products',$data);
	}

	function add()
	{
		$this->load->model('Product_model');

		$product = $this->Product_model->get($this->input->post('id'));

		$insert = array(
			'id' => $this->input->post('id'),
			'qty' => 1,
			'price' => $product->price,
			'name' => $product->name
			);

		if($product->option_name)
		{
			$insert['options'] = array(
				$product->option_name => $product->option_values[$this->input->post($product->option_name)]
				);
		}

		$this->cart->insert($insert);
		redirect('shop');
	}

	function update($rowid)
	{
		$data = array(
		 'rowid'=> $rowid,
		 'qty'=>3
		);

	$this->cart->update($data);

    }

	function remove($rowid)
	{
		$data = array(
		     'rowid'=> $rowid,
		     'qty'=>0
		 );

	$this->cart->update($data);
	redirect('shop');

	}   

   function destroy()
   {
       $this->cart->destroy();
   }
}