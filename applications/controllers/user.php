<?php
class User extends Controller{
    
    public function base(){
        
    }
    
    public function form(){
        
        if( $this->user !== false ){
            redirect('finance');
        }
        
        $view = $this->load_view('user/form');
		$view->render();
    }
    
    public function login(){
        global $config;
        
        $username = input_post('username');
        $password = input_post('password');
        
        $db = $this->load_mongo();
        $collection = $db->users;
        
        $pass = hash('sha256', $config['salt'].$password);
        
        $item = $collection->findOne(array('username' => $username, 'password' => $pass));
        if( !is_null($item) ){
            
            if( $item['status'] !== 'approve' ){
                redirect('user/form', 'ผู้ใช้งานนี้ ยังไม่ผ่านการอนุมัติ กรุณาโทรแจ้งเบอร์ 6203 เพื่อทำการอนุมัติก่อนเข้าใช้งาน');
            }
            
            $_SESSION['_id'] = $item['_id']->{'$id'};
        }else{
            redirect('user/form', 'ไม่พบผู้ใช้งานในระบบ กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง');
        }
        
        redirect();
        
    }
    
    public function logout(){
        Session_helper::destroy();
        redirect();
    }
    
    public function register_form(){
        global $ranks;
        if( $this->user !== false ){
            redirect('finance');
        }
        
        $view = $this->load_view('user/register_form');
        $view->set_val(array('ranks' => $ranks));
		$view->render();
    }
    
    public function register(){
        global $config;
        
        $username = input_post('username');
        $password = input_post('password');
        $confirm_password = input_post('confirm_password');
        $idcard = input_post('idcard');
        $rank = input_post('rank');
        $firstname = input_post('firstname');
        $lastname = input_post('lastname');
        
        $db = $this->load_mongo();
        
        if( $idcard === false ){
            js_alert('กรุณากรอกเลขบัตรประจำตัวประชาชนให้ถูกต้อง');
        }else{
            $fid = $db->users->findOne(array('idcard' => $idcard), array('idcard'));
            if( $fid['idcard'] === $idcard ){
                js_alert('เลขบัตรประชาชนซ้ำ กรุณาเลือกใหม่');
            }
        }
        if( $rank === false ){
            js_alert('กรุณาเลือกยศ');
        }
        if( $firstname === false ){
            js_alert('กรุณากรอกชื่อ');
        }
        if( $lastname === false ){
            js_alert('กรุณากรอกนามสกุล');
        }
        if( $username === false ){
            js_alert('กรุณากรอกชื่อผู้ใช้งาน');
        }else{
            $fuser = $db->users->findOne(array('username' => $username), array('username'));
            if( $fuser['username'] === $username ){
                js_alert('ชื่อผู้ใช้งานซ้ำ กรุณาเลือกใหม่');
            }
        }
        if( ($password !== $confirm_password) OR ($password === false OR $confirm_password === false) ){
            js_alert('กรุณากรอกรหัสผ่านให้ถูกต้อง');
        }
        
        $date = new MongoDate();
        $pass = hash('sha256', $config['salt'].$password);
        
        $data = array(
            'username' => $username,
            'password' => $pass,
            'idcard' => $idcard,
            'rank' => $rank,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'date' => $date->sec,
            'status' => 'not_approve',
            'level' => 'user'
        );
        $db->users->insert($data);
        redirect('user/register_form', 'สมัครสมาชิกเรียบร้อย');
    }
    
    public function approve(){
        
        $db = $this->load_mongo();
        $users = $db->users->find(array(), array('rank','firstname','status'))->sort(array('_id' => -1));
        $view = $this->load_view('user/approve');
        $view->set_val(array('users' => $users));
		$view->render();
    }
    
    public function lists(){
        
        if( $this->user === false ){
            redirect();
        }
        
        $idcard = $this->user->idcard;
        
        $db = $this->load_mongo();
        $items = $db->documents
            ->find(array('A' => $idcard ), array('A','B','date_sheet'))
            ->sort(array('_id' => -1));
        $view = $this->load_view('user/lists');
        $view->set_val(array('items' => $items));
		$view->render();
    }
    
    public function report($date){
        global $short_months;
        // ให้ front ยืมการแสดงผลหน้านี้ไปก่อน
        // if( $this->user === false ){
        //     redirect();
        // }
        
        $date = input_etc($date);
        list($y, $m) = explode('-', $date);
        $top_date = $short_months[$m].' '.$y;
        
        $idcard = $this->user->idcard;
        $db = $this->load_mongo();
        
        $item = $db->documents->findOne(array('A' => $idcard, 'date_sheet' => $date ));
        
        $view = $this->load_view('finance/report_details');
        $view->set_val(array('item' => $item, 'top_date' => $top_date));
		$view->render();
    }
}