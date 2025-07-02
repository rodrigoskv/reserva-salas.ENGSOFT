<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\RoomModel;
use CodeIgniter\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('reservations');
        $builder->select('
            reservations.*,
            users.name AS user_name,
            rooms.id AS room_id,
            rooms.name AS room_name,
            rooms.capacity AS room_capacity
        ');
        $builder->join('users', 'users.id = reservations.user_id');
        $builder->join('rooms', 'rooms.id = reservations.room_id');

        // Filtros
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $roomId = $this->request->getGet('room_id');

        if (!empty($startDate)) {
            $builder->where('reservations.date >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('reservations.date <=', $endDate);
        }

        if (!empty($roomId)) {
            $builder->where('reservations.room_id', $roomId);
        }

        // Ordenação
        $orderBy = $this->request->getGet('order_by') ?? 'reservations.id';
        $orderDir = $this->request->getGet('order_dir') ?? 'ASC';

        $allowedOrderFields = ['reservations.id', 'rooms.name', 'reservations.date', 'users.name'];
        $allowedDirections = ['ASC', 'DESC'];

        if (in_array($orderBy, $allowedOrderFields) && in_array($orderDir, $allowedDirections)) {
            $builder->orderBy($orderBy, $orderDir);
        }

        $query = $builder->get();
        $data['reservations'] = $query->getResultArray();

        $roomModel = new RoomModel();
        $data['rooms'] = $roomModel->findAll();

        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['selectedRoom'] = $roomId;
        $data['orderBy'] = $orderBy;
        $data['orderDir'] = $orderDir;

        return view('reservations/index', $data);
    }

    public function create()
    {
        $roomModel = new RoomModel();
        $data['rooms'] = $roomModel->findAll();
        return view('reservations/form', $data);
    }

    public function store()
    {
        $model = new ReservationModel();
        $userId = session()->get('user_id');

        $date = $this->request->getPost('date');
        $start = $this->request->getPost('start_time');
        $end = $this->request->getPost('end_time');
        $roomId = $this->request->getPost('room_id');

        if (strtotime($date) < strtotime(date('Y-m-d'))) {
            return redirect()->back()->with('error', 'Cannot reserve for past dates.');
        }

        if (strtotime($end) <= strtotime($start)) {
            return redirect()->back()->with('error', 'End time must be after start time.');
        }

        $conflict = $model->where('room_id', $roomId)
                          ->where('date', $date)
                          ->groupStart()
                            ->where('start_time <', $end)
                            ->where('end_time >', $start)
                          ->groupEnd()
                          ->findAll();

        if (count($conflict) > 0) {
            return redirect()->back()->with('error', 'Room is already reserved at this time.');
        }

        $model->save([
            'user_id' => $userId,
            'room_id' => $roomId,
            'date' => $date,
            'start_time' => $start,
            'end_time' => $end,
        ]);

        return redirect()->to('/reservations');
    }

    // Histórico de Reservas do Usuário
    public function myReservations()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('reservations');
        $builder->select('
            reservations.*,
            rooms.name AS room_name,
            rooms.capacity AS room_capacity
        ');
        $builder->join('rooms', 'rooms.id = reservations.room_id');
        $builder->where('reservations.user_id', $userId);
        $builder->orderBy('reservations.date', 'DESC');

        $query = $builder->get();
        $data['reservations'] = $query->getResultArray();

        return view('reservations/my_reservations', $data);
    }

    // Novo método: Exportar CSV de todas as reservas
    public function exportCsv()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('reservations');
        $builder->select('
            reservations.id,
            users.name AS user_name,
            rooms.name AS room_name,
            reservations.date,
            reservations.start_time,
            reservations.end_time
        ');
        $builder->join('users', 'users.id = reservations.user_id');
        $builder->join('rooms', 'rooms.id = reservations.room_id');
        $builder->orderBy('reservations.date', 'DESC');

        $query = $builder->get();
        $reservations = $query->getResultArray();

        // Cabeçalhos HTTP para download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="reservas.csv"');

        $output = fopen('php://output', 'w');

        // Cabeçalhos das colunas
        fputcsv($output, ['ID', 'Usuário', 'Sala', 'Data', 'Hora Início', 'Hora Fim']);

        // Dados das reservas
        foreach ($reservations as $res) {
            fputcsv($output, [
                $res['id'],
                $res['user_name'],
                $res['room_name'],
                $res['date'],
                $res['start_time'],
                $res['end_time']
            ]);
        }

        fclose($output);
        exit;
    }
}
