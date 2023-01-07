<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class model_products extends CI_Model
{

    public function get_all()
    {
			return $this->db->get('products')->result_array();
    }

	public function get_where_id_product($id_product)
	{
		$data = [
			'id_product' => $id_product,
		];
		return $this->db->get_where('products', $data)->row_array();
	}

	public function get_all_join_category()
	{
		$query = "SELECT `products`.*, `categories`.`category`
                    FROM `products`
					JOIN `categories`
                    ON `products`.`id_category` = `categories`.`id_category`
                    ";
        return $this->db->query($query)->result_array();
	}

	public function add($product, $schedule, $price)
	{
		$data = [
			'id_category' => 4,
			'product' => $product,
			'note' => $schedule,
			'price' => $price,
			'is_active' => 1,
		];
		return $this->db->insert('products', $data);
	}

}
