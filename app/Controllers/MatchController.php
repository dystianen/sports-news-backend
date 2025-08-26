<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MatchModel;
use App\Models\SportModel;
use App\Models\TeamModel;

class MatchController extends BaseController
{
    protected $matchModel, $sportModel, $teamModel;

    public function __construct()
    {
        $this->matchModel = new MatchModel();
        $this->sportModel = new SportModel();
        $this->teamModel = new TeamModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;

        $matches = $this->matchModel
            ->select('matches.*, 
                     sports.name as sport_name,
                     t1.name as team_home_name,
                     t2.name as team_away_name')
            ->join('sports', 'sports.sport_id = matches.sport_id', 'left')
            ->join('teams t1', 't1.team_id = matches.team_home_id', 'left')
            ->join('teams t2', 't2.team_id = matches.team_away_id', 'left')
            ->findAll($totalLimit, $offset);

        $totalRows = $this->matchModel
            ->countAllResults();

        $totalPages = ceil($totalRows / $totalLimit);

        $data = [
            "matches" => $matches,
            "pager" => [
                "totalPages" => $totalPages,
                "currentPage" => $currentPage,
                "limit" => $totalLimit,
            ],
        ];

        return view('matches/v_index', $data);
    }

    public function form()
    {

        $id = $this->request->getVar('id');
        $data = [];

        $data['categories'] = $this->sportModel
            ->findAll();

        $data['teams'] = $this->teamModel
            ->findAll();

        if ($id) {
            $match = $this->matchModel->find($id);
            if (!$match) {
                return redirect()->to('/matches')->with('failed', 'Match not found.');
            }
            $data['match'] = $match;
        }

        return view('matches/v_form', $data);
    }

    public function save()
    {
        $id = $this->request->getVar('id');

        $rules = [
            'sport_id'  => 'required',
            'match_date' => 'required',
            'team_home_id'  => 'required',
            'team_away_id'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('failed', 'Please check your input.');
        }

        $data = [
            'sport_id'  => $this->request->getPost('sport_id'),
            'match_date' => $this->request->getPost('match_date'),
            'team_home_id' => $this->request->getPost('team_home_id'),
            'team_away_id' => $this->request->getPost('team_away_id'),
            'score_home' => $this->request->getPost('score_home'),
            'score_away' => $this->request->getPost('score_away'),
        ];

        // dd($data);

        if ($id) {
            $this->matchModel->update($id, $data);
            $message = 'Match updated successfully!';
        } else {
            $this->matchModel->insert($data);
            $message = 'Match created successfully!';
        }

        return redirect()->to('/matches')->with('success', $message);
    }


    public function delete($id)
    {
        $this->matchModel->delete($id);
        return redirect()->to('/matches')->with('success', 'Match deleted successfully.');
    }
}
