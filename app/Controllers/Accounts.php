<?php

namespace App\Controllers;

use App\Models\CustomerAccountModel;

class Accounts extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerAccountModel();
    }

    public function index()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $keyword = $this->request->getGet('search');
        $status  = $this->request->getGet('status');
        $type    = $this->request->getGet('type');

        $perPage = 10;

        // Apply search keyword filter
        if (!empty($keyword)) {
            $this->customerModel->groupStart()
                ->like('account_number', $keyword)
                ->orLike('customer_name', $keyword)
                ->orLike('email', $keyword)
                ->orLike('phone', $keyword)
            ->groupEnd();
        }

        // Apply status filter
        if (!empty($status)) {
            $this->customerModel->where('status', strtolower($status));
        }

        // Apply connection type filter
        if (!empty($type)) {
            $this->customerModel->where('connection_type', strtolower($type));
        }

        // Paginate results
        $accounts = $this->customerModel->paginate($perPage);

        // Fetch dashboard statistics independently using fresh model instances
        $statsModel = new CustomerAccountModel();

        $data = [
            'accounts'           => $accounts,
            'pager'              => $this->customerModel->pager,
            'total_accounts'     => $statsModel->countAllResults(),
            'active_accounts'    => (clone $statsModel)->where('status', 'active')->countAllResults(),
            'inactive_accounts'  => (clone $statsModel)->where('status', 'inactive')->countAllResults(),
            'suspended_accounts' => (clone $statsModel)->where('status', 'suspended')->countAllResults(),
            'current_page'       => $this->request->getGet('page') ?? 1,
            'search_keyword'     => $keyword,
            'filter_status'      => $status,
            'filter_type'        => $type
        ];

        return view('home/index', $data);
    }

    public function viewAccount($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }
        $account = $this->customerModel->find($id);

        if (!$account) {
            return redirect()->to(base_url('accounts'))->with('error', 'Account not found');
        }

        $data = [
            'account' => $account
        ];

        return view('home/view_account', $data);
    }
    private function requireLogin()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(site_url('login'));
        }

        return null;
    }

    public function createForm()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        return view('home/form_account', [
            'title' => 'Add Customer Account',
            'action' => site_url('accounts/create'),
            'account' => [],
            'errors' => []
        ]);
    }

    public function create()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $data = [
            'account_number' => $this->request->getPost('account_number'),
            'customer_name' => $this->request->getPost('customer_name'),
            'address' => $this->request->getPost('address'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'meter_number' => $this->request->getPost('meter_number'),
            'connection_type' => $this->request->getPost('connection_type'),
            'status' => $this->request->getPost('status')
        ];

        $this->customerModel->insert($data);

        return redirect()->to(site_url('accounts'))
            ->with('success', 'Account created successfully.');
    }

    public function edit($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        return view('home/form_account', [
            'title' => 'Edit Customer Account',
            'action' => site_url('accounts/update/' . $id),
            'account' => $this->customerModel->find($id),
            'errors' => []
        ]);
    }

    public function update($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $data = [
            'account_number' => $this->request->getPost('account_number'),
            'customer_name' => $this->request->getPost('customer_name'),
            'address' => $this->request->getPost('address'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'meter_number' => $this->request->getPost('meter_number'),
            'connection_type' => $this->request->getPost('connection_type'),
            'status' => $this->request->getPost('status')
        ];

        $this->customerModel->update($id, $data);

        return redirect()->to(site_url('accounts'))
            ->with('success', 'Account updated successfully.');
    }

    public function delete($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $this->customerModel->delete($id);

        return redirect()->to(site_url('accounts'))
            ->with('success', 'Account deleted successfully.');
    }
}