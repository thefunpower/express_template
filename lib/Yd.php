<?php 
namespace ExpressTemplate;

class Yd extends Base{  
	public $name = 'yd'; 
    public $barcode_type = 'C128C';
    public function output($option = []){  
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
        $type_html = "<div style='color:#FFF;background:#000;padding: 6px 8px 6px 13px;'>".($type?:"普快")."</div>";
        
        $this->text([ 
            'left'=>5, 
            'top'=>11,
            'text'=>$option['time']?:now(),
            'size'=>'12px', 
        ]);  
        if($desc){
           $this->text([ 
                'left'=>6, 
                'top'=>90,
                'right'=>22,
                'text'=>$desc,
                'size'=>'10px',
                'warp'=>true, 
            ]);  
        } 
        $this->text([ 
            'left'=>1, 
            'top'=>25, 
            'text'=>$this->barcode($bill_code,1),
        ]);  
        $this->text([ 
            'right'=>5, 
            'top'=>25,
            'text'=>$this->barcode($bill_code,1),
            'rotate'=>-90,
        ]);  
        $this->text([  
            'top'=>110,
            'right'=>6,
            'size'=>'12px',
            'text'=>"已验视",
            'bold'=>true,
        ]); 
        $this->text([   
            'top'=>14, 
            'left'=>4,
            'text'=>$mark,
            'size'=>'25pt',
            'bold'=>true,
        ]); 
        $this->bill_code_lr([
            'bill_code'=>$bill_code,
            'top'=>5,
            'space'=>7,
            'left'=>1,
            'rotate'=>-90,
            'num'=>4,  
            'prefix'=>'*&nbsp;&nbsp;'
        ]); 
        $this->bill_code_lr([
            'bill_code'=>$bill_code,
            'top'=>5,
            'space'=>7,
            'right'=>1,
            'rotate'=>90,
            'num'=>4, 
            'prefix'=>'*&nbsp;&nbsp;'
        ]); 
        $this->bill_code_tb([
            'bill_code'=>$bill_code,
            'top'=>8,
            'space'=>3,  
            'num'=>2, 
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
            'top'=>25, 
            'left'=>4, 
        ]); 
       
        $this->vline([ 
            'top'=>25, 
            'right'=>22,
            'height'=>60 
        ]);
        $this->vline([ 
            'top'=>25, 
            'right'=>4,
            'height'=>60 
        ]);

         $this->vline([ 
            'top'=>25, 
            'left'=>-1.6,
            'height'=>60 
        ]); 
        $this->line([ 
            'top'=>40, 
            'left'=>4,  
            'width'=>50,
        ]); 
        $this->line([ 
            'top'=>46, 
            'left'=>4, 
            'width'=>50,
        ]); 
        $this->line([ 
            'top'=>55, 
            'left'=>4, 
            'width'=>50,
        ]); 
        if($bag_addr_2){
            $bag_addr_2 = '-'.$bag_addr_2;
        }
        $this->text([  
            'top'=>48, 
            'left'=>6,
            'text'=>$bag_addr_1.$bag_addr_2,
            'bold'=>true,
        ]); 
    
        $this->text([ 
            'top'=>60, 
            'left'=>6, 
            'text'=>"收",
        ]);  
        $this->text([ 
            'top'=>60, 
            'left'=>17, 
            'size'=>'9px',
            'text'=>$this->parse_name($receiver['name']) ."  ".$this->parse_phone($receiver['phone']),
            'bold'=>true,
        ]); 
        $this->text([ 
            'top'=>65, 
            'left'=>17, 
            'size'=>'9px',
            'right'=>22,
            'text'=>$this->parse_address($receiver['address']),
            'bold'=>true,
        ]); 
        $this->line([ 
            'top'=>73, 
            'left'=>4, 
            'width'=>50,
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
            'top'=>78, 
            'left'=>7, 
            'text'=>"寄",
            'is_icon'=>true,
            'size'=>"16px"
        ]); 

        $this->line([ 
            'top'=>85, 
            'left'=>4, 
            'width'=>68,
        ]); 
        $this->text([
            'right'=>1, 
            'top'=>7,
            'text'=>$type_html,
            'bold'=>true,
        ]);   
        $body  = $this->render();   
        return $this->do_output($body,$save_path,$return_content); 
    }
}