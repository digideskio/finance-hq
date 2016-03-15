<?php
/**
 *
 */
class Mainpage extends Controller
{

	function base()
	{
		// var_dump($this->user);
		// exit;
		// if( $this->user === false ){
		// 	$view = $this->load_view('mainpage');
		// 	$view->render();
		// 	exit;
		// }else{
		// 	$this->redirect('hellos');
		// }
		$view = $this->load_view('mainpage');
		$view->render();
		// exit;
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
