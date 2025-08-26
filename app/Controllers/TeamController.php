<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TeamModel;

class TeamController extends BaseController
{
    protected $teamModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;

        $teams = $this->teamModel
            ->findAll($totalLimit, $offset);

        $totalRows = $this->teamModel
            ->countAllResults();

        $totalPages = ceil($totalRows / $totalLimit);

        $data = [
            "teams" => $teams,
            "pager" => [
                "totalPages" => $totalPages,
                "currentPage" => $currentPage,
                "limit" => $totalLimit,
            ],
        ];

        return view('teams/v_index', $data);
    }

    public function form()
    {

        $id = $this->request->getVar('id');
        $data = [];

        if ($id) {
            $team = $this->teamModel->find($id);
            if (!$team) {
                return redirect()->to('/teams')->with('failed', 'Match not found.');
            }
            $data['team'] = $team;
        }

        return view('teams/v_form', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');
        $teamModel = new TeamModel();

        $data = [
            'name' => $this->request->getPost('name'),
        ];

        $file = $this->request->getFile('logo');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/teams', $newName);
            $data['logo'] = $newName;
        }

        if ($id) {
            $teamModel->update($id, $data);
        } else {
            $teamModel->insert($data);
        }

        return redirect()->to('/teams')->with('success', 'Team saved successfully.');
    }

    public function delete($id)
    {
        $this->teamModel->delete($id);
        return redirect()->to('/teams')->with('success', 'Match deleted successfully.');
    }
}
