<?php
class Help extends Controller{
    
    // การตั้งค่าหน้ากระดาษ
    public function base(){
        $view = $this->load_view('help/index');
		$view->render();
    }
    
}