<?php
namespace App\Repository\Interfaces;

Interface ProductRepositryInterface{
	public function all();

	public function  store($data,$input);

	public function find($id);

	public function update($data,$id);

	public function delete($id);
	
}
?>