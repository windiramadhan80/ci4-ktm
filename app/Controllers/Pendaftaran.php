<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;

class Pendaftaran extends BaseController
{
    protected $pendaftaranModel;

    public function __construct()
    {
        $this->pendaftaranModel = model(PendaftaranModel::class);
    }

    public function index(): string
    {
        $data = [
            'title' => 'Kartu Tanda mahasiswa'
        ];
        return view('pendaftaran/index', $data);
    }

    public function save()
    {
        $rules = [
            'name' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Nama Lengkap tidak boleh kosong!',
                    'max_length[255]' => 'Nama Lengkap terlalu panjang!'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin tidak boleh kosong!'
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat Lahir tidak boleh kosong!'
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir tidak boleh kosong!'
                ]
            ],
            'bulan_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bulan Lahir tidak boleh kosong!'
                ]
            ],
            'tahun_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Lahir tidak boleh kosong!'
                ]
            ],
            'program_studi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Program Studi tidak boleh kosong!'
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->to('pendaftaran')->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir'  => $this->request->getVar('tanggal_lahir'),
            'bulan_lahir'  => $this->request->getVar('bulan_lahir'),
            'tahun_lahir'  => $this->request->getVar('tahun_lahir'),
            'program_studi'  => $this->request->getVar('program_studi'),
        ];

        $this->pendaftaranModel->insert($data);

        return redirect()->to('/')->with('message', 'Kartu Tanda Mahasiswa berhasil dibuat!');
    }
}
