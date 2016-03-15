<?php
$ranks = array(
    'จอมพล', 'พลเอก', 'พลโท', 'พลตรี', 'พลจัตวา', 
    'พันเอก (พิเศษ)', 'พันเอก', 'พันโท', 'พันตรี', 'ร้อยเอก', 
    'ร้อยโท', 'ร้อยตรี', 'จ่าสิบเอก', 'จ่าสิบโท', 'จ่าสิบตรี', 
    'สิบเอก', 'สิบโท', 'สิบตรี', 'สิบตรีกองประจำการ', 'นาย',
    'นาง', 'นางสาว'  
);

$short_months = array(
    '01' => 'ม.ค.', 
    '02' => 'ก.พ.', 
    '03' => 'มี.ค.', 
    '04' => 'เม.ษ.', 
    '05' => 'พ.ค.', 
    '06' => 'มิ.ย.', 
    '07' => 'ก.ค.', 
    '08' => 'ส.ค.', 
    '09' => 'ก.ย.', 
    '10' => 'ต.ค.', 
    '11' => 'พ.ย.', 
    '12' => 'ธ.ค.'
);

$alphabet = array(
    0 => 'A','B','C','D','E','F','G','H','I','J',
    'K','L','M','N','O','P','Q','R','S','T',
    'U','V','W','X','Y','Z'
);

/**
 * เรียกใช้งาน $_GET โดยสามารถกำหนดค่า default และ filter เองได้
 */
function input_get($name, $default = false, $filter = FILTER_SANITIZE_STRING){
	$val = filter_input(INPUT_GET, $name, $filter);
	return ( empty($val) ) ? $default : $val ;
}

/**
 * เรียกใช้งาน $_POST โดยสามารถกำหนดค่า default และ filter เองได้
 */
function input_post($name, $default = false, $filter = FILTER_SANITIZE_STRING){
	$val = filter_input(INPUT_POST, $name, $filter);
	return ( empty($val) ) ? $default : $val ;
}

function input_etc($name, $default = false){
    $txt = htmlspecialchars( strip_tags($name), ENT_QUOTES );
    return ( empty($txt) ) ? $default : $txt ;
}

function dump($t){
    echo '<pre>';
    var_dump($t);
    echo '</pre>';
}

function domain(){
    $domain = strtolower(getenv('HTTPS')) == 'on' ? 'https' : 'http' . '://' . getenv('HTTP_HOST') . ( ($p = getenv('SERVER_PORT')) != 80 AND $p != 443 ? ":$p" : '' );
    return $domain;
}

function getUrl(){
    global $config;
    return domain().'/'.$config['base_url'];
}

function redirect($url = false, $msg = false){
    global $config;
    
    $url = domain().'/'.$config['base_url'].$url;
    if( $msg !== false ){
        $_SESSION['x_msg'] = $msg;
    }
    header('Location: '.$url);
    exit;
}

if( !function_exists('toNumber') ){
    function toNumber($number){
        $number = empty($number) ? 0 : $number ;
        return number_format($number, 2);
    }
}

/**
 * เปลี่ยนจากเลข Column เป็น A, B, C ...
 */
function setCol($col){
    global $alphabet;
    $new_col = array();
    foreach( $col as $key => $col_val){
        
        if( strlen($col['0']) === 13 ){ // ถ้า column แรกมีเลข 13 หลัก
            if( $key > 25 ){
                $sub_key = ($key % 26);
                $main_key = (int) (floor($key / 26) - 1 );
                $final_key = $alphabet[$main_key].$alphabet[$sub_key];

                if( $alphabet[$sub_key] === 'A' ){
                    $col_val = (string) $col_val;
                }
                
                $new_col[$final_key] = $col_val;
                
            }else{
                $get_key = $alphabet[$key];
                if( $get_key === 'A' ){
                    $col_val = (string) $col_val;
                }
                $new_col[$get_key] = $col_val;
            }
        }
    }
    return $new_col;
}

/* แจ้งเตือน เป็น Alert แบบใช้ Javascript */
function js_alert($msg){
    ?>
    <script type="text/javascript">
        alert('<?=$msg;?>');
        window.history.back(-1);
    </script>
    <?php
    exit;
}

/**
 * ค.ศ. เป็น พ.ศ.
 */
if( !function_exists('ad_to_bc') ){
	function ad_to_bc($time = null){
		$time = preg_replace_callback('/^\d{4,}/', 'cal_to_bc', $time);
		return $time;
	}
}

if( !function_exists('cal_to_bc') ){
	function cal_to_bc($match){
		return ( $match['0'] + 543 );
	}
}

/**
 * พ.ศ. เป็น ค.ศ.
 */
if( !function_exists('bc_to_ad') ){
	function bc_to_ad($time = null){
		$time = preg_replace_callback('/^\d{4,}/', 'cal_to_ad', $time);
		return $time;
	}
}

if( !function_exists('cal_to_ad') ){
	function cal_to_ad($match){
		if( intval($match['0']) === 0 ){
			return $match['0'];
		}
		return ( $match['0'] - 543 );
	}
}