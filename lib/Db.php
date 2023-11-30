<?php 
namespace ExpressTemplate;
//德邦
class Db extends Base{  
    public $name = 'db';  
    public function output($option = []){
        $this->str = "";  
        $type = $option['type'];
        $return_content = $option['return_content']; 
        $name = $option['name'];
        $receiver = $option['receiver'];
        $sender = $option['sender'];
        $bill_code = $option['bill_code'];
        $sub_bill_code = $option['sub_bill_code'];
        $title = $option['title'];
        $sub_title = $option['sub_title'];
        $mark = $option['mark'];
        $bag_addr_1 = $option['bag_addr_1'];
        $bag_addr_2 = $option['bag_addr_2'];
        $desc1 = $option['desc1'];
        $desc2 = $option['desc2']; 
        $desc = $option['desc'];
        $save_path = $option['save_path'];  
        $tip1 = $option['tip1'];  
        $tip2 = $option['tip2'];  
        $notice = $option['notice'];   
        $type_html = "<div style='color:#FFF;background:#000;padding: 6px 8px 6px 13px;'>".($type?:"普快")."</div>";
        
        $this->bill_code_lr([
            'bill_code'=>$bill_code,
            'top'=>28,
            'space'=>5,
            'left'=>1,
            'rotate'=>90,
            'num'=>2,  
            'prefix'=>''
        ]); 
        $this->bill_code_lr([
            'bill_code'=>$bill_code,
            'top'=>21,
            'space'=>5,
            'right'=>1,
            'rotate'=>-90,
            'num'=>3, 
            'prefix'=>''
        ]); 

        $this->text([   
            'top'=>10, 
            'left'=>1,
            'text'=>'实名验证',
            'size'=>'8px',
            'rotate'=>90,
        ]); 

        $this->text([   
            'top'=>10, 
            'right'=>1,
            'text'=>'已验视',
            'size'=>'8px',
            'rotate'=>-90,
        ]); 

        $this->text([   
            'top'=>3, 
            'right'=>5,
            'text'=>$notice, 
            'width'=>9,
            'size'=>'13px',
            'rotate'=>0,
        ]); 

        $this->text([   
            'top'=>105, 
            'right'=>1,
            'text'=>'https://deppon.com',
            'size'=>'8px',
            'rotate'=>-90,
        ]); 
         

        $this->text([   
            'top'=>100, 
            'left'=>1,
            'text'=>$option['time']?:now(),
            'size'=>'8px',
            'rotate'=>90,
        ]); 

        $this->text([   
            'top'=>8, 
            'left'=>4, 
            'text'=>$this->center($mark,'20pt'), 
            'bold'=>true,
        ]); 
        $this->text([ 
            'top'=>18, 
            'left'=>4, 
            'size'=>'9px',
            'right'=>22,
            'text'=>"[送]",
            'bold'=>false,
        ]); 
        $this->text([ 
            'top'=>18, 
            'left'=>9, 
            'size'=>'9px',
            'right'=>22,
            'text'=>$option['to']?:$this->parse_address($receiver['address']),
            'bold'=>false,
        ]);  

        $this->text([ 
            'top'=>26, 
            'left'=>4, 
            'size'=>'9px',
            'width'=>46,
            'text'=>$title,
            'bold'=>false,
        ]); 

        $this->text([ 
            'top'=>26, 
            'right'=>5,
            'width'=>10, 
            'size'=>'9px',             
            'text'=>$this->right($sub_title,'9px'),
            'bold'=>false,
        ]);  
        if($sub_bill_code){ 
            if($bill_code != $sub_bill_code){
                $this->text([ 
                    'left'=>5, 
                    'right'=>5, 
                    'top'=>31, 
                    'text'=>$this->center("母：".$bill_code,12),
                ]);  
                $this->text([ 
                    'left'=>5, 
                    'right'=>5, 
                    'top'=>34, 
                    'text'=>$this->barcode($sub_bill_code,['height'=>40,'prefix'=>'子：']),
                ]);  
            }else{
                $this->text([ 
                    'left'=>5, 
                    'right'=>5, 
                    'top'=>31, 
                    'text'=>$this->barcode($sub_bill_code,['height'=>50,'prefix'=>'母：']),
                ]);  
            }
            
        }else{
            $this->text([ 
                'left'=>5, 
                'right'=>5, 
                'top'=>31, 
                'text'=>$this->barcode($bill_code,['height'=>50]),
            ]);  
        }
        

        $this->line([ 
            'top'=>31, 
            'left'=>4, 
        ]); 

        $this->line([ 
            'top'=>52, 
            'left'=>4, 
        ]); 
 
        $this->text([ 
            'top'=>53, 
            'left'=>4, 
            'size'=>'12px',
            'text'=>"收:&nbsp;&nbsp;".$this->parse_name($receiver['name']) ."&nbsp;&nbsp;&nbsp;&nbsp;".$this->parse_phone($receiver['phone']),
            'bold'=>false,
        ]); 

        $this->text([ 
            'top'=>58, 
            'left'=>4, 
            'size'=>'9px',
            'right'=>22,
            'text'=>$this->parse_address($receiver['address']),
            'bold'=>false,
        ]); 

        $this->line([ 
            'top'=>66, 
            'left'=>4, 
        ]); 

        $this->text([ 
            'top'=>68, 
            'left'=>17, 
            'size'=>'9px',
            'text'=>"寄: &nbsp;&nbsp;".$this->parse_name($sender['name']) ."&nbsp;&nbsp;&nbsp;&nbsp;".$this->parse_phone($sender['phone']), 
        ]); 
        $this->text([ 
            'top'=>72, 
            'left'=>17, 
            'right'=>4, 
            'size'=>'7px',
            'text'=>$this->parse_address($sender['address']), 
        ]); 
        
        $this->line([ 
            'top'=>78, 
            'left'=>17, 
            'width'=>55, 
        ]); 

        $this->text([ 
            'top'=>79, 
            'left'=>17, 
            'size'=>'8px',
            'right'=>4,
            'text'=>"品名：".$name,
            'bold'=>false,
        ]); 

        $this->text([ 
            'top'=>87, 
            'left'=>17, 
            'size'=>'8px',
            'right'=>4,
            'text'=>"备注：".$desc,
            'bold'=>false,
        ]); 

        $this->text([ 
            'left'=>3, 
            'top'=>68,
            'text'=>$this->barcode($bill_code,['width'=>55,'height'=>40,'no_text'=>true]),
            'rotate'=>-90,
        ]);  

        $this->line([ 
            'top'=>97, 
            'left'=>17, 
            'width'=>55, 
        ]); 

        $this->line([ 
            'top'=>110, 
            'left'=>17, 
            'width'=>55, 
        ]); 

        $this->text([ 
            'left'=>17, 
            'top'=>98,
            'right'=>10,
            'text'=>$desc1, 
            'size'=>'8px',
        ]);

        $this->text([ 
            'left'=>17, 
            'top'=>111,
            'right'=>10,
            'text'=>$desc2, 
            'size'=>'8px',
        ]);    

        $this->line([ 
            'top'=>113, 
            'right'=>4, 
            'width'=>22, 
        ]);

        $this->line([ 
            'top'=>118, 
            'right'=>4, 
            'width'=>22, 
        ]);  

        $this->line([ 
            'top'=>126, 
            'right'=>4, 
            'width'=>22, 
        ]); 

        $this->vline([ 
            'top'=>113, 
            'height'=>13.3, 
            'right'=>26, 
        ]);
        $this->vline([ 
            'top'=>113, 
            'height'=>13.3, 
            'right'=>4, 
        ]);

        $this->text([  
            'top'=>114,
            'right'=>4,
            'width'=>22,
            'text'=>$this->center($tip1,8), 
            'size'=>'8px',
        ]); 

        $this->text([  
            'top'=>119,
            'right'=>4,
            'width'=>21,
            'text'=>$tip2, 
            'size'=>'8px',
        ]);     
     
        $body  = $this->render();   
        return $this->do_output($body,$save_path,$return_content); 
    }
}