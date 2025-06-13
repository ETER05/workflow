<?php

namespace App\Controllers;
use App\Models\OvertimeModel;
use App\Models\OvertimeProjectModel;
use App\Models\ProjectModel;
use App\Models\SalaryModel;

class Overtime extends BaseController
{   
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();
        $overtime = $OvertimeModel->findAll();

        return view('Overtime', ['overtime' => $overtime]);
    }

    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('AddOvertime');
    }

    public function addprocess()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Overtime_Date' => 'required|min_length[3]|max_length[10]',
            'Reason' => 'required|min_length[3]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $employee = session()->get('employee_id');

                $insertData = [
                    'Overtime_Date' => $this->request->getPost('Overtime_Date'),
                    'Overtime_Start' => $this->request->getPost('Overtime_Start'),
                    'Overtime_End' => $this->request->getPost('Overtime_End'),
                    'Status' => 'Requesting',
                    'Reason' => $this->request->getPost('Reason'),
                    'Employee_ID' => $employee,
                ];

                $OvertimeModel->insert($insertData);

                return redirect()->to('/overtime')->with('success', 'Add overtime successfully!');
            } else {
                return redirect()->to('/overtime/add')->with('error', $validation->getErrors());
            }
        }
    }

    public function delete($Overtime_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();
        $OvertimeData = $OvertimeModel->find($Overtime_ID);

        if (!$OvertimeData){
            return redirect()->to('/overtime')->with('error', 'User not found');
        }

        $OvertimeModel->delete($OvertimeData['Overtime_ID']);
        return redirect()->to('/overtime')->with('success', 'Pull overtime successfully!');
    }

    public function approval()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();
        $overtime = $OvertimeModel
        ->select('overtime.*, employee.Username, employee.Position')
        ->join('employee', 'employee.Employee_ID = overtime.Employee_ID')
        ->findAll();

        if (session('position') === 'Admin' || session('position') === 'Manager') {
            return view('ApprovalOvertime', ['overtime' => $overtime]);
        }else{
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }

    public function approve($Overtime_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();

        $overtime = $OvertimeModel
        ->select('overtime.*, employee.Position')
        ->join('employee', 'employee.Employee_ID = overtime.Employee_ID')
        ->where('overtime.Overtime_ID', $Overtime_ID)
        ->first();

        if (!$overtime) {
            return redirect()->to('/overtime/approval')->with('error', 'Data not found.');
        }

        $approverPosition = session('position');
        $requesterPosition = $overtime['Position'];

        if (
            ($requesterPosition === 'Admin' && $approverPosition !== 'Admin') ||
            ($requesterPosition === 'Manager' && $approverPosition !== 'Admin') ||
            ($requesterPosition === 'Employee' && $approverPosition === 'Employee')
        ) {
            return redirect()->to('/overtime/approval')->with('error', 'You are not authorized to approve this request.');
        }

        if ($overtime['Status'] === 'Requesting') {
            $OvertimeModel->update($Overtime_ID, ['Status' => 'Approved']);
            return redirect()->to('/overtime/approval')->with('success', 'Overtime approved!');
        } else {
            return redirect()->to('/overtime/approval')->with('error', 'Overtime request is not in Requesting status.');
        }  
    }

    public function reject($Overtime_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();

        $overtime = $OvertimeModel
        ->select('overtime.*, employee.Position')
        ->join('employee', 'employee.Employee_ID = overtime.Employee_ID')
        ->where('overtime.Overtime_ID', $Overtime_ID)
        ->first();

        if (!$overtime) {
            return redirect()->to('/overtime/approval')->with('error', 'Data not found.');
        }

        $rejecterPosition = session('position');
        $requesterPosition = $overtime['Position'];

        if (
            ($requesterPosition === 'Admin' && $rejecterPosition !== 'Admin') ||
            ($requesterPosition === 'Manager' && $rejecterPosition !== 'Admin') ||
            ($requesterPosition === 'Employee' && $rejecterPosition === 'Employee')
        ) {
            return redirect()->to('/overtime/approval')->with('error', 'You are not authorized to approve this request.');
        }

        if ($overtime['Status'] === 'Requesting') {
            $OvertimeModel->update($Overtime_ID, ['Status' => 'Rejected']);
            return redirect()->to('/overtime/approval')->with('success', 'Overtime rejected!');
        } else {
            return redirect()->to('/overtime/approval')->with('error', 'Overtime request is not in Requesting status.');
        }
        
    }

    public function view($Overtime_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();
        $OvertimeProjectModel = new OvertimeProjectModel();
        $ProjectModel = new ProjectModel();

        $overtime = $OvertimeModel
        ->select('overtime.*, employee.Username')
        ->join('employee', 'employee.Employee_ID = overtime.Employee_ID')
        ->where('overtime.Overtime_ID', $Overtime_ID)
        ->first();

        $project = $ProjectModel
        ->findall();

        $documentcount = $OvertimeProjectModel->where('Overtime_ID', $Overtime_ID)->countAllResults();

        if (!$overtime) {
            return redirect()->to('/overtime')->with('error', 'Data not found.');
        }

        // Ambil dokumen dari database
        $documents = $OvertimeProjectModel
        ->where('Overtime_ID', $Overtime_ID)
        ->findAll();

        return view('OvertimeView', ['overtime' => $overtime, 'documents' => $documents, 'project' => $project, 'documentcount' => $documentcount]);
    }

    public function upload($Overtime_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'document' => 'uploaded[document]',
            'Project_ID' => 'required',
        ]);

       if ($this->request->getMethod() === 'POST' && $validation->withRequest($this->request)->run()) {
            $file = $this->request->getFile('document');
            $documentPath = FCPATH . 'uploads/overtime/' . $Overtime_ID;

            if (!is_dir($documentPath)) {
                mkdir($documentPath, 0777, true);
            }
        
            $originalName = $file->getName();
        
            // Cek apakah sudah ada file dengan nama dan ekstensi yang sama
            if (file_exists($documentPath . '/' . $originalName)) {
                return redirect()->to('/overtime/view/' . $Overtime_ID)->with('error', 'File dengan nama tersebut sudah ada.');
            }
        
            if ($file->isValid() && !$file->hasMoved()) {
                $file->move($documentPath, $originalName);
        
                // Simpan ke database
                $OvertimeProjectModel = new OvertimeProjectModel();
                $OvertimeProjectModel->insert([
                    'Employee_ID' => session()->get('employee_id'),
                    'Overtime_ID' => $Overtime_ID,
                    'Document' => $originalName,
                    'Project_ID' => $this->request->getPost('Project_ID'),
                ]);
        
                return redirect()->to('/overtime/view/' . $Overtime_ID)->with('success', 'File uploaded successfully!');
            } else {
                return redirect()->to('/overtime/view/' . $Overtime_ID)->with('error', 'Failed to upload file.');
            }
        }
    }

    public function download($Overtime_ID, $filename)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $filePath = FCPATH . 'uploads/overtime/' . $Overtime_ID . '/' . $filename;

        if (!file_exists($filePath)) {
            return redirect()->to('/overtime/view/' . $Overtime_ID)->with('error', 'File not found.');
        }

        return $this->response->download($filePath, null);
    }

    public function deletefile($Overtime_ID, $Overtime_Project_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeProjectModel = new OvertimeProjectModel();

        // Ambil data file berdasarkan Overtime_Project_ID
        $document = $OvertimeProjectModel->find($Overtime_Project_ID);

        if (!$document) {
            return redirect()->to('/overtime/view/' . $Overtime_ID)->with('error', 'File not found.');
        }

        $filePath = FCPATH . 'uploads/overtime/' . $Overtime_ID . '/' . $document['Document'];

        // Hapus file dari folder
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus dari database
        $OvertimeProjectModel->delete($Overtime_Project_ID);

        return redirect()->to('/overtime/view/' . $Overtime_ID)->with('success', 'File deleted successfully.');
    }

    public function finalize($Overtime_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $OvertimeModel = new OvertimeModel();
        $SalaryModel = new SalaryModel();
        $OvertimeProjectModel = new OvertimeProjectModel();

        $overtime = $OvertimeModel->find($Overtime_ID);

        if (!$overtime) {
            return redirect()->to('/overtime')->with('error', 'Data overtime tidak ditemukan.');
        }

        // Minimal 1 dokumen harus diunggah
        $documentcount = $OvertimeProjectModel->where('Overtime_ID', $Overtime_ID)->countAllResults();
        if ($documentcount < 1) {
            return redirect()->to('/overtime/view/' . $Overtime_ID)->with('error', 'Tidak bisa finalize: minimal satu dokumen harus diunggah.');
        }

        $now = new \DateTime();
        $endTime = new \DateTime($overtime['Overtime_End']);

        if ($now > $endTime) {
            $OvertimeModel->update($Overtime_ID, ['Status' => 'Canceled']);
            return redirect()->to('/overtime/view/' . $Overtime_ID)->with('error', 'Overtime sudah lewat dan dibatalkan.');
        }

        if ($overtime['Status'] !== 'Approved') {
            return redirect()->to('/overtime/view/' . $Overtime_ID)->with('error', 'Overtime hanya bisa difinalisasi jika status-nya Approved.');
        }

        // Hitung durasi lembur secara akurat dalam detik
        $start = new \DateTime($overtime['Overtime_Start']);
        $end = new \DateTime($overtime['Overtime_End']);

        $durationInSeconds = $end->getTimestamp() - $start->getTimestamp();
        $hours = $durationInSeconds / 3600;

        // Nominal bonus per jam
        $ratePerHour = 50000;

        if ($hours < 1) {
            $bonusAmount = 50000; // Minimal bonus jika < 1 jam
        } else {
            $bonusAmount = $ratePerHour * $hours;
        }
        
        // Simpan bonus sebagai entri baru di tabel salary
        $SalaryModel->insert([
            'Salary_Type' => 'Overtime Bonus',
            'Salary_Date' => date('Y-m-d'),
            'Salary_Amount' => $bonusAmount,
            'Employee_ID' => $overtime['Employee_ID'],
        ]);

        // Tandai sebagai finalized
        $OvertimeModel->update($Overtime_ID, ['Status' => 'Finalized']);

        return redirect()->to('/overtime/view/' . $Overtime_ID)
            ->with('success', 'Overtime berhasil difinalisasi. Bonus sebesar Rp ' . number_format($bonusAmount, 0, ',', '.') . ' telah ditambahkan.');
    }
}