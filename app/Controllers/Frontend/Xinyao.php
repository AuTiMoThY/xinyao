<?php
namespace App\Controllers\Frontend;
use App\Controllers\BaseController;

class Xinyao extends BaseController
{
    private $page_title = '新增調理帖';

    public function index($cateId = 1, $subCateId = null)
    {

        $xinyaoData = [];
        $currentCate = null;


        switch ($cateId) {
            case "1":
                $xinyaoData = $this->getXinyaoIndex();
                break;
            case "2":
                $xinyaoData = $this->getXinyao2();
                break;
            case "3":
                $xinyaoData = $this->getXinyao3();
                break;
        }

        $data = [
            'xinyaoIndex' => $this->getXinyaoIndex(),
            'cateId' => ($cateId !== null) ? $cateId : 1,
            'subCateId' => ($subCateId !== null) ? $subCateId : 1,
            'xinyaoData' => $xinyaoData,
        ];
        // dd($data);
        return $this->renderView('frontend/xinyao', $this->page_title, $data);
    }
}
