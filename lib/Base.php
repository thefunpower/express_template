<?php 
namespace ExpressTemplate;
use lib\Str;
use helper_v3\Pdf; 
class Base{
	protected $str; 
	protected $width = 76;
	protected $height = 130;
	public $revice_img_url;
	public $qr_url;
	public $sender_img_url; 
	public $image_url;
	public $name = 'zto';
	public $barcode_type = 'C128';

	public function __construct (){
		if(function_exists('host'))
			$this->image_url = host().'/vendor/thefunpower/express_template/img';
	}

	public function do_output($body,$save_path='',$return_content=''){
		$mpdf = Pdf::init([  
		   'format'=>[$this->width, $this->height], 
		   'margin_top' => 5,
		   'margin_left' => 5,
		   'margin_right' => 5,
		   'mirrorMargins' => false
		]); 
		$mpdf->WriteHTML($body);
		if($save_path){
           $dir = get_dir($save_path);
           create_dir_if_not_exists([$dir]);
           return $mpdf->Output($save_path); 
        }else if($return_content){
           return $mpdf->Output('',"S"); 
        } else{
           return $mpdf->Output(); 
        }
	}

	public function parse_name($name){ 
		$j = mb_strlen($name);
		$append = '';
		for($i=0;$i<$j-1;$i++){
			$append .= "*";
		}
		return Str::cut($name,1,"",$false).$append;
	}

	public function parse_phone($phone){
		return substr($phone,0,3)."****".substr($phone,-4);
	}

	public function parse_address($address){
		return $address;
	}

	public function  init (){
		$this->revice_img_url = $this->revice_img_url?:$this->image_url."/revice.png";
		$this->qr_url = $this->qr_url?:$this->image_url."/".$this->name."_qr.png";
		$this->sender_img_url = $this->sender_img_url?:$this->image_url."/"."sender.png";  
	}
 
	public function qr($w = ''){
		$this->init();
		return " 
		 <img src='".$this->qr_url."' style='width:".$w."' />
        ";
	} 

	public function center($text,$font = 12){
		return "<div style='display:flex;align-items:center;justify-content:center;text-align:center;font-size:".$font."px;'>".$text."</div>";
	}

	public function barcode($code,$arr = []){
		$width     = $arr['width'];
		$height    = $arr['height']?:30;
		$font_size = $arr['font_size'];
		$no_text  = $arr['no_text'];
		$prefix  = $arr['prefix'];
		$width = $width?$width.'mm':'100%';  
		$str = '<div style="font-size:'.$font_size.'px;">'.$prefix.$code.'</div>';
		if($no_text){
			$str = '';
		} 
		$generator = new \Picqer\Barcode\BarcodeGeneratorPNG(); 
		return '<div style="text-align:center;width:100%;display:flex;justify-content:center;align-items:center;margin-top:6px;">
			<img src="' . get_barcode($code, $this->barcode_type,2,$height) . '" style="width:'.$width.';" />
			'.$str.'
		</div>';  
	}

	public function text($arr){ 
		$text = $arr['text']; 
		$rotate = $arr['rotate']?:0; 
		$ele_str = $this->get_html_option($arr);
		if($text == '收'){
			$this->init();
			$text = "<img src='".$this->revice_img_url."' style='width:33px;height:33px;margin_left:0px;' />";
		} else if($text == '寄' && $arr['is_icon']){
			$this->init(); 
			$text = "<img src='".$this->sender_img_url."' style='width:20px;height:20px;' />";
		}  
		$str = "<div style='position: absolute; font-size:16px;rotate:$rotate;".$ele_str." '>$text</div>"; 
		$this->str .= $str;
	}

