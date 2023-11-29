<?php
namespace ExpressTemplate;
//德邦
class Db extends Base{
	public $name = 'db';
    public function output($option = []){
        $this->str = "";
        $order_no = $option['order_no'];
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
        $insured_amount = $option['insured_amount'];
        $receipt = $option['receipt']?:'无';
        $receipt_requirements = $option['receipt_requirements']?:'无';
        $bill_note = $option['bill_note'];
        $save_path = $option['save_path'];
        $payment_method = $option['payment_method'];
        $transport_type = $option['transport_type'];

        $this->bill_code_lr([
            'bill_code'=>$bill_code,
            'top'=>28,
            'space'=>5,
            'left'=>0.5,
            'rotate'=>90,
            'num'=>2,
            'prefix'=>'',
            'size'=>'7pt'
        ]);

        $this->bill_code_lr([
            'bill_code'=>$bill_code,
            'top'=>21,
            'space'=>5,
            'right'=>0.5,
            'rotate'=>-90,
            'num'=>2,
            'prefix'=>'',
            'size'=>'7pt'
        ]);

        $this->text([
            'top'=>1,
            'left'=>2,
            'text'=>'德邦快递',
            'size'=>'18pt',
        ]);

        $this->text([
            'top'=>10,
            'left'=>0.5,
            'text'=>'实名验证',
            'size'=>'7pt',
            'rotate'=>90,
        ]);

        $this->text([
            'top'=>10,
            'right'=>0.5,
            'text'=>'已验视',
            'size'=>'7pt',
            'rotate'=>-90,
        ]);

        $this->text([
            'top'=>1,
            'right'=>4,
            'text'=>$transport_type,
            'width'=>6,
            'size'=>'8pt',
            'rotate'=>0,
        ]);

        $this->text([
            'top'=>105,
            'right'=>0.5,
            'text'=>'https://deppon.com',
            'size'=>'7pt',
            'rotate'=>-90,
        ]);

        $this->text([
            'top'=>100,
            'left'=>1,
            'text'=>$option['time']?:now(),
            'size'=>'7pt',
            'rotate'=>90,
        ]);

        $this->text([
            'top'=>10,
            'left' => 5,
            'right' => 5,
            'text'=>$mark,
            'size'=>'20pt',
        ]);

        $this->text([
            'top'=>26,
            'left' => 5,
            'size'=>'8pt',
            'width'=>46,
            'text'=>$title,
        ]);

        $this->text([
            'top'=>26,
            'left' => 5,
            'right' => 5,
            'text'=>$this->right($sub_title, '8pt'),
        ]);

        if($sub_bill_code){
            $bill_code_text = substr($bill_code, 0, 3).'&nbsp;'.substr($bill_code, 3, 4).'&nbsp;'.substr($bill_code, 7, 4).'&nbsp;'.substr($bill_code, 11);
            if($bill_code != $sub_bill_code){
                $this->text([
                    'left'=>5,
                    'right'=>5,
                    'top'=>31,
                    'text'=>$this->right("[母]&nbsp;".$bill_code_text, '14pt'),
                ]);
                $this->text([
                    'left'=>5,
                    'right'=>5,
                    'top'=>47.5,
                    'text'=>$this->right("[子]&nbsp;".$bill_code_text, '8pt'),
                ]);
                $this->text([
                    'left'=>5,
                    'right'=>5,
                    'top'=>37,
                    'text'=>$this->barcode($sub_bill_code,['height'=>40]),
                ]);
            }else{
                $this->text([
                    'left'=>5,
                    'right' => 5,
                    'top'=>32,
                    'text'=>$this->right('[母]&nbsp;'.$bill_code_text, '14pt')
                ]);
                $this->text([
                    'left'=>5,
                    'right'=>5,
                    'top'=>38,
                    'text'=>$this->barcode($sub_bill_code,['height'=>40]),
                ]);
            }

        }else{
            $bill_code_text = substr($bill_code, 0, 3).'&nbsp;'.substr($bill_code, 3, 4).'&nbsp;'.substr($bill_code, 7, 4).'&nbsp;'.substr($bill_code, 11);
            $this->text([
                'left'=>5,
                'right' => 5,
                'top'=>32,
                'text'=>$this->right($bill_code_text, '14pt')
            ]);
            $this->text([
                'left' => 5,
                'right' => 5,
                'top'=>38,
                'text'=>$this->barcode($bill_code,['height'=>50]),
            ]);
        }

        $this->line([
            'top'=>31,
            'left' => 5,
            'width' => 66
        ]);

        $this->line([
            'top'=>52,
            'left' => 5,
            'width' => 66
        ]);

        $this->text([
            'top'=>53,
            'left' => 5,
            'size'=>'8pt',
            'text'=>"收：".$this->parse_name($receiver['name']) ."&emsp;&emsp;&emsp;&emsp;".$receiver['company'],
        ]);

        $this->text([
            'top'=>56,
            'left' => 5,
            'size'=>'8pt',
            'text'=>$this->parse_phone($receiver['phone']),
        ]);

        $this->text([
            'top'=>59,
            'left' => 5,
            'size'=>'8pt',
            'right' => 5,
            'text'=>$this->parse_address($receiver['address']),
        ]);

        $this->line([
            'top'=>66,
            'left' => 5,
            'width' => 66
        ]);

        $this->text([
            'top'=>67,
            'left'=>13,
            'right' => 5,
            'size'=>'8pt',
            'text'=>"寄：".$this->parse_name($sender['name']),
        ]);

        $this->text([
            'top'=>67,
            'left'=>13,
            'right' => 5,
            'text'=>$this->right($sender['company'], '8pt'),
        ]);

        $this->text([
            'top'=>72,
            'left'=>13,
            'right' => 5,
            'size'=>'8pt',
            'text'=>$this->parse_phone($sender['phone']),
        ]);

        $this->line([
            'top'=>77,
            'left'=>13,
            'width'=>58,
        ]);

        $this->text([
            'top'=>78,
            'left'=>13,
            'size'=>'8pt',
            'right' => 5,
            'text'=>"品名：".$name,
        ]);

        $this->text([
            'top'=>87,
            'left'=>13,
            'size'=>'8pt',
            'right' => 5,
            'text'=>"备注：".$bill_note,
        ]);

        $this->text([
            'left'=>3,
            'top'=>68,
            'text'=>$this->barcode($bill_code,['width'=>55,'height'=>40,'no_text'=>true]),
            'rotate'=>-90,
        ]);

        $this->line([
            'top'=>98,
            'left'=>13,
            'width'=>58,
        ]);

        $this->line([
            'top'=>112,
            'left'=>13,
            'width'=>59,
        ]);

        $this->text([
            'left'=>13,
            'top'=>98,
            'right'=>10,
            'text'=>'签收单：'.$receipt,
            'size'=>'8pt',
        ]);

        $this->text([
            'left'=>13,
            'top'=>102,
            'right'=>10,
            'text'=>'返单要求：'.$receipt_requirements,
            'size'=>'8pt',
        ]);

        $this->line([
            'top'=>113,
            'right' => 5,
            'width'=>22,
        ]);

        $this->line([
            'top'=>118,
            'right' => 5,
            'width'=>22,
        ]);

        $this->line([
            'top'=>126,
            'right' => 5,
            'width'=>22,
        ]);

        $this->vline([
            'top'=>113,
            'height'=>13.3,
            'right'=>27,
        ]);
        $this->vline([
            'top'=>113,
            'height'=>13.3,
            'right' => 5,
        ]);

        if ($insured_amount) {
            $this->text([
                'left'=>13,
                'top'=>113,
                'right'=>10,
                'text'=>'保价金额：'.$insured_amount,
                'size'=>'8pt',
            ]);
        }

        $this->text([
            'left'=>13,
            'top'=>118,
            'right'=>23,
            'text'=>'用户单号：'.substr($order_no, 18),
            'size'=>'8pt',
        ]);

        $this->text([
            'top'=>119,
            'right' => 5,
            'width'=>21,
            'text'=>$payment_method,
            'size'=>'8pt',
        ]);

        $body  = $this->render();
        return $this->do_output($body,$save_path,$return_content);
    }
}