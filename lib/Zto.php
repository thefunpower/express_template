<?php 
namespace ExpressTemplate;
//中通
class Zto extends Base{  
	public $name = 'zto'; 
    public function output($option = []){  
        $this->str = "";
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
        $this->text([
            'right'=>6, 
            'top'=>5,
            'text'=>$type?:"标快",
            'bold'=>true,
        ]);  
        $this->text([ 
            'left'=>6, 
            'top'=>10,
            'text'=>$option['time']?:now(),
            'size'=>'6px', 
        ]); 
        if($name){
            $this->text([ 
                'left'=>6, 
                'top'=>88,
                'text'=>"品名内容：",
                'size'=>'10px',
                'warp'=>true,
                'bold'=>true,
            ]); 
            $this->text([ 
                'left'=>19, 
                'top'=>88.4,
                'text'=>$name,
                'size'=>'9px',
                'warp'=>true, 
            ]); 
        } 
        if($desc){
           $this->text([ 
                'left'=>6, 
                'top'=>93,
                'text'=>"备注：",
                'size'=>'10px',
                'warp'=>true,
                'bold'=>true,
            ]); 

            $this->text([ 
                'left'=>14, 
                'top'=>93.3,
                'text'=>$desc,
                'size'=>'9px',
                'warp'=>true,
                'right'=>22,
            ]);  
        } 
        $this->text([ 
            'left'=>5, 
            'right'=>5, 
            'top'=>16,
            'text'=>$this->barcode($bill_code,['height'=>40]),
        ]);  
        $this->text([ 
            'right'=>5, 
            'top'=>53,
            'text'=>$this->barcode($bill_code,['width'=>50]),
            'rotate'=>-90,
        ]); 
        $this->text([ 
            'left'=>15, 
            'top'=>106,
            'right'=>6,
            'size'=>'6px',
            'text'=>"本次服务适用中通官网(ww.zto.com)公示的快递服务协议条款，您对此单的签收代表您已收到快件且包装完好无损。", 
        ]); 
        $this->text([  
            'top'=>111,
            'left'=>15,
            'size'=>'10px',
            'text'=>"签收人/时间",
            'bold'=>true,
        ]); 
        $this->text([  
            'top'=>120,
            'right'=>6,
            'size'=>'12px',
            'text'=>"已验视&nbsp;&nbsp;&nbsp;&nbsp;已实名",
            'bold'=>true,
        ]); 
        $this->text([ 
            'center'=>true, 
            'top'=>10, 
            'text'=>$mark,
            'bold'=>true,
        ]); 
        $this->bill_code_lr([
            'bill_code'=>$bill_code,
            'top'=>5,
            'space'=>7,
            'left'=>1,
            'rotate'=>90,
            'num'=>4,  
            'prefix'=>'*&nbsp;&nbsp;'
        ]); 
        $this->bill_code_lr([
            'bill_code'=>$bill_code,
            'top'=>5,
            'space'=>7,
            'right'=>1,
            'rotate'=>-90,
            'num'=>4, 
            'prefix'=>'*&nbsp;&nbsp;'
        ]); 
        $this->bill_code_tb([
            'bill_code'=>$bill_code,
            'top'=>1,
            'space'=>3,  
            'num'=>3, 
            'left'=>3, 
            'prefix'=>'*&nbsp;&nbsp;'
        ]); 
        $this->bill_code_tb([
            'bill_code'=>$bill_code,
            'bottom'=>1,
            'space'=>3,  
            'num'=>3, 
            'left'=>3, 
            'prefix'=>'*&nbsp;&nbsp;'
        ]); 
        $this->line([ 
            'top'=>16, 
            'left'=>4, 
        ]);  
        $this->line([ 
            'top'=>36, 
            'left'=>4, 
        ]); 
        $this->line([ 
            'top'=>50, 
            'left'=>4, 
        ]); 
        $this->text([  
            'top'=>40, 
            'left'=>6,
            'text'=>$bag_addr_1,
            'bold'=>true,
        ]); 
        $this->text([  
            'top'=>38, 
            'right'=>6,
            'text'=>$bag_addr_2,
            'warp'=>true,
            'left'=>57,
            'bold'=>true,
        ]); 
        $this->vline([ 
            'top'=>36, 
            'right'=>20,
            'height'=>69 
        ]); 
        $this->text([ 
            'top'=>57.5, 
            'left'=>4, 
            'text'=>"收",
        ]);  
        $this->text([ 
            'top'=>51, 
            'left'=>17, 
            'size'=>'9px',
            'text'=>$this->parse_name($receiver['name']) ."  ".$this->parse_phone($receiver['phone']),
            'bold'=>true,
        ]); 
        $this->text([ 
            'top'=>60, 
            'left'=>17, 
            'size'=>'9px',
            'right'=>22,
            'text'=>$this->parse_address($receiver['address']),
            'bold'=>true,
        ]); 
        $this->text([ 
            'top'=>76, 
            'left'=>17, 
            'size'=>'9px',
            'text'=>$this->parse_name($sender['name']) ."  ".$this->parse_phone($sender['phone']), 
        ]); 
        $this->text([ 
            'top'=>80, 
            'left'=>17, 
            'right'=>22, 
            'size'=>'7px',
            'text'=>$this->parse_address($sender['address']), 
        ]); 
        $this->text([ 
            'left'=>4, 
            'top'=>106,
            'text'=>$this->qr('30px'), 
        ]); 
        $this->line([ 
            'top'=>75, 
            'left'=>4, 
            'width'=>52, 
        ]); 
        $this->vline([ 
            'top'=>50, 
            'left'=>10,
            'height'=>37 
        ]); 
        $this->line([ 
            'top'=>87, 
            'left'=>4,
            'width'=>52 
        ]); 
        $this->text([ 
            'top'=>78, 
            'left'=>7, 
            'text'=>"寄", 
            'size'=>"16px"
        ]); 
        $this->line([ 
            'top'=>105, 
            'left'=>4, 
        ]); 
        $this->line([ 
            'top'=>120, 
            'left'=>4, 
        ]);  
        $body  = $this->render();   
        return $this->do_output($body,$save_path,$return_content); 
    }
}