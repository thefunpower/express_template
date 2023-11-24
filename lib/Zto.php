<?php 
namespace ExpressTemplate;
use helper_v3\Pdf; 
class Zto extends Base{
    public $image_url; 
    public $revice_img_url; 
	public $qr_url; 
    public function output($option = []){ 
        $t = new Base;
        $type = $option['type'];
        $return_content = $option['return_content']; 
        $name = $option['name'];
        $receiver = $option['receiver'];
        $sender = $option['sender'];
        $bill_code = $option['bill_code'];
        $mark = $option['mark'];
        $bag_addr_1 = $option['bag_addr_1'];
        $bag_addr_2 = $option['bag_addr_2'];
        $desc = $option['desc'];
        $save_path = $option['save_path'];
        $t->revice_img_url = $this->revice_img_url;
        $t->qr_url         = $this->qr_url;
        $t->name = 'zto';
        $t->base_url = $this->image_url;
        $t->text([
            'right'=>6, 
            'top'=>5,
            'text'=>$type?:"标快",
            'bold'=>true,
        ]);  
        $t->text([ 
            'left'=>6, 
            'top'=>10,
            'text'=>now(),
            'size'=>'6px', 
        ]); 
        if($name){
            $t->text([ 
                'left'=>6, 
                'top'=>88,
                'text'=>"品名内容：",
                'size'=>'10px',
                'warp'=>true,
                'bold'=>true,
            ]); 
            $t->text([ 
                'left'=>19, 
                'top'=>88.4,
                'text'=>$name,
                'size'=>'9px',
                'warp'=>true, 
            ]); 
        } 
        if($desc){
           $t->text([ 
                'left'=>6, 
                'top'=>93,
                'text'=>"备注：",
                'size'=>'10px',
                'warp'=>true,
                'bold'=>true,
            ]); 

            $t->text([ 
                'left'=>14, 
                'top'=>93.3,
                'text'=>$desc,
                'size'=>'9px',
                'warp'=>true,
                'right'=>22,
            ]);  
        } 
        $t->text([ 
            'left'=>1, 
            'top'=>16,
            'text'=>$t->barcode($bill_code),
        ]);  
        $t->text([ 
            'right'=>5, 
            'top'=>53,
            'text'=>$t->barcode($bill_code,1),
            'rotate'=>-90,
        ]); 
        $t->text([ 
            'left'=>15, 
            'top'=>106,
            'right'=>6,
            'size'=>'6px',
            'text'=>"本次服务适用中通官网(ww.zto.com)公示的快递服务协议条款，您对此单的签收代表您已收到快件且包装完好无损。", 
        ]); 
        $t->text([  
            'top'=>111,
            'left'=>15,
            'size'=>'10px',
            'text'=>"签收人/时间",
            'bold'=>true,
        ]); 
        $t->text([  
            'top'=>120,
            'right'=>6,
            'size'=>'12px',
            'text'=>"已验视&nbsp;&nbsp;&nbsp;&nbsp;已实名",
            'bold'=>true,
        ]); 
        $t->text([ 
            'center'=>true, 
            'top'=>10, 
            'text'=>$mark,
            'bold'=>true,
        ]); 
        $t->bill_code_lr([
            'bill_code'=>$bill_code,
            'top'=>5,
            'space'=>7,
            'left'=>1,
            'rotate'=>90,
            'num'=>4,  
            'prefix'=>'*&nbsp;&nbsp;'
        ]); 
        $t->bill_code_lr([
            'bill_code'=>$bill_code,
            'top'=>5,
            'space'=>7,
            'right'=>1,
            'rotate'=>-90,
            'num'=>4, 
            'prefix'=>'*&nbsp;&nbsp;'
        ]); 
        $t->bill_code_tb([
            'bill_code'=>$bill_code,
            'top'=>1,
            'space'=>3,  
            'num'=>3, 
            'left'=>3, 
            'prefix'=>'*&nbsp;&nbsp;'
        ]); 
        $t->bill_code_tb([
            'bill_code'=>$bill_code,
            'bottom'=>1,
            'space'=>3,  
            'num'=>3, 
            'left'=>3, 
            'prefix'=>'*&nbsp;&nbsp;'
        ]); 
        $t->line([ 
            'top'=>16, 
            'left'=>4, 
        ]);  
        $t->line([ 
            'top'=>36, 
            'left'=>4, 
        ]); 
        $t->line([ 
            'top'=>50, 
            'left'=>4, 
        ]); 
        $t->text([  
            'top'=>40, 
            'left'=>6,
            'text'=>$bag_addr_1,
            'bold'=>true,
        ]); 
        $t->text([  
            'top'=>38, 
            'right'=>6,
            'text'=>$bag_addr_2,
            'warp'=>true,
            'left'=>57,
            'bold'=>true,
        ]); 
        $t->vline([ 
            'top'=>36, 
            'right'=>20,
            'height'=>69 
        ]); 
        $t->text([ 
            'top'=>57.5, 
            'left'=>6, 
            'text'=>"收",
        ]);  
        $t->text([ 
            'top'=>51, 
            'left'=>17, 
            'size'=>'9px',
            'text'=>$t->parse_name($receiver['name']) ."  ".$t->parse_phone($receiver['phone']),
            'bold'=>true,
        ]); 
        $t->text([ 
            'top'=>60, 
            'left'=>17, 
            'size'=>'9px',
            'right'=>22,
            'text'=>$t->parse_address($receiver['address']),
            'bold'=>true,
        ]); 
        $t->text([ 
            'top'=>76, 
            'left'=>17, 
            'size'=>'9px',
            'text'=>$t->parse_name($sender['name']) ."  ".$t->parse_phone($sender['phone']), 
        ]); 
        $t->text([ 
            'top'=>80, 
            'left'=>17, 
            'right'=>22, 
            'size'=>'7px',
            'text'=>$t->parse_address($sender['address']), 
        ]); 
        $t->text([ 
            'left'=>4, 
            'top'=>106,
            'text'=>$t->qr('30px'), 
        ]); 
        $t->line([ 
            'top'=>75, 
            'left'=>4, 
            'width'=>52, 
        ]); 
        $t->vline([ 
            'top'=>50, 
            'left'=>10,
            'height'=>37 
        ]); 
        $t->line([ 
            'top'=>87, 
            'left'=>4,
            'width'=>52 
        ]); 
        $t->text([ 
            'top'=>78, 
            'left'=>7, 
            'text'=>"寄",
            'size'=>"16px"
        ]); 
        $t->line([ 
            'top'=>105, 
            'left'=>4, 
        ]); 
        $t->line([ 
            'top'=>120, 
            'left'=>4, 
        ]);  
        $body  = $t->render();  
        $mpdf = Pdf::init([  
            'format'=>[76, 130], 
            'margin_top' => 5,
            'margin_left' => 5,
            'margin_right' => 5,
            'mirrorMargins' => false
        ]);
        $mpdf->WriteHTML($body);
        return $this->do_output($mpdf,$save_path,$return_content); 
    }
}