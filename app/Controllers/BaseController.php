<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }


    public $memberInfo = null;
    public function renderView($viewName, $page_title, $other_data = [])
    {
        // $this->memberInfo = $this->session->get('member_info');

        // if ($this->memberInfo !== null && $this->placeData !== null) {
        //     $data = [
        //         "session" => $this->session->get(),
        //         "page_title" => $page_title,
        //         "placeData" => json_encode($this->placeData),
        //         "parameterOptions" => json_encode($this->parameterOptions),
        //         "member_level" => $this->memberInfo->status,
        //         "token" => $this->memberInfo->token,
        //         "user_id" => $this->memberInfo->user_id,
        //     ];
        //     return view($viewName, $data);
        // }
        // else {
        //     return redirect()->to(base_url('/'));
        // }

        $data = array_merge(
            [
                "page_title" => $page_title
            ]
            , $other_data
        );
        return view($viewName, $data);
    }

    public function getXinyaoIndex()
    {
        return [
            [
                'txt'  => '恐懼',
                'note' => '莫名恐懼/抓狂暴衝/小膽怕怕/過度擔憂/驚慌失措',
                'item' => [
                    [
                        'name' => '莫名恐懼',
                        'directions' => '釋放遭受恐懼與擔憂困擾卻找不到原因的情緒。<br>莫名、無以名狀的恐懼，沒有原因的、沒有解釋的。<br>怕什麼不幸的事情將會降臨，但說不出是什麼、為什麼。<br>神經質，容易緊張焦慮。<br>對未來常有不祥的預感。<br>當被問及為何害怕，卻說不出理由。<br>感到不明原因且無法以言語解釋的不安或恐懼。',
                        'parts' => [
                            [ 'part_name' => '頭面部', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                            [ 'part_name' => '右頸胸肩', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827171071177117.jpeg' ],
                            [ 'part_name' => '左腿內側', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827171340944094.jpeg' ],
                            [ 'part_name' => '背部軀幹', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827171265736573.jpeg' ]
                        ]
                    ],
                    [
                        'name' => '抓狂暴衝',
                        'directions' => '釋放害怕失控而傷害自己或他人的情緒。 <br>害怕自己精神錯亂、頭腦抓狂。當心裡受到太大的壓力或傷害時，快要控制不住自己的情緒，幾至崩潰抓狂時。每個人都有情緒失控、失去理性的時候，想報復、想傷害他人或自己、不斷哭泣、暴怒，或任何強烈情緒，都適用。對理性無法運作，變得無法控制自己而感到不安。',
                        'parts' => [
                            [ 'part_name' => '背部軀幹', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827173147854785.jpeg' ],
                            [ 'part_name' => '腿部正面', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827173368266826.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '小膽怕怕',
                        'directions' => '釋放擔心任何已知的、預設的恐懼情緒。 <br>這類型的人通常害羞而膽小安靜，有禮貌卻不善交際，常避免跟陌生人講話，清楚讓自己產生恐懼及不安的對象，對於任何已知原因的恐懼，舉凡怕高、怕昆蟲、怕死、怕黑、怯場等，都適用小膽怕怕心藥。可幫助這類型的人更有膽量，有勇氣表達自己。',
                        'parts' => [
                            [ 'part_name' => '右頸胸肩', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827190985268526.jpeg' ],
                            [ 'part_name' => '背部軀幹', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/2017082719110687687.jpeg' ],
                            [ 'part_name' => '胸腹軀幹', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827191211301130.jpeg' ],
                            [ 'part_name' => '左臂前方', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827191456405640.jpeg' ],
                            [ 'part_name' => '右腳掌', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827191655635563.jpeg' ],
                            [ 'part_name' => '男性 陰部', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827191780038003.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '過度擔憂',
                        'directions' => '釋放過度擔心親人安危福祉而內心不安的情緒。<br>為別人的福祉擔憂，像媽媽一樣，過度為他人擔憂，可能每隔幾分鐘就查看一次小孩，或是親人稍微晚歸就憂心忡忡。不斷對他人噓寒問暖。如果關心的人失聯一會兒，就設想各種意外狀況，擔心得發狂。',
                        'parts' => [
                            [ 'part_name' => '左頸胸肩', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827192299259925.jpeg' ],
                            [ 'part_name' => '背部軀幹', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827192341154115.jpeg' ],
                            [ 'part_name' => '右手掌背', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827192443384338.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '驚慌失措',
                        'directions' => '釋放被意外事件驚嚇而驚惶的情緒。 <br>驚慌失措心藥對應最強烈的恐懼，例如半夜被惡夢驚醒，或經歷意外事件而驚駭恐慌。可能怕得全身顫抖冷汗直流，呆住了，大腦整個停止運作，眩暈。驚慌失措心藥能讓身心平靜，消除緊張，掌控狀況。感到極度恐懼，陷入恐慌的狀態之中。',
                        'parts' => [
                            [ 'part_name' => '胸腹軀幹', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827192524372437.jpeg' ],
                            [ 'part_name' => '臀部', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827192763366336.jpeg' ],
                            [ 'part_name' => '大腿', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827192958695869.jpeg' ],
                            [ 'part_name' => '大腿', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/2017082719300735735.jpeg' ],
                            [ 'part_name' => '小腿', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827193119051905.jpeg' ],
                        ]
                    ],
                ]
            ],
            [
                'txt'  => '茫然',
                'note' => '舉棋不定/挫折消沉/絕望重鬱/怠惰沒勁/優柔寡斷',
                'item' => [
                    [
                        'name' => '舉棋不定',
                        'directions' => '舉棋不定之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '挫折消沉',
                        'directions' => '挫折消沉之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '絕望重鬱',
                        'directions' => '絕望重鬱之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '怠惰沒勁',
                        'directions' => '怠惰沒勁之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '優柔寡斷',
                        'directions' => '優柔寡斷之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                ]
            ],
            [
                'txt'  => '妄念',
                'note' => '重複犯錯/妄想未來/沉溺過去/不時憂鬱/失控思緒/生活無趣',
                'item' => [
                    [
                        'name' => '重複犯錯',
                        'directions' => '重複犯錯之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '妄想未來',
                        'directions' => '妄想未來之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '沉溺過去',
                        'directions' => '沉溺過去之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '不時憂鬱',
                        'directions' => '不時憂鬱之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '失控思緒',
                        'directions' => '失控思緒之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '生活無趣',
                        'directions' => '生活無趣之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                ]
            ],
            [
                'txt'  => '寂寞',
                'note' => '漫無目標/表現存在/性急浮躁/孤傲不群',
                'item' => [
                    [
                        'name' => '漫無目標',
                        'directions' => '漫無目標之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '表現存在',
                        'directions' => '表現存在之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '性急浮躁',
                        'directions' => '性急浮躁之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '孤傲不群',
                        'directions' => '孤傲不群之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                ]
            ],
            [
                'txt'  => '敏感',
                'note' => '表面快樂/唯諾服務/怨瞋復仇/生活驟變/佔有依賴',
                'item' => [
                    [
                        'name' => '表面快樂',
                        'directions' => '表面快樂之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '唯諾服務',
                        'directions' => '唯諾服務之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '怨瞋復仇',
                        'directions' => '怨瞋復仇之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '生活驟變',
                        'directions' => '生活驟變之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '佔有依賴',
                        'directions' => '佔有依賴之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                ]
            ],
            [
                'txt'  => '負面',
                'note' => '過度細節/喪失自信/罪己自責/驚嚇創傷/悲苦折磨/怨天尤人',
                'item' => [
                    [
                        'name' => '過度細節',
                        'directions' => '過度細節之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '喪失自信',
                        'directions' => '喪失自信之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '罪己自責',
                        'directions' => '罪己自責之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '驚嚇創傷',
                        'directions' => '驚嚇創傷之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '悲苦折磨',
                        'directions' => '悲苦折磨之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '怨天尤人',
                        'directions' => '怨天尤人之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                ]
            ],
            [
                'txt'  => '重擔',
                'note' => '身心耗竭/老牛拖車/責任硬撐/標準苛刻/嚴格律己/工作狂熱/獨裁支配',
                'item' => [
                    [
                        'name' => '身心耗竭',
                        'directions' => '身心耗竭之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '老牛拖車',
                        'directions' => '老牛拖車之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '責任硬撐',
                        'directions' => '責任硬撐之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '標準苛刻',
                        'directions' => '標準苛刻之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '嚴格律己',
                        'directions' => '嚴格律己之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '工作狂熱',
                        'directions' => '工作狂熱之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '獨裁支配',
                        'directions' => '獨裁支配之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                ]
            ],
            [
                'txt'  => '靈性及業力',
                'note' => '好運富足/光明灌頂/靈性加持',
                'item' => [
                    [
                        'name' => '好運富足',
                        'directions' => '好運富足之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '光明灌頂',
                        'directions' => '光明灌頂之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                    [
                        'name' => '靈性加持',
                        'directions' => '靈性加持之說明',
                        'parts' => [
                            [ 'part_name' => '部位1', 'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg' ],
                        ]
                    ],
                ]
            ],
        ];
    }

    public function getXinyao2() {
        return [
            [
                'txt'  => '',
                'note' => '',
                'item' => [
                    [
                        'name' => '緊張應變',
                        'directions' => '緊張應變藥方說明',
                        'parts' => [
                            [
                                'part_name' => '部位1',
                                'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg'
                            ],
                        ]
                    ],
                ]
            ],
        ];
    }

    public function getXinyao3() {
        return [
            [
                'txt'  => '',
                'note' => '',
                'item' => [
                    [
                        'name' => '症狀初期',
                        'directions' => '症狀初期藥方說明',
                        'parts' => [
                            [
                                'part_name' => '部位1',
                                'part_img' => 'http://maha-sati.org/admin/attached/media/20170827/20170827170913961396.jpeg'
                            ],
                        ]
                    ],
                ]
            ],
        ];
    }
}
