<?php
/**
 * 
 */
class User_helper 
{
	public function check_session(){
		$id = Session_helper::get('_id');
		if( !isset($id) OR $id === false ){
			return false;
		}else{
            $db = ModelMongo::getMongo();
            $user = $db->users->findOne(
                array('_id' => new MongoId($id)),
                array('idcard','rank','firstname','level')
            );
            $userObj = new stdClass();
            foreach( $user as $key => $val ){
                $userObj->$key = $val;
            }
            return $userObj;
        }
	}
    
    public static function is_admin($user){
        $level = $user->level;
        return ( $level === 'admin' OR $level === 'super admin' ) ? true : false ;
    }
}
