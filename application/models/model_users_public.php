<?php
/*
 * Nama Controller	: Model_user_public
 * Pembuat			: R Yudi Rachmanu
 * Tanggal 			: 
 * Penjelasan		: 
 * 1. User_public login
 * 2. User_public daftar ,
 * 		a. check user yang ada
 *		b. apakah ada bonus quota/tidak , isikan table user_public_quota jika ada
 * 3. User_public approval, aktif atau non aktif
 * 4. User_public approval buying quota and convert the money into quota download
 * 5. User_public historical log activity view, download
 */
class model_users_public extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	//user login handling
	function check_user_public_exist($user_public_id,$password)
	{
		//$password=md5($password);
		$sql="select user_public_name,user_public_id,id_user_group from user_public where user_public_id='".$user_public_id."' and user_public_password='".$password."' and user_public_status='1'";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
	}//end check users exist

	function update_user_password($user_public_id,$password,$password_baru){
		$sql="update user_public set user_public_password='$password_baru'
			where 
				user_public_id='$user_public_id' and  user_public_password='$password'
		";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
	}

	function update_user_penerbit_password($user_public_id,$password,$password_baru){
		$sql="update user_penerbit_issn set issn_password='$password_baru'
			where 
				issn='$user_public_id' and  issn_password='$password'
		";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
	}

	function check_user_penerbit($user_public_id,$password)
	{
		$sql="select distinct from direktori where issn='$user_public_id";
		$query_result=$this->db->query($sql);
		// /echo $sql;
		return $query_result;
	}
	
	//register new member
	function save_user_public($nama_lengkap,$emails,$user_id,$user_groups,$passwords,$kota,$institusi,$jk,$alamat,$hp){
		//$passwords=md5($passwords);
		try {
		$sql="insert into user_public (
				user_public_name
				,user_public_id
				,user_public_password
				,user_public_status
				,saldo_quota_download
				,id_user_group
				,user_public_date_register
				,emails
				,id_kota_kabupaten
				,jenis_kelamin
				,alamat
				,hp
				,institusi
				) values (
				'".$nama_lengkap."'
				,'".$user_id."'
				,'".$passwords."'
				,'0'
				,'5'
				,'".$user_groups."'
				,now()
				,'".$emails."'
				,'".$kota."'
				,'".$jk."'
				,'".$alamat."'
				,'".$hp."'
				,'".$institusi."')";
		//echo $sql;
		$query_result=$this->db->query($sql);
		//$sql="insert into user_public_quota values ('".$user_id."','2',now(),'','0','20','','')";
		//$query_result=$this->db->query($sql);
		} catch( Exception $e ) 
		{
		  echo "friendly error message";
		  logging_function($e->getMessage());
		  throw $e;
	  	}
	}

	//history log 
	function log_user_public_view($user_public_id,$id_jurnal)
	{
		$sql="insert into user_public_view_download (user_public_id,id_jurnal,view_check,download_check) values ('".$user_public_id."','".$id_jurnal."','1','0')";
		$query_result=$this->db->query($sql);
		//echo $sql;
	}
	function check_user_public_quota($user_public_id)
	{
		$sql="select user_public_name,user_public_id,saldo_quota_download from user_public where user_public_id='".$user_public_id."'";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
	}
	
	function get_detail_quota_approval(){

		$sql="select * from user_public_quota where approval_convert_by is null or approval_convert_by=''";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;

	}

	// kuota handle members side
	function show_kuota($user_id){
		$sql="select * from user_public_quota where user_public_id='".$user_id."'";
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}

	function show_saldo_kuota($user_id){
		$sql="select * from user_public where user_public_id='".$user_id."'";
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}

	function save_temp_upload($user_id,$path){
		$sql="insert into user_public_quota 
		(
			user_public_id,
			bonus_or_not,
			date_transfer,
			path_bukti_transfer,
			nominal_transfer,
			transfer_convert_quota,
			date_approval_convert,
			approval_convert_by
			)values ('".$user_id."','0',now(),'".$path."','0','0','','')";
		$query_result=$this->db->query($sql);
		return $query_result;

	}

	function cleanup_kuota_temp($user_public_id){
		$sql="delete from user_public_quota
where user_public_id='$user_public_id' and bonus_or_not=0 and nominal_transfer=0 and transfer_convert_quota=0";

$query_result=$this->db->query($sql);
		return $query_result;

	}

	function update_kuota_info($nominal_transfer,$konversidownload,$user_public_id,$kodeuploads){
		$sql="
		update user_public_quota
		set
			nominal_transfer='$nominal_transfer'
			,transfer_convert_quota='$konversidownload'
		where
			user_public_id='$user_public_id'
			and bonus_or_not='0'
			and path_bukti_transfer like '%$kodeuploads%'
		";
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;

	}

	function get_used_kuota_per_user($user_public_id){
		$sql="
			select count(*) jum_used_kuota 
			from user_public_view_download
where user_public_id='$user_public_id' and download_check is not null
		";
		$query_result=$this->db->query($sql);
		return $query_result;

	}//end of function get_used_kuota_per_user

	// members log histori
	function get_log_view_download($keyword_text='All')
	{
		
		$user_public_id=$this->session->userdata('user_public_id');
		
		if ($user_public_id==NULL){
			$user_public_id='0';
		}

		$sql="select a.*,b.title from user_public_view_download a,jurnal b
where a.id_jurnal=b.id_jurnal and user_public_id='$user_public_id' ";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" and title REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}
		
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_log_view_download_per_page($limit,$offset,$keyword_text='All')
	{
		$user_public_id=$this->session->userdata('user_public_id');
		if ($user_public_id==NULL){
			$user_public_id='0';
		}

		$sql="select a.*,b.title from user_public_view_download a,jurnal b
where a.id_jurnal=b.id_jurnal and user_public_id='$user_public_id' ";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" and title REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}
		$sql .=" LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}

	//members komplain user

	function get_log_komplain($keyword_text='All')
	{
		$user_public_id=$this->session->userdata('user_public_id');
		if ($user_public_id==NULL){
			$user_public_id='0';
		}
		$sql="select * from user_complain where user_public_id='$user_public_id'";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" and complain_description REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}
		$sql .=" order by tanggal_complain desc";
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_log_komplain_per_page($limit,$offset,$keyword_text='All')
	{
		$user_public_id=$this->session->userdata('user_public_id');
		if ($user_public_id==NULL){
			$user_public_id='0';
		}
		$sql="select * from user_complain where user_public_id='$user_public_id'";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" and complain_description REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}
		$sql .=" order by tanggal_complain desc";
		$sql .=" LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function save_komplain($comment,$user_public_id){
		$sql="insert into user_complain 
		(
		user_public_id
		,complain_description
		,status_complain
		,tanggal_complain
		)
		values (
		'".$user_public_id."'	
		,'".$comment."'
		,'0'
		,now()
			)";
		$query_result=$this->db->query($sql);
		return $query_result;

	}

	function save_komplain_detail($comment_complain,$user_public_id,$statuskomplain,$id_user_complain){

		$sql="insert into user_complain_thread 
		(
			id_user_complain
			,deskripsi_thread
			,tanggal_thread
			,action_to_status
			,user_public_id
		)
			values(
			'".$id_user_complain."'
			,'".$comment_complain."'
			,now()
			,'".$statuskomplain."'
			,'".$user_public_id."'
				)

		";

		//echo $sql;
		$query_result=$this->db->query($sql);
		
		$sql="update user_complain
		set 
		tanggal_akhir_thread=now()
		,status_complain='".$statuskomplain."'
		where id_user_complain='".$id_user_complain."'";
		$query_result=$this->db->query($sql);
		echo $sql;
		return $query_result;
	}//end of function save_komplain_detail

	function get_log_komplain_detail($keyword_text='All',$id_user_complain)
	{
		$user_public_id=$this->session->userdata('user_public_id');
		if ($user_public_id==NULL){
			$user_public_id='0';
		}
		$sql="select * from user_complain_thread where id_user_complain='$id_user_complain'";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" and deskripsi_thread REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}
		$sql .=" order by tanggal_thread desc";
		echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	
	function get_log_komplain_detail_per_page($limit,$offset,$keyword_text='All',$id_user_complain)
	{
		$user_public_id=$this->session->userdata('user_public_id');
		if ($user_public_id==NULL){
			$user_public_id='0';
		}
		$sql="select * from user_complain_thread where id_user_complain='$id_user_complain'";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" and deskripsi_thread REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}
		$sql .=" order by tanggal_thread desc";
		$sql .=" LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	// user penerbit dengan menggunakan field issn table direktori
	function get_user_issn($user_public_id){
		$sql="select * from (
select distinct issn from direktori
where issn='$user_public_id'
) a left join user_penerbit_issn b
on a.issn=b.issn";
		$query_result=$this->db->query($sql);
		return $query_result;

	}

	function insert_password_issn($user_public_id,$password){
		$sql="insert into  user_penerbit_issn values('$user_public_id','$password')";
		$query_result=$this->db->query($sql);
		return $query_result;		
	}

	function check_user_penerbit_exist($user_public_id,$password){
		$sql="select * from user_penerbit_issn where issn='$user_public_id' and issn_password='$password'";
		$query_result=$this->db->query($sql);
		return $query_result;	
	}

	function get_user_public_all()
	{
		$sql="select count(*) total_users from user_public";
		$query_result=$this->db->query($sql);
		return $query_result;		
	}

	function get_count_user_public_group ()
	{
		$sql="select a.*,b.user_group from (
select count(*) jum_user,id_user_group from user_public a
group by id_user_group
) a,user_group b
where a.id_user_group=b.id_user_group";
			$query_result=$this->db->query($sql);
		return $query_result;		
	}


	
}// end of class
?>