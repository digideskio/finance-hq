<?php
/**
 *
 */
class Mainpage extends Controller
{

	function base()
	{
		$view = $this->load_view('mainpage');
		$view->render();
	}
    
    function search(){
        global $full_months;
        $idcard = input_post('idcard');
        $match_test = preg_match('/(\d+){13,}/', $idcard, $match);
        
        if( $match_test > 0 ){
            $idcard = $match['0'];
        }else{
            redirect('mainpage' ,'เลขบัตรประชาชนไม่ถูกต้อง');
        }
        
        $db = $this->load_mongo();
        $items = $db->documents->find(array('A' => $idcard), array('date_sheet'));
        
        $view = $this->load_view('user/receipt_list');
        $view->set_val(array('items' => $items, 'months' => $full_months));
        $view->render();
        
    }
    
    public function details($id){
        global $short_months;
        
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

	function login(){

		if( $this->user === true ){
			$this->redirect('hellos');
		}

		$db = $this->load_db();
		$sql = "SELECT * FROM `inputm`
		WHERE `idname` = :test_idname
		AND `pword` = :test_pword
		AND `status` = 'y'";
		$db->select($sql, array(':test_idname' => $_POST['username'], ':test_pword' => $_POST['password']));
		$user = $db->get_item();

		if($user !== false){

			$_SESSION['sIdname'] = $user['idname'];
			$_SESSION['sPword'] = $user['pword'];
			$_SESSION['smenucode'] = $user['menucode'];
			$_SESSION['sOfficer'] = $user['name'];
			$_SESSION['sRowid'] = $user['row_id'];
			$_SESSION['sLevel'] = $user['level'];

			$this->redirect('hellos');
		}
	}

    public function show(){

        $file = $_FILES['file'];
        $info = new SplFileInfo($file['name']);
        $ext = $info->getExtension();
        
        if( $ext !== 'xlsx' AND $ext !== 'xls'){
            redirect('', 'อนุญาตเฉพาะไฟล์ .xlsx และ ไฟล์ .xls เท่านั้น');
        }

        $file_path = 'reports/'.$file['name'];
        move_uploaded_file($file['tmp_name'], $file_path);

        $Spreadsheet = new Xls($file_path);
        $Sheets = $Spreadsheet->Sheets();

        $items = array();

        $Spreadsheet->ChangeSheet(0);
        foreach ($Spreadsheet as $row => $col){
            
            $new_col = array();
            $col = setCol($col);
            $items[$row] = $col;
        }

        $view = $this->load_view('report');
        $view->set_val(array('items' => $items));
        $view->render();

    }
}