	/**
	* 画横线
	*/
	public function line($arr){
		$top = $arr['top'];
		$left = $arr['left'];
		$right = $arr['right'];
		$width = $arr['width']?:68;
		$ele_str = " top:".$top."mm; ";
		$ele_str .= " width:".$width."mm; ";
		if($left){
			$ele_str.=" left: ".$left.'mm; ';
		}
		if($right){
			$ele_str.=" right: ".$right.'mm; ';
		}
		$this->str .= "<div style='position: absolute; font-size:9px;border-top:1px solid #000;".$ele_str." '></div>";
	}
	/**
	* 画竖线
	*/
	public function vline($arr){
		$top = $arr['top'];
		$left = $arr['left'];
		$right = $arr['right'];
		$height = $arr['height']?:68;
		if($top)
			$ele_str = " top:".$top."mm; ";
		if($height)
			$ele_str .= " height:".$height."mm; ";
		if($left){
			$ele_str.=" left: ".$left.'mm; ';
		}
		if($right){
			$ele_str.=" right: ".$right.'mm; ';
		} 
		$this->str .= "<div style='position: absolute; font-size:9px;border-right:1px solid #000;z-index:1;".$ele_str." '></div>";
		
	}
	/**
	* 顶部、底部运单号
	*/
	public function bill_code_tb($arr){
		$bill_code = $arr['bill_code'];
		$letter_len = $arr['letter_len']?:strlen($bill_code)*1.6; 
		$space   = $arr['space']; 
		$top     = $arr['top'];
		$left     = $arr['left'];
		$bottom  = $arr['bottom'];
		$num     = $arr['num']?:1;
		$prefix = $arr['prefix'];
		if($top){
			$ele_str = "top:".$top.'mm; ';
		}
		if($bottom){
			$ele_str = "bottom:".$bottom.'mm; ';
		} 
		if($with_star){
			 
		}
		for($i=0;$i<$num;$i++){   
			$pleft = $letter_len*$i+$space*$i+$left;	 
			$this->str .= "<div style='position: absolute;font-size:9px; left:".$pleft."mm; ".$ele_str." display:flex; '>".$prefix.$bill_code."</div>";
		}
	}
	/**
	* 左、右运单号
	*/
	public function bill_code_lr($arr){
		$bill_code = $arr['bill_code'];
		$letter_len = $arr['letter_len']?:strlen($bill_code)*1.71;
		$top    = $arr['top'];
		$space  = $arr['space'];
		$rotate = $arr['rotate']?:0; 
		$left   = $arr['left'];
		$right  = $arr['right'];
		$width  = $arr['width'];
		$prefix = $arr['prefix'];
		$num    = $arr['num']?:1;
		if($left){
			$ele_str = "left:".$left.'mm; ';
		}
		if($right){
			$ele_str = "right:".$right.'mm; ';
		} 
		if($width){
			$ele_str = "width:".$width.'mm; ';
		} 
		for($i=0;$i<$num;$i++){  
			$ptop = $letter_len*$i+$space*$i+$top;	 
			$this->str .= "<div style='rotate: ".$rotate.";position: absolute;font-size:9px; top:".$ptop."mm; ".$ele_str." '>".$prefix.$bill_code."</div>";
		}
	}
 

	public function render(){
		return $this->str;
	}

	protected function get_html_option($arr){
		$size  = $arr['size'];
		$top   = $arr['top'];
		$left  = $arr['left'];
		$right = $arr['right'];
		$text  = $arr['text'];
		$width = $arr['width'];
		$height = $arr['height'];
		$bold  = $arr['bold'];
		$center = $arr['center'];
		$warp = $arr['warp']; 
		$rotate = $arr['rotate']?:0;
		$ele_str = '';
		if($top){
			$ele_str = " top:".$top."mm; ";
		}
		if($width){
			$ele_str .= " width:".$width."mm; ";
		}
		if($height){
			$ele_str .= " height:".$height."mm; ";
		}
		if($left){
			$ele_str.=" left: ".$left.'mm; ';
		}
		if($right){
			$ele_str.=" right: ".$right.'mm; ';
		}
		if($size){
			$ele_str.=" font-size: ".$size.'; ';
		}
		if($bold){
			$ele_str.=" font-weight: bold; ";
		}
		if($center){
			$ele_str.=" text-align:center; width:100%; ";
		}
		return $ele_str;
	}
}