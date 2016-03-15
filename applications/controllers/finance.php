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
        $def_date = ( $date === false ) ? (date('Y') + 543).date('-m') : $date;
        $items = false;
        if( $search === 'search' ){
            $db = $this->load_mongo();
            $items = $db->documents->find(array('date_sheet' => $date), array('A','B'));
        }
        
        $view = $this->load_view('finance/lists');
        $data['def_date'] = $def_date;
        $data['search'] = $search;
        $data['items'] = $items;
        $view->set_val($data);
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
        
        if( $this->user === false OR User_helper::is_admin($this->user) === false ){
            redirect();
        }
        
        $date = input_post('date');
        $type = input_post('type');
        
        $file = $_FILES['file'];
        
        $info = new SplFileInfo($file['name']);
        $ext = $info->getExtension();
        
        if( $ext !== 'xlsx' AND $ext !== 'xls'){
            js_alert('อนุญาตเฉพาะไฟล์ .xlsx และ ไฟล์ .xls เท่านั้น');
        }
        
        $time = time();
        $file_path = 'reports/'.$time.'.'.$ext;
        move_uploaded_file($file['tmp_name'], $file_path);

        $Spreadsheet = new Xls($file_path);
        $Sheets = $Spreadsheet->Sheets();

        $items = array();

        $Spreadsheet->ChangeSheet(0);
        $db = $this->load_mongo();
        foreach ($Spreadsheet as $row => $col){
            
            $new_col = array();
            $data = setCol($col);
            
            if( !empty($data) ){
                $data['date_sheet'] = $date;
                $data['type'] = $type;
                $data['file_name'] = $file_path;
                
                $db->documents->insert($data);
                
                $items[$row] = $data;
            }
        }
        
        $view = $this->load_view('report');
        $view->set_val(array('items' => $items));
		$view->render();
    }
}