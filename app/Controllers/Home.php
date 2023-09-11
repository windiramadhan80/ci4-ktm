<?php

namespace App\Controllers;

use App\Models\AjaxsearchModel;
use App\Models\PendaftaranModel;

class Home extends BaseController
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
            'title' => 'Kartu Tanda Mahasiswa',
            'ktm' => $ktm->getResult(),
        ];
        return view('welcome', $data);
    }

    public function detail($id)
    {
        $ktm = $this->pendaftaranModel->find($id);

        $data = [
            'title' => 'Kartu Tanda Mahasiswa',
            'ktm' => $ktm,
        ];
        return view('detail', $data);
    }

    public function fetch()
    {
        $output = '';
		$query = '';

        if($this->request->getVar('query'))
		{
			$query = $this->request->getVar('query');
		}

        $data = $this->ajaxsearchModel->fetch_data($query);

        if ($data->getNumRows() > 0) {
            $i = 1;
            foreach($data->getResult() as $k) {
            
                $output .= '
                
                <tr>
                    <th scope="row">' . $i++ . '</th>
                    <td>' . $k->name . '</td>
                    <td>' . $k->program_studi . '</td>
                    <td>
                        <a href="/home/detail/' . $k->id . '" class="badge bg-primary"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
                
                ';

            }

        } else {

            $output .= '<tr>
							<td colspan="4">No Data Found</td>
						</tr>';

        }
        echo $output;
        
        
    }
}
