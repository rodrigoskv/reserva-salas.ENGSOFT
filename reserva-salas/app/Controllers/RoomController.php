<?php

namespace App\Controllers;

use App\Models\RoomModel;
use App\Models\ReservationModel;
use CodeIgniter\Controller;

class RoomController extends Controller
{
    private function isAdmin()
    {
        return session()->get('role') === 'admin';
    }

    public function index()
    {
        $model = new RoomModel();
        $data['rooms'] = $model->findAll();
        return view('rooms/index', $data);
    }

    public function create()
    {
        if (! $this->isAdmin()) return redirect()->to('/rooms')->with('error', 'Acesso negado.');
        return view('rooms/form');
    }

    public function store()
    {
        if (! $this->isAdmin()) return redirect()->to('/rooms')->with('error', 'Acesso negado.');
        $model = new RoomModel();
        $model->save([
            'name' => $this->request->getPost('name'),
            'capacity' => $this->request->getPost('capacity'),
        ]);
        return redirect()->to('/rooms');
    }

    public function edit($id)
    {
        if (! $this->isAdmin()) return redirect()->to('/rooms')->with('error', 'Acesso negado.');
        $model = new RoomModel();
        $data['room'] = $model->find($id);
        return view('rooms/form', $data);
    }

    public function update($id)
    {
        if (! $this->isAdmin()) return redirect()->to('/rooms')->with('error', 'Acesso negado.');
        $model = new RoomModel();
        $model->update($id, [
            'name' => $this->request->getPost('name'),
            'capacity' => $this->request->getPost('capacity'),
        ]);
        return redirect()->to('/rooms');
    }

    public function delete($id)
    {
        if (! $this->isAdmin()) return redirect()->to('/rooms')->with('error', 'Acesso negado.');

        $reservationModel = new ReservationModel();
        $futureReservations = $reservationModel
            ->where('room_id', $id)
            ->where('date >=', date('Y-m-d'))
            ->findAll();

        if (count($futureReservations) > 0) {
            return redirect()->back()->with('error', 'Cannot delete room with future reservations.');
        }

        $model = new RoomModel();
        $model->delete($id);
        return redirect()->to('/rooms');
    }
}
