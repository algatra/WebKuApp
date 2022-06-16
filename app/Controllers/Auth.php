<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $adminModel;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        return view('login');
        //
    }

    public function login()
    {
        if (!$this->request->getVar()) {
            return view('login');
        } else {
            // dd($this->request->getVar());
            $data = $this->request->getVar();
            $data = $this->adminModel->where($data)->first();
            // var_dump($data);
            if ($data) {
                session()->setFlashdata("pesan", '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat Datang ' . $data['nama'] . ' </strong> You should check in on some of those fields below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
                echo "Berhasil Login";
                session()->set([
                    'login' => true,
                    'nama' => $data['nama'],
                    'uname' => $data['username'],
                    'email' => $data['email']
                ]);
                return redirect()->to(base_url());
            } else {
                session()->setFlashdata("pesan", '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Login Gagal!</strong> Email / Password Salah.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
                echo "Login Gagal";
                return redirect()->to(base_url('/login'));
            }
        }
    }
}
