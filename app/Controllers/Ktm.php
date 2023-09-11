<?php

namespace App\Controllers;

use App\Models\AjaxsearchModel;
use App\Models\PendaftaranModel;

class Ktm extends BaseController
{
    protected $pendaftaranModel, $ajaxsearchModel;

    public function __construct()
    {
        $this->pendaftaranModel = model(PendaftaranModel::class);
        $this->ajaxsearchModel = model(AjaxsearchModel::class);
    }

    public function index()
    {
        $this->pendaftaranModel->orderBy('id', 'DESC');
        $ktm = $this->pendaftaranModel->get();
        $data = [
            'title' => 'Kartu Tanda mahasiswa',
            'ktm' => $ktm->getResult(),
        ];
        return view('admin/ktm/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Buat KTM'
        ];
        return view('admin/ktm/create', $data);
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
            'nim' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length[255]' => 'NIM terlalu panjang!'
                ]
            ],
            'image' => [
                'rules' => 'uploaded[image]|max_size[image,1024]|mime_in[image,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => 'Gambar harus diisi!',
                    'max_size[image,1024]' => 'Ukuran maksimal 1 MB!',
                    'mime_in[image,image/png,image/jpeg]' => 'Yang anda upload bukan gambar!'
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->to('ktm/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil request file image
        $file = $this->request->getFile('image');
        // Generate nama file random
        $fileName = $file->getRandomName();
        // Pindahkan gambar ke direktori
        $file->move('img', $fileName);

        $data = [
            'name' => $this->request->getVar('name'),
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir'  => $this->request->getVar('tanggal_lahir'),
            'bulan_lahir'  => $this->request->getVar('bulan_lahir'),
            'tahun_lahir'  => $this->request->getVar('tahun_lahir'),
            'program_studi'  => $this->request->getVar('program_studi'),
            'nim'  => $this->request->getVar('nim'),
            'image'  => $fileName,
        ];

        $this->pendaftaranModel->insert($data);

        return redirect()->to('/ktm')->with('message', 'Kartu Tanda Mahasiswa berhasil dibuat!');
    }

    public function detail($id)
    {
        $ktm = $this->pendaftaranModel->find($id);
        $data = [
            'title' => 'Detail',
            'ktm' => $ktm,
        ];
        return view('admin/ktm/detail', $data);
    }

    public function edit($id)
    {
        $ktm = $this->pendaftaranModel->find($id);
        $data = [
            'title' => 'Edit',
            'ktm' => $ktm,
        ];
        return view('admin/ktm/edit', $data);
    }

    public function update($id)
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
            'nim' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length[255]' => 'NIM terlalu panjang!'
                ]
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|mime_in[image,image/png,image/jpeg]',
                'errors' => [
                    'max_size[image,1024]' => 'Ukuran maksimal 1 MB!',
                    'mime_in[image,image/png,image/jpeg]' => 'Yang anda upload bukan gambar!'
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->to('ktm/edit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil file gambar
        $file = $this->request->getFile('image');
        // Ambil ke dalam variable Gambar Lama
        $oldImage = $this->request->getVar('oldImage');

        // Cek jika gambar tidak diubah
        if ($file->getError() == 4) {
            $fileName = $oldImage;
        } else {
            // Jika gambar diubah
            $fileName = $file->getRandomName();
            $file->move('img', $fileName);
            if ($oldImage != 'default.jpg') {
                unlink('img/' . $oldImage);
            }
        }


        $data = [
            'name' => $this->request->getVar('name'),
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir'  => $this->request->getVar('tanggal_lahir'),
            'bulan_lahir'  => $this->request->getVar('bulan_lahir'),
            'tahun_lahir'  => $this->request->getVar('tahun_lahir'),
            'program_studi'  => $this->request->getVar('program_studi'),
            'nim'  => $this->request->getVar('nim'),
            'image'  => $fileName,
        ];

        $this->pendaftaranModel->set($data);
        $this->pendaftaranModel->where('id', $id);
        $this->pendaftaranModel->update();

        return redirect()->to('ktm/detail/' . $id)->with('message', 'Kartu Tanda Mahasiswa berhasil diubah!');
    }

    public function delete($id)
    {
        // Cari gambar berdasarkan id
        $ktm = $this->pendaftaranModel->find($id);

        // Cek jika gambarnya default.jpg
        if ($ktm['image'] != 'default.jpg') {
            // hapus gambar
            unlink('img/' . $ktm['image']);
        }

        $this->pendaftaranModel->where('id', $id);
        $this->pendaftaranModel->delete();

        return redirect()->to('ktm')->with('message', 'Kartu Tanda Mahasiswa Berhasil Dihapus!');
    }

    public function fetch()
    {
        $output = '';
		$query = '';

        if($this->request->getVar('query'))
		{
			$query = $this->request->getVar('query');
		}

        $data = $this->ajaxsearchModel->fetch_data_admin($query);

        if ($data->getNumRows() > 0) {
            $i = 1;
            foreach($data->getResult() as $k) {
            
                $output .= '
                
                <tr>
                    <th scope="row">' . $i++ . '</th>
                    <td>' . $k->name . '</td>
                    <td>' . $k->program_studi . '</td>
                    <td>' . $k->nim . '</td>
                    <td><img style="width: 30px;" src="/img/' . $k->image . '"></td>
                    <td>
                        <a href="/ktm/detail/' . $k->id . '" class="badge bg-primary"><i class="fa-solid fa-eye"></i></a>
                        <a href="/ktm/edit/' . $k->id . '" class="badge bg-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="/ktm/delete/' . $k->id . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="badge bg-danger border-0" onclick="return confirm(\'Apakah yakin ingin dihapus?\')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                
                ';

            }

        } else {

            $output .= '<tr class="text-center">
							<td colspan="6">No Data Found</td>
						</tr>';

        }
        echo $output;
        
        
    }
}
