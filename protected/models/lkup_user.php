<?php


class lkup_user extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'mas_user';
	}
	
    public function attributeLabels() {
        return array(
        );
    }
	
	public function search($keyword=null) 
	{
		$sqlCon="";
			if($keyword!=''){
				$sqlCon.= " and (a.username like '%".$keyword."%') ";
			}
		
		$count=Yii::app()->db->createCommand("select count(*) from mas_user a left join mas_userlevel b on a.userlevel_id=b.id where a.status!=0 ".$sqlCon)->queryScalar();
		$sql ="select a.id, ";
		$sql.="replace(a.username,'\\\','') as username, ";
		$sql.="replace(a.displayname,'\\\','') as displayname ";
		$sql.="from mas_user a ";
		$sql.="left join mas_userlevel b on a.userlevel_id=b.id ";
		$sql.="where a.status!=0 ".$sqlCon ;
		return new CSqlDataProvider($sql, array(
			'totalItemCount'=>$count,
			'sort'=>array(
				'attributes'=>array(
					 'id', 'username','displayname',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['prg_ctrl']['pagination']['default']['pagesize'],
			),
		));	
    }		
	
	public function getUsername($username = null)
	{
	   	$sql="select  UserName, FirstNameTH, UMLevelID, StatusData from tran_employee where username='".$username."' and StatusData=1";	   
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	
	public function getUserid($id = null)
	{
		$sql="select a.em_per_id,a.em_email,a.em_work_status,a.em_username,a.em_citizen_id,a.em_name_th,a.em_surname_th,e.ug_name,a.em_name_en,a.em_surname_en,a.em_birthday,b.DeptNameTH,b.DeptID,d.PositLevelNameTH,c.PositNameTH,a.um_position_id,a.mas_position_le_id from um_employee a left join mas_department b on a.mas_department_id = b.DeptID left join mas_position c on a.um_position_id = c.PositID left join mas_position_le d on a.mas_position_le_id = d.PositLevelID ";
		$sql.="left join mas_user_group e on a.um_user_group_id = e.ug_id where a.em_username ='".$id."'";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		return $rows;
	}
	public function getuserdata()
	{
	   	$sql="select a.id,a.position,a.firstname,a.username,b.name,a.email,a.ssopersonbirthdate ,a.pid ,c.id as id_position from mas_user a left join mas_department b on a.dep_id = b.id left join mas_groupposition c on a.id = c.id_user  where  a.status=1";	   
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	public function getUserposition($id = null)
	{
	   	$sql="select  a.name, b.name_position from mas_groupposition a left join mas_position b on a.id_position = b.id where a.id='".$id."' and a.status=1 and b.status=1";	   
	   	$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	public function userall()
	{
		
		$sql="select a.em_id,a.em_per_id,a.em_email,a.em_work_status,a.em_username,a.em_citizen_id,a.em_name_th,a.em_surname_th,a.em_name_en,a.em_surname_en,a.em_birthday,b.DeptNameTH,c.PositNameTH,d.PositLevelNameTH,e.ug_id,e.ug_name ";
		$sql.="from um_employee a inner join mas_department b on a.mas_department_id = b.DeptID inner join mas_position c on a.um_position_id = c.PositID inner join mas_position_le d on a.mas_position_le_id = d.PositLevelID inner join mas_user_group e on a.um_user_group_id=e.ug_id ";
		$sql.="where a.um_data_complete_id = 1 and a.em_status=1";	 
	//	$sql="select * from um_employee where em_username='".$id."'";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
	}
	public function group_user()
	{
		$sql="select ug_name,ug_id from mas_user_group ";
		$sql.="where ug_status = 1";	 
	//	$sql="select * from um_employee where em_username='".$id."'";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
		
	   	return $rows;
	}
	public function useredit($id)
	{ 
		$sql="select a.em_id,a.em_per_id,a.em_email,a.um_user_group_id,a.em_work_status,a.em_username,a.em_workactive_date,a.em_image,a.em_citizen_id,a.em_name_th,a.em_surname_th,a.em_name_en,a.em_surname_en,a.em_birthday,b.DeptNameTH,c.PositNameTH,d.PositLevelNameTH,e.ug_id,e.ug_name,f.pf_name,f.pf_description,g.ut_name,a.em_work_status ";
		$sql.="from um_employee a inner join mas_department b on a.mas_department_id = b.DeptID inner join mas_position c on a.um_position_id = c.PositID inner join mas_position_le d on a.mas_position_le_id = d.PositLevelID inner join mas_user_group e on a.um_user_group_id=e.ug_id inner join mas_user_type g on a.mas_user_type_id=g.ut_id ";
		$sql.="inner join mas_prefix f on a.mas_prefix_id=f.pf_id ";
		$sql.="where a.um_data_complete_id = 1 and a.em_status=1 and em_id=".$id;	 
	//	$sql="select * from um_employee where em_username='".$id."'";
		$rows =Yii::app()->db->createCommand($sql)->queryAll();
	   	return $rows;
		
	}
	
}	
