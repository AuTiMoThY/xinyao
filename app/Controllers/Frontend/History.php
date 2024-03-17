<?php
namespace App\Controllers\Frontend;
use App\Controllers\BaseController;

class History extends BaseController
{
    private $page_title = '調理帖紀錄';

    public function index()
    {
        $data = [
            'xinyaoIndex' => $this->getXinyaoIndex(),
            'historyData' => $this->getData()
        ];
        // dd($data);
        return $this->renderView('frontend/history', $this->page_title, $data);
    }

    private function getData() {
        return [
            [
                'status' => '等待中',
                'order_num' => '20231226134755',
                'p_name' => '李OO的調理帖',
                'p_value' => '3',
                'p_time' => '1',
                'p_point' => '1',
                'billing_date' => '2023/12/24',
                'run_date' => '',
                'u_name' => '李OO',
                'u_addr' => '台中市南屯區',
                'u_phone' => '0912345678',
                'p_detail' => [
                    [
                        'item_name' => '莫名恐懼 (頭面部)',
                        'item_amount' => '1'
                    ],
                    [
                        'item_name' => '莫名恐懼',
                        'item_amount' => '1'
                    ],
                    [
                        'item_name' => '小膽怕怕 (右腳掌)',
                        'item_amount' => '1'
                    ],
                ]
            ],
            [
                'status' => '運行中',
                'order_num' => '20231226134755',
                'p_name' => '王XX的調理帖',
                'p_value' => '3',
                'p_time' => '1',
                'p_point' => '1',
                'billing_date' => '2023/12/24',
                'run_date' => '2023/12/26 10:15',
                'u_name' => '王XX',
                'u_addr' => '台北市中山區',
                'u_phone' => '0912345678',
                'p_detail' => [
                    [
                        'item_name' => '莫名恐懼 (頭面部)',
                        'item_amount' => '1'
                    ],
                    [
                        'item_name' => '莫名恐懼',
                        'item_amount' => '1'
                    ],
                    [
                        'item_name' => '小膽怕怕 (右腳掌)',
                        'item_amount' => '1'
                    ],
                ]
            ],
            [
                'status' => '已取消',
                'order_num' => '20231226134755',
                'p_name' => '調理帖名稱',
                'p_value' => '4',
                'p_time' => '1',
                'p_point' => '1',
                'billing_date' => '2023/12/20',
                'run_date' => '',
                'u_name' => '林XO',
                'u_addr' => '澎湖縣馬公市',
                'u_phone' => '0912345678',
                'p_detail' => [
                    [
                        'item_name' => '莫名恐懼 (頭面部)',
                        'item_amount' => '1'
                    ],
                    [
                        'item_name' => '莫名恐懼',
                        'item_amount' => '1'
                    ],
                    [
                        'item_name' => '小膽怕怕 (右腳掌)',
                        'item_amount' => '1'
                    ],
                ]
            ],
            [
                'status' => '已完成',
                'order_num' => '20231226134755',
                'p_name' => '調理帖名稱666',
                'p_value' => '3',
                'p_time' => '1',
                'p_point' => '1',
                'billing_date' => '2023/12/19',
                'run_date' => '2023/12/20 10:15',
                'u_name' => '劉OO',
                'u_addr' => '台北市北投區',
                'u_phone' => '0912345678',
                'p_detail' => [
                    [
                        'item_name' => '莫名恐懼 (頭面部)',
                        'item_amount' => '1'
                    ],
                    [
                        'item_name' => '莫名恐懼',
                        'item_amount' => '1'
                    ],
                    [
                        'item_name' => '小膽怕怕 (右腳掌)',
                        'item_amount' => '1'
                    ],
                ]
            ],
        ];
    }
}
