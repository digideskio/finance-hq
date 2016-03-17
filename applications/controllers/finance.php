<?php
class Finance extends Controller
{
    // function __construct(){
        
    // }
    
    public function base(){
        
        if( $this->user === false ){
            redirect();
        }
        
        $view = $this->load_view('finance/index');
		$view->render();
    }
    
    public function lists(){
        
        if( $this->user === false OR User_helper::is_admin($this->user) === false){
            redirect();
        }
        
        $date = input_post('date');
        $search = input_post('search');
        
        // ค่าพื้นฐาน
        $def_date = ( $date === false ) ? (date('Y') + 543).date('-m') : $date;
        $def_type = input_post('type', 1);
        $items = false;
        
        if( $search === 'search' ){ // ทำงานตอนมีการคลิก ค้นหาข้อมูล
            $db = $this->load_mongo();
            $items = $db->documents->find(array('date_sheet' => $date, 'type' => $def_type ), array('A','B'));
        }
        
        $view = $this->load_view('finance/lists');
        $data['def_date'] = $def_date;
        $data['def_type'] = (int) $def_type;
        $data['search'] = $search;
        $data['items'] = $items;
        $view->set_val($data);
		$view->render();
    }
    
    public function details($id){
        global $short_months;
        
        if( $this->user === false OR User_helper::is_admin($this->user) === false){
            redirect();
        }
        
        $db = $this->load_mongo();
        $mongoId = new MongoId($id);
        $item = $db->documents->findOne(array('_id' => $mongoId));
        
        // $date = input_etc($date);
        list($y, $m) = explode('-', $item['date_sheet']);
        $top_date = $short_months[$m].' '.$y;
        
        $view = $this->load_view('finance/report_details');
        $view->set_val(array('item' => $item, 'top_date' => $top_date));
		$view->render();
    }
    
    public function form(){
        global $short_months;
        
        if( $this->user === false OR User_helper::is_admin($this->user) === false ){
            redirect();
        }
        
        $view = $this->load_view('finance/form');
        $view->set_val(array('short_months' => $short_months));
		$view->render();
    }
    
    public function save(){
        global $short_months;
        
        if( $this->user === false OR User_helper::is_admin($this->user) === false ){
            redirect();
        }
        
        $date = input_post('date');
        $type = input_post('type');
        $file = $_FILES['file'];
        
        $info = new SplFileInfo($file['name']);
        $ext = $info->getExtension();
        
        // Validation
        if( $type === false ){
            js_alert('กรุณาเลือกประเภทนายทหาร');
        }
        if( $ext !== 'xlsx' AND $ext !== 'xls'){
            js_alert('อนุญาตเฉพาะไฟล์ .xlsx และ ไฟล์ .xls เท่านั้น');
        }
        
        // เคลียร์ข้อมูลเดิม
        $db = $this->load_mongo();
        $db->documents->remove(array('date_sheet' => $date, 'type' => $type));
        
        $time = time();
        $file_path = 'reports/'.$time.'.'.$ext;
        move_uploaded_file($file['tmp_name'], $file_path);

        $Spreadsheet = new Xls($file_path);
        $Sheets = $Spreadsheet->Sheets();

        $items = array();

        $Spreadsheet->ChangeSheet(0);
        foreach ($Spreadsheet as $row => $col){
            
            $new_col = array();
            $data = setCol($col);
            
            if( !empty($data) ){
                $data['date'] = new MongoDate();
                $data['date_sheet'] = $date;
                $data['type'] = $type;
                $data['file_name'] = $file_path;
                
                $db->documents->insert($data);
                
                $items[$row] = $data;
            }
        }
        
        // $date = input_etc($date);
        list($y, $m) = explode('-', $date);
        $top_date = $short_months[$m].' '.$y;
        
        $view = $this->load_view('report');
        $view->set_val(array('items' => $items, 'top_date' => $top_date));
		$view->render();
    }
}