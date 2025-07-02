<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Dompdf\Dompdf;

class DashboardController extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();

        // contadores
        $totalRooms = $db->table('rooms')->countAllResults();
        $totalUsers = $db->table('users')->countAllResults();
        $totalReservations = $db->table('reservations')->countAllResults();

        $userId = session()->get('user_id');
        $userReservations = $db->table('reservations')->where('user_id', $userId)->countAllResults();

        // listagem das próximas 5 reservas 
        $upcomingReservations = $db->table('reservations')
            ->select('reservations.*, rooms.name AS room_name')
            ->join('rooms', 'rooms.id = reservations.room_id')
            ->where('reservations.date >=', date('Y-m-d'))
            ->orderBy('reservations.date', 'ASC')
            ->orderBy('reservations.start_time', 'ASC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $data = [
            'totalRooms' => $totalRooms,
            'totalUsers' => $totalUsers,
            'totalReservations' => $totalReservations,
            'userReservations' => $userReservations,
            'upcomingReservations' => $upcomingReservations,
        ];

        return view('dashboard/index', $data);
    }

    public function settings()
    {
        return view('settings/index');
    }

    public function reports()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('reservations');
        $builder->select('rooms.name AS room_name, COUNT(*) AS total_reservas');
        $builder->join('rooms', 'rooms.id = reservations.room_id');

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if (!empty($startDate)) {
            $builder->where('reservations.date >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('reservations.date <=', $endDate);
        }

        $builder->groupBy('rooms.name');
        $builder->orderBy('total_reservas', 'DESC');

        $query = $builder->get();
        $data['report'] = $query->getResultArray();
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        return view('reports/index', $data);
    }

    public function exportReportCsv()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('reservations');
        $builder->select('rooms.name AS room_name, COUNT(*) AS total_reservas');
        $builder->join('rooms', 'rooms.id = reservations.room_id');

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if (!empty($startDate)) {
            $builder->where('reservations.date >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('reservations.date <=', $endDate);
        }

        $builder->groupBy('rooms.name');
        $builder->orderBy('total_reservas', 'DESC');

        $query = $builder->get();
        $reportData = $query->getResultArray();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="relatorio_reservas.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Sala', 'Total de Reservas']);

        foreach ($reportData as $item) {
            fputcsv($output, [
                $item['room_name'],
                $item['total_reservas']
            ]);
        }

        fclose($output);
        exit;
    }

    public function exportReportPdf()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('reservations');
        $builder->select('rooms.name AS room_name, COUNT(*) AS total_reservas');
        $builder->join('rooms', 'rooms.id = reservations.room_id');

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if (!empty($startDate)) {
            $builder->where('reservations.date >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('reservations.date <=', $endDate);
        }

        $builder->groupBy('rooms.name');
        $builder->orderBy('total_reservas', 'DESC');

        $query = $builder->get();
        $reportData = $query->getResultArray();

        $html = '<h2>Relatório de Reservas por Sala</h2>';
        if (!empty($startDate) && !empty($endDate)) {
            $html .= '<p>Período: ' . $startDate . ' até ' . $endDate . '</p>';
        }

        $html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sala</th>
                            <th>Total de Reservas</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($reportData as $item) {
            $html .= '<tr>
                        <td>' . esc($item['room_name']) . '</td>
                        <td>' . esc($item['total_reservas']) . '</td>
                      </tr>';
        }

        $html .= '</tbody></table>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream('relatorio_reservas.pdf', ['Attachment' => true]);
        exit;
    }
}
