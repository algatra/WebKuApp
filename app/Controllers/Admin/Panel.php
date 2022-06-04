<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Panel extends BaseController
{
    protected $AdminModel;

    public function __construct()
    {
        $this->AdminModel = new AdminModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            // 'users' => $this->AdminModel->findAll()
        ];
        return view('admin/dashboard', $data);
    }

    public function getData($table=false, $ids=false)
    {
        if ($this->request->isAjax()) {
            $table = $this->request->getVar('table');
            if($ids){
                $data['users'] = $this->AdminModel->find($ids);
            }else{
                $data['users'] = $this->AdminModel->findAll();
            }
            $res = ['data' => $data];
            if ($table) {
                $res['table'] = view('admin/tablelist', $data);
            }
            echo json_encode($res);
        } else {
            exit("<h1>Data Tidak Bisa Diload</h1>");
        }
    }

    public function deleteData()
    {
        $id = $this->request->getVar('ids');
        // dd($id);
        if ($this->request->isAjax()) {

            $this->AdminModel->delete(['id' => $id]);
            // if () {
            echo json_encode(["result" => "Data Berhasil Dihapus"]);
            // }
        } else {
            echo json_encode(["error" => "no Ajax"]);
        }
    }

    public function editData()
    {
        if($this->request->isAJAX()){
            // dd($this->request->getVar());
            $ids = $this->request->getVar('idDataku');
            $fileAva = $this->request->getFile('avatarEdit');
            $namaAva = $fileAva->getRandomName();
            $fileAva->move('assets/avatar', $namaAva);
            $this->AdminModel->save([
                'id' => $ids,
                'username' => $this->request->getVar('usernameEdit'),
                'password' => $this->request->getVar('passwordEdit'),
                'nama' => $this->request->getVar('namaDepanEdit'),
                'tempat_lahir' => $this->request->getVar('tempatLahirEdit'),
                'tanggal_lahir' => $this->request->getVar('tglLahirEdit'),
                'gender' => $this->request->getVar('genderEdit'),
                'telepon' => $this->request->getVar('noTelpEdit'),
                'email' => $this->request->getVar('emailEdit'),
                'avatar' => $namaAva
            ]);
            echo json_encode(['pesan' => "Data Berhasil Diubah"]);
        }else{
            echo "No Access";
        }
    }

    public function insertAjax()
    {

        // Validasi
        $validasi = \Config\Services::validation();
        $valid = $this->validate([
            'namaDepan' => [
                'label' => 'Nama Depan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'tempatLahir' => [
                'label' => 'Tempat Lahir',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'tglLahir' => [
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'gender' => [
                'label' => 'Jenis Kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'noTelp' => [
                'label' => 'Nomor Telepon',
                'rules' => 'required|is_unique[user.telepon]|numeric',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Terdaftar',
                    'numeric' => '{field} Hanya Boleh Angka!'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[user.email]|valid_email',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Terdaftar',
                    'valid_email' => 'Format {field} Tidak Valid'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Terdaftar'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|exact_length[8]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'exact_length' => '{field} Wajib 8 Karakter'
                ]
            ],
            'password2' => [
                'label' => 'Re-type Password',
                'rules' => 'required|matches[password]|exact_length[8]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'matches' => '{field} Password Tidak Sama',
                    'exact_length' => '{field} Wajib 8 Karakter'
                ]
            ],
            'avatar' => [
                'label' => 'Avatar',
                'rules' => 'uploaded[avatar]|max_size[avatar,500]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'required' => '{field} Tidak Boleh Kosong',
                    'uploaded' => 'Gambar Belum Dipilih',
                    'max_size' => 'Ukuran Gambar Melebihi 500kb',
                    'is_image' => 'File Yang Anda Pilih Bukan Gambar!',
                    'mime_in' => 'File Yang Anda Pilih Bukan jpg/jpeg/png!'
                ]
            ],
        ]);

        $pesan = [];
        if (!$valid) {
            $pesan = [
                'error' => [
                    'namaDepan' => $validasi->getError('namaDepan'),
                    'tempatLahir' => $validasi->getError('tempatLahir'),
                    'tglLahir' => $validasi->getError('tglLahir'),
                    'gender' => $validasi->getError('gender'),
                    'noTelp' => $validasi->getError('noTelp'),
                    'email' => $validasi->getError('email'),
                    'username' => $validasi->getError('username'),
                    'password' => $validasi->getError('password'),
                    'password2' => $validasi->getError('password2'),
                    'avatar' => $validasi->getError('avatar')
                ]
            ];
        } else {
            $fileAva = $this->request->getFile('avatar');
            // dd($fileAva->getError());
            // if ($fileAva->getError() == 4) {
            //     if ($this->request->getVar('gender') == 'laki-laki') {
            //         $namaAva = 'default1.jpg';
            //     } else {
            //         $namaAva = 'default2.jpg';
            //     }
            // } else {
            $namaAva = $fileAva->getRandomName();
            // }
            $fileAva->move('assets/avatar', $namaAva);
            $this->AdminModel->save([
                'username' => $this->request->getVar('username'),
                'password' => $this->request->getVar('password'),
                'nama' => $this->request->getVar('namaDepan'),
                'tempat_lahir' => $this->request->getVar('tempatLahir'),
                'tanggal_lahir' => $this->request->getVar('tglLahir'),
                'gender' => $this->request->getVar('gender'),
                'telepon' => $this->request->getVar('noTelp'),
                'email' => $this->request->getVar('email'),
                'avatar' => $namaAva
            ]);
            $pesan = [
                'sukses' => "Data Berhasil Ditambahkan"
            ];
            session()->setFlashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Ditambahkan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            // return redirect()->to('/');
        }
        echo json_encode($pesan);
        // dd($this->request->getVar());

    }
}
