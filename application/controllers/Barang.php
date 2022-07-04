<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_barang');
        $this->load->model('m_kategori');
    }

    // List all your items
    public function index()
    {
        $data = array(
            'title' => 'Barang',
            'barang' => $this->m_barang->get_all_data(),
            'isi'   => 'barang/barang'
        );
        $this->load->view('layout/wrapper_backend', $data);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array(
            'required' => '%s Harus Diisi !'
        ));
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array(
            'required' => '%s Harus Diisi !'
        ));
        $this->form_validation->set_rules('harga', 'Harga', 'required', array(
            'required' => '%s Harus Diisi !'
        ));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array(
            'required' => '%s Harus Diisi !'
        ));


        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'gif|jpg|png|ico';
            $config['max_size']     = '2000';

            $this->upload->initialize($config);

            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Add Barang',
                    'kategori' => $this->m_kategori->get_all_data(),
                    'error_upload' => $this->upload->display_errors(),
                    'isi'   => 'barang/add_barang'
                );
                $this->load->view('layout/wrapper_backend', $data);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];

                $this->load->library('image_lib', $config);

                $data = array(
                    'nama_barang'   => $this->input->post('nama_barang'),
                    'id_kategori'   => $this->input->post('id_kategori'),
                    'harga'         => $this->input->post('harga'),
                    'deskripsi'     => $this->input->post('deskripsi'),
                    'gambar'        => $upload_data['uploads']['file_name']
                );

                $this->m_barang->add($data);
                $this->session->set_flashdata('pesan', 'Data Barang Berhasil Ditambahkan');
                redirect('barang');
            }
        }

        $data = array(
            'title' => 'Add Barang',
            'kategori' => $this->m_kategori->get_all_data(),
            'isi'   => 'barang/add_barang'
        );
        $this->load->view('layout/wrapper_backend', $data);
    }

    //Update one item
    public function edit($id_barang)
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array(
            'required' => '%s Harus Diisi !'
        ));
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array(
            'required' => '%s Harus Diisi !'
        ));
        $this->form_validation->set_rules('harga', 'Harga', 'required', array(
            'required' => '%s Harus Diisi !'
        ));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array(
            'required' => '%s Harus Diisi !'
        ));


        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'gif|jpg|png|ico';
            $config['max_size']     = '2000';

            $this->upload->initialize($config);

            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Edit Barang',
                    'kategori' => $this->m_kategori->get_all_data(),
                    'barang'    => $this->m_barang->get_data($id_barang),
                    'error_upload' => $this->upload->display_errors(),
                    'isi'   => 'barang/edit_barang'
                );
                $this->load->view('layout/wrapper_backend', $data);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];

                $this->load->library('image_lib', $config);

                $data = array(
                    'id_barang'     => $id_barang,
                    'nama_barang'   => $this->input->post('nama_barang'),
                    'id_kategori'   => $this->input->post('id_kategori'),
                    'harga'         => $this->input->post('harga'),
                    'deskripsi'     => $this->input->post('deskripsi'),
                    'gambar'        => $upload_data['uploads']['file_name']
                );

                $this->m_barang->edit($data);
                $this->session->set_flashdata('pesan', 'Data Barang Berhasil Diubah');
                redirect('barang');
            }

            // jika tidak ganti gambar
            $data = array(
                'id_barang'     => $id_barang,
                'nama_barang'   => $this->input->post('nama_barang'),
                'id_kategori'   => $this->input->post('id_kategori'),
                'harga'         => $this->input->post('harga'),
                'deskripsi'     => $this->input->post('deskripsi')
            );

            $this->m_barang->edit($data);
            $this->session->set_flashdata('pesan', 'Data Barang Berhasil Diubah');
            redirect('barang');
        }

        $data = array(
            'title' => 'Edit Barang',
            'kategori' => $this->m_kategori->get_all_data(),
            'barang'    => $this->m_barang->get_data($id_barang),
            'isi'   => 'barang/edit_barang'
        );
        $this->load->view('layout/wrapper_backend', $data);
    }

    //Delete one item
    public function delete($id_barang)
    {
        //hapus gambar
        $barang = $this->m_barang->get_data($id_barang);
        if ($barang->gambar != "") {
            unlink('./assets/gambar/' . $barang->gambar);
        }

        $data = array('id_barang' => $id_barang);

        $this->m_barang->delete($data);
        $this->session->set_flashdata('pesan', 'Data Barang Berhasil Dihapus');
        redirect('barang');
    }
}

/* End of file Barang.php */
