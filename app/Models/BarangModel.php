<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class BarangModel extends Model
{
    protected $table = 'barang';
     
    public function getBarang($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id_barang' => $id]);
        }   
    }
 
}