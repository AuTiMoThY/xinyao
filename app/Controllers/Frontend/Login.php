<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{
    use ResponseTrait;
    private $page_title = '登入心藥系統';
    public function index()
    {
        // 檢查 session 以判斷使用者是否已登入
        $session = session();
        if ($session->has('isLoggedIn')) {
            // 使用者已登入，重定向到首頁
            return redirect()->to('/');
        }

        // 顯示登入表單
        // return view('login');
        return $this->renderView('frontend/login', $this->page_title);
    }

    public function apiLogin()
    {
        $session = session();
        $json = $this->request->getJSON();
        $username = $json->user_id ?? '';
        $password = $json->user_pw ?? '';

        // 驗證使用者名稱和密碼...
        // 假設驗證成功，設定 session

        session()->set([
            'username'		=> $username,
            'isLoggedIn' 	=> TRUE
        ]);

        // return $this->response->setJSON(['status' => '1', 'message' => 'Login successful', 'user' => $user_id]);
        return $this->respond(['message' => 'Login successful'], 200);
    }

    public function logout() {
        $session = session();

        // 移除所有 session 數據，或者也可以只移除登入相關的數據
        $session->remove('isLoggedIn');
        $session->remove('username');

        return redirect()->to('/');
    }
}
