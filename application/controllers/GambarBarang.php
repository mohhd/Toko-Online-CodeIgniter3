<?php


defined('BASEPATH') or exit('No direct script access allowed');

class GambarBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_gambarbarang');
        $this->load->model('m_barang');
        $this->load->model('m_gambarbarang');
    }

    // List all your items
    public function index($offset = 0)
    {
        $data = array(
            'title' => 'Gambar Barang',
            'gambarbarang'  => $this->m_gambarbarang->get_all_data(),
            'isi'   => 'gambar_barang/gambar'
        );
        $this->load->view('layout/wrapper_backend', $data);
    }

    // Add a new item
    public function add($id_barang)
    {
        $this->form_validation->set_rules('keterangan', 'Keterangan Gambar', 'required', array(
            'required' => '%s Harus Diisi !'
        ));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambarbarang/';
            $config['allowed_types'] = 'gif|jpg|png|ico';
            $config['max_size']     = '2000';

            $this->upload->initialize($config);

            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Gambar Barang',
                    'error_upload' => $this->upload->display_errors(),
                    'barang'  => $this->m_barang->get_data($id_barang),
                    'gambar'  => $this->m_gambarbarang->get_gambar($id_barang),
                    'isi'   => 'gambar_barang/add_gambar'
                );
                $this->load->view('layout/wrapper_backend', $data);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambarbarang/' . $upload_data['uploads']['file_name'];

                $this->load->library('image_lib', $config);

                $data = array(
                    'id_barang'     => $id_barang,
                    'keterangan'     => $this->input->post('keterangan'),
                    'gambar'        => $upload_data['uploads']['file_name']
                );

                $this->m_gambarbarang->add($data);
                $this->session->set_flashdata('pesan', 'Data Gambar Berhasil Ditambahkan');
                redirect('gambarbarang/add/' . $id_barang);
            }
        }

        $data = array(
            'title' => 'Gambar Barang',
            'barang'  => $this->m_barang->get_data($id_barang),
            'gambar'  => $this->m_gambarbarang->get_gambar($id_barang),
            'isi'   => 'gambar_barang/add_gambar'
        );
        $this->load->view('layout/wrapper_backend', $data);
    }

    //Update one item
    public function update($id = NULL)
    {
    }

    //Delete one item
    public function delete($id_barang, $id_gambar)
    {
        //hapus gambar
        $gambar = $this->m_gambarbarang->get_data($id_gambar);
        if ($gambar->gambar != "") {
            unlink('./assets/gambarbarang/' . $gambar->gambar);
        }

        $data = array('id_gambar' => $id_gambar);

        $this->m_gambarbarang->delete($data);
        $this->session->set_flashdata('pesan', 'Data Gambar Berhasil Dihapus');
        redirect('gambarbarang/add/' . $id_barang);
    }
}

/* End of file GambarBarang.php */
