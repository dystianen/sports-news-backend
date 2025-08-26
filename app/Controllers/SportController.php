<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SportModel;

class SportController extends BaseController
{
    protected $sportModel;

    public function __construct()
    {
        $this->sportModel = new SportModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;

        $sports = $this->sportModel
            ->findAll($totalLimit, $offset);

        $totalRows = $this->sportModel
            ->countAllResults();

        $totalPages = ceil($totalRows / $totalLimit);

        $data = [
            "sports" => $sports,
            "pager" => [
                "totalPages" => $totalPages,
                "currentPage" => $currentPage,
                "limit" => $totalLimit,
            ],
        ];

        return view('sports/v_index', $data);
    }

    public function form()
    {

        $id = $this->request->getVar('id');
        $data = [];

        if ($id) {
            $sport = $this->sportModel->find($id);
            if (!$sport) {
                return redirect()->to('/sports')->with('failed', 'Sport not found.');
            }
            $data['sport'] = $sport;
        }

        return view('sports/v_form', $data);
    }

    public function save()
    {
        $id = $this->request->getVar('id');

        $rules = [
            'name'  => 'required',
            'slug' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('failed', 'Please check your input.');
        }

        $data = [
            'name'  => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
        ];

        if ($id) {
            $this->sportModel->update($id, $data);
            $message = 'Sport updated successfully!';
        } else {
            $this->sportModel->insert($data);
            $message = 'Sport created successfully!';
        }

        return redirect()->to('/sports')->with('success', $message);
    }


    public function delete($id)
    {
        $this->sportModel->delete($id);
        return redirect()->to('/sports')->with('success', 'Sport deleted successfully.');
    }
}
