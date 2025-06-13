<?php

namespace App\Controllers;
use App\Models\SalaryModel;
use App\Models\UserModel;

class Salary extends BaseController
{
    public function view()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
    
        $employeeID = session()->get('employee_id'); 
    
        $SalaryModel = new SalaryModel();
        $salary = $SalaryModel->where('Employee_ID', $employeeID)->findAll();
    
        return view('Salary', ['salary' => $salary]);
    }

    public function admin()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $SalaryModel = new SalaryModel();
        $salary =$SalaryModel
        ->select('salary.*, employee.Username, employee.Position')
        ->join('employee', 'employee.Employee_ID = salary.Employee_ID')
        ->findAll();

        
        if (session('position') === 'Admin' || session('position') === 'Manager') {
            return view('SalaryAdmin', ['salary' => $salary]);
        }else{
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }
    }

    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session('position') !== 'Admin' && session('position') !== 'Manager') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }

        $UserModel = new UserModel();

        if (session('position') === 'Manager') {
            $employee = $UserModel->where('Position', 'Employee')->findAll();
        } else {
            $employee = $UserModel->findAll();
        }

        return view('AddSalary', ['employee' => $employee]);
    }

    public function addprocess()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session('position') !== 'Admin' && session('position') !== 'Manager') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }

        $SalaryModel = new SalaryModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Salary_Date' => 'required',
            'Salary_Amount' => 'required',
            'Employee_ID' => 'required',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $insertData = [
                    'Salary_Type' => 'Salary',
                    'Salary_Date' => $this->request->getPost('Salary_Date'),
                    'Salary_Amount' => $this->request->getPost('Salary_Amount'),
                    'Employee_ID' => $this->request->getPost('Employee_ID'),
                ];

                $SalaryModel->insert($insertData);

                return redirect()->to('/salary')->with('success', 'Add department successfully!');
            } else {
                return redirect()->to('/salary/add')->with('error', $validation->getErrors());
            }
        }
    }

    public function edit($Salary_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $SalaryModel = new SalaryModel();

        $salary = $SalaryModel
        ->select('salary.*, employee.Position, employee.Username')
        ->join('employee', 'employee.Employee_ID = salary.Employee_ID')
        ->where('salary.Salary_ID', $Salary_ID)
        ->first();

        if (!$salary) {
            return redirect()->to('/salary')->with('error', 'Salary record not found');
        }

        $targetPosition = $salary['Position'];
        $currentPosition = session()->get('position');

        if (($currentPosition === 'Admin') || ($currentPosition === 'Manager' && $targetPosition === 'Employee')) {
            return view('EditSalary', ['salary' => $salary]);
        }else{
            return redirect()->to('/salary')->with('error', 'Access denied');
        }
    }

    public function editprocess($Salary_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session('position') !== 'Admin' && session('position') !== 'Manager') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }

        $SalaryModel = new SalaryModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Salary_Date' => 'required',
            'Salary_Amount' => 'required',
            'Employee_ID' => 'required',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $salary = $SalaryModel->find($this->request->getPost('Salary_ID'));

                if (!$salary) {
                    return redirect()->to('/salary/edit')->with('error', 'Salary ID not valid');
                }

                $updateddata = [
                    'Salary_Date' => $this->request->getPost('Salary_Date'),
                    'Salary_Amount' => $this->request->getPost('Salary_Amount'),
                    'Employee_ID' => $this->request->getPost('Employee_ID'),
                ];

                $SalaryModel->update($Salary_ID, $updateddata);

                return redirect()->to('/salary')->with('success', 'Edit employee successfully!');
            } else {
                return redirect()->to('/salary/edit')->with('error', $validation->getErrors());
            }
        }
    }

    public function delete($Salary_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $SalaryModel = new SalaryModel();

        $salary = $SalaryModel
        ->select('salary.*, employee.Position')
        ->join('employee', 'employee.Employee_ID = salary.Employee_ID')
        ->where('salary.Salary_ID', $Salary_ID)
        ->first();

        if (!$salary) {
            return redirect()->to('/salary')->with('error', 'Salary record not found');
        }

        $targetPosition = $salary['Position'];
        $currentPosition = session()->get('position');

        if (($currentPosition === 'Admin') || ($currentPosition === 'Manager' && $targetPosition === 'Employee')) {
            $SalaryModel->delete($Salary_ID);
            return redirect()->to('/salary')->with('success', 'Delete salary successfully!');
        } else {
            return redirect()->to('/salary')->with('error', 'Access denied: insufficient privileges');
        }
    }
}