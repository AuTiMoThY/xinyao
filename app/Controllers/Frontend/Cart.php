<?php
namespace App\Controllers\Frontend;
use App\Controllers\BaseController;

class Cart extends BaseController
{
    private $page_title = '挑選中調理帖';

    public function index()
    {
        $data = [
            'xinyaoIndex' => $this->getXinyaoIndex(),
        ];
        // dd($data);
        return $this->renderView('frontend/cart', $this->page_title, $data);
    }
    public function cart2()
    {
        $data = [
            'xinyaoIndex' => $this->getXinyaoIndex(),
        ];
        // dd($data);
        return $this->renderView('frontend/cart2', $this->page_title, $data);
    }
}
