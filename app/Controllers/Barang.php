<?php
namespace App\Controllers;
//use CodeIgniter\Controller;
use App\Models\BarangModel;

class Barang extends BaseController
{
    public function index()
    {
        $model = new BarangModel;
        $data['title']     = 'Data Barang';
        $data['getBarang'] = $model->getBarang();
        echo view('template/header_view', $data);
        echo view('barang/barang_view', $data);
        echo view('template/footer_view', $data);
    }
    public function tambah()
    {
        $data['title']     = 'Tambah Data Barang';
        echo view('template/header_view', $data);
        echo view('barang/tambah_view', $data);
        echo view('template/footer_view', $data);
    }
    public function add()
    {
        $model = new BarangModel;
        $data = array(
            'nama_barang' => $this->request->getPost('nama'),
            'qty'         => $this->request->getPost('qty'),
            'harga_beli'  => $this->request->getPost('beli'),
            'harga_jual'  => $this->request->getPost('jual')
        );
        $model->saveBarang($data);
        echo '<script>
                alert("Sukses Tambah Data Barang");
                window.location="'.base_url('barang').'"
            </script>';
    }
    public function edit($id)
    {
        $model = new BarangModel;
        $getBarang = $model->getBarang($id)->getRow();
        if(isset($getBarang))
        {
            $data['barang'] = $getBarang;
            $data['title']  = 'Edit '.$getBarang->nama_barang;

            echo view('template/header_view', $data);
            echo view('barang/edit_view', $data);
            echo view('template/footer_view', $data);

        }else{

            echo '<script>
                    alert("ID barang '.$id.' Tidak ditemukan");
                    window.location="'.base_url('barang').'"
                </script>';
        }
    }
    public function update()
    {
        $model = new BarangModel;
        $id = $this->request->getPost('id_barang');
        $data = array(
            'nama_barang' => $this->request->getPost('nama'),
            'qty'         => $this->request->getPost('qty'),
            'harga_beli'  => $this->request->getPost('beli'),
            'harga_jual'  => $this->request->getPost('jual')
        );
        $model->editBarang($data,$id);
        echo '<script>
                alert("Sukses Edit Data Barang");
                window.location="'.base_url('barang').'"
            </script>';

    }
    public function hapus($id)
    {
        $model = new BarangModel;
        $getBarang = $model->getBarang($id)->getRow();
        if(isset($getBarang))
        {
            $model->hapusBarang($id);
            echo '<script>
                    alert("Hapus Data Barang Sukses");
                    window.location="'.base_url('barang').'"
                </script>';

        }else{

            echo '<script>
                    alert("Hapus Gagal !, ID barang '.$id.' Tidak ditemukan");
                    window.location="'.base_url('barang').'"
                </script>';
        }
    }
}