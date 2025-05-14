<?php

namespace App\Controllers;
use App\Models\ClientModel;


class Client extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ClientModel = new ClientModel();
        $client = $ClientModel->findAll();

        return view('Client', ['client' => $client]);
    }

    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session('position') !== 'Admin') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }else{
            return view('AddClient');
        }
    }

    public function addprocess()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ClientModel = new ClientModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Client_ID' => 'required|min_length[3]|max_length[10]',
            'Client_Name' => 'required|min_length[3]|max_length[20]',
            'Client_Contact' => 'required|min_length[12]|max_length[20]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $insertData = [
                    'Client_ID' => $this->request->getPost('Client_ID'),
                    'Client_Name' => $this->request->getPost('Client_Name'),
                    'Client_Contact' => $this->request->getPost('Client_Contact'),
                    'Client_Details' => $this->request->getPost('Client_Details'),
                ];

                $ClientModel->insert($insertData);

                return redirect()->to('/client')->with('success', 'Add client successfully!');
            } else {
                return redirect()->to('/client/add')->with('error', $validation->getErrors());
            }
        }
    }

    public function edit($Client_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ClientModel = new ClientModel();
        $ClientData = $ClientModel->find($Client_ID);

        if (!$ClientData){
            return redirect()->to('/admin')->with('error', 'Client not found');
        }

        if (session('position') !== 'Admin') {
            return redirect()->to('/dashboard')->with('error', 'Access denied');
        }else{
            return view('EditClient', ['ClientData' => $ClientData]);
        }
    }

    public function editprocess($Client_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ClientModel = new ClientModel();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'Client_ID' => 'required|min_length[3]|max_length[10]',
            'Client_Name' => 'required|min_length[3]|max_length[20]',
            'Client_Contact' => 'required|min_length[12]|max_length[20]',
        ]);

        if ($this->request->getMethod() === 'POST') {
            if ($validation->withRequest($this->request)->run()) {

                $client = $ClientModel->find($this->request->getPost('Client_ID'));

                if (!$client) {
                    return redirect()->to('/addclient')->with('error', 'Client ID not valid');
                }

                $updateddata = [
                    'Client_ID' => $this->request->getPost('Client_ID'),
                    'Client_Name' => $this->request->getPost('Client_Name'),
                    'Client_Contact' => $this->request->getPost('Client_Contact'),
                    'Client_Details' => $this->request->getPost('Client_Details'),
                ];

                $ClientModel->update($Client_ID, $updateddata);

                return redirect()->to('/client')->with('success', 'Edit employee successfully!');
            } else {
                return redirect()->to('/client/edit')->with('error', $validation->getErrors());
            }
        }
    }

    public function delete($Client_ID)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $ClientModel = new ClientModel();
        $ClientData = $ClientModel->find($Client_ID);

        if (!$ClientData){
            return redirect()->to('/admin')->with('error', 'Client not found');
        }

        $ClientModel->delete($ClientData['Client_ID']);
        return redirect()->to('/client')->with('success', 'Delete client successfully!');
    }
}