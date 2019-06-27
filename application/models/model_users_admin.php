<?php
/*
 * Nama Controller	: model_user_aadmin
 * Pembuat			: R Yudi Rachmanu
 * Tanggal 			: 
 * Penjelasan		: 
 * Note 			:
 * - need check user admin session, to prevent blank data for the user_approval information
 * mohon perbaiki , untuk create kuota automatic user, ketika user daftar dia langsung create user histori
 */
class model_users_admin extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function check_user_admin($user_id,$passwords)
	{
		$passwords=md5($passwords);
		$sql="select * from user where id_user='".$user_id."' and password='".$passwords."'";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
	}//end check users exist
	
	function get_max_download_group($group_id)
	{
    $sql="SELECT id_user_group,max(harga_to_download) download_count FROM `tarif_download` 
WHERE status_tarif=1 and id_user_group=$group_id 
group by  id_user_group";
	$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
  }
  function get_user_public_need_approve_detail($user_id)
  {
  	$sql="select * from user_public where user_public_number=$user_id";
		$query_result=$this->db->query($sql);
		return $query_result;
  }

	function find_user_public_need_approve(){
		$sql="select a.*,b.kabupaten_kota from user_public a left join kabupaten_kota b
on a.id_kota_kabupaten=b.id_kabupaten_kota where a.user_public_status=0";
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	
	function user_public_approve($user_id,$user_approval){

    $q_user_id=$this->get_user_public_need_approve_detail($user_id);
     $q_row=$q_user_id->row();
     /*
       kuoat download masa promosi akan mengambil dari kuota yang ditetapkan terhadap group tersebut 
       dengan besaran kuoata tertinggi
     */
     $q_downloads_value=$this->get_max_download_group($q_row->id_user_group);
     $q_downloads_row=$q_downloads_value->row();
     
     
      $date=date_create($this->config->item('start_free_date'));
		  $date2=date_create(date('Y-m-d'));
		  $interval = date_diff($date, $date2);
		  if ($interval->format('%a') < $this->config->item('free_days'))
		  {
        $kuota_download=$q_downloads_row->download_count;
           
      }else
      {
        $kuota_download=$this->config->item('kuota_download_normal');
      }
         
     
		//approve new user login
		$sql="update user_public 
		set 
		user_public_status='1'
		,user_public_date_approve=now()
		,user_public_approve_by='".$user_approval."'
		,saldo_quota_download='".$kuota_download."'
		where
		user_public_number='".$user_id."'
		";
		$query_result=$this->db->query($sql);
		
		//approve new user quota 
		 
     

		$sql2="insert into  user_public_quota 
		( 
			
			user_public_id,
			bonus_or_not,
			date_transfer,
			nominal_transfer,
			transfer_convert_quota,
			date_approval_convert,
			approval_convert_by
		)
		values
		(
			'".$user_id."',
			'2',
			now(),
			'0',
			'".$kuota_download."',
			now(),
			'".$user_approval."'
		)";
		$query_result=$this->db->query($sql2);
		//echo $sql2;

	}
	function user_public_not_approve($user_id,$user_approval){

   
	 $sql2="delete from user_public where user_public_number= $user_id";
	 $query_result=$this->db->query($sql2);
	 return $query_result;
	 
     /*
       kuoat download masa promosi akan mengambil dari kuota yang ditetapkan terhadap group tersebut 
       dengan besaran kuoata tertinggi
     
     $q_downloads_value=$this->get_max_download_group($q_row->id_user_group);
     $q_downloads_row=$q_downloads_value->row();
     
     
      $date=date_create($this->config->item('start_free_date'));
		  $date2=date_create(date('Y-m-d'));
		  $interval = date_diff($date, $date2);
		  if ($interval->format('%a') < $this->config->item('free_days'))
		  {
        $kuota_download=$q_downloads_row->download_count;
           
      }else
      {
        $kuota_download=$this->config->item('kuota_download_normal');
      }
         
     
		//approve new user login
		$sql="update user_public 
		set 
		user_public_status='1'
		,user_public_date_approve=now()
		,user_public_approve_by='".$user_approval."'
		,saldo_quota_download='".$kuota_download."'
		where
		user_public_number='".$user_id."'
		";
		$query_result=$this->db->query($sql);
		
		//approve new user quota 
		 
     

		$sql2="insert into  user_public_quota 
		( 
			
			user_public_id,
			bonus_or_not,
			date_transfer,
			nominal_transfer,
			transfer_convert_quota,
			date_approval_convert,
			approval_convert_by
		)
		values
		(
			'".$user_id."',
			'2',
			now(),
			'0',
			'".$kuota_download."',
			now(),
			'".$user_approval."'
		)";
		$query_result=$this->db->query($sql2);
		//echo $sql2;
*/
	}
	
	// update kuota dispute
	function save_user_public_kuota_dispute($kuota,$tb,$user_public_id,$user_approval){
		
		$sql2="insert into  user_public_quota 
		( 
			
			user_public_id,
			bonus_or_not,
			date_transfer,
			nominal_transfer,
			transfer_convert_quota,
			date_approval_convert,
			approval_convert_by
		)
		values
		(
			'".$user_public_id."',
			'1',
			now(),
			'0',
		";
		if ($tb=='positif'){
			$sql2 .="'".$kuota."',";
		}else{
			$sql2 .="'-".$kuota."',";
		}
			$sql2.=" now(),'".$user_approval."')";
		
		$query_result=$this->db->query($sql2);

		$sql="update user_public set ";
		if ($tb=='positif'){
			$sql .="saldo_quota_download=saldo_quota_download + ".$kuota;
		}else{
			$sql .="saldo_quota_download=saldo_quota_download - ".$kuota;
		}

		$sql .=" where user_public_id='".$user_public_id."'";
		$query_result=$this->db->query($sql);

	}
	//update user transaksi
	function update_user_public_quota($id_user_public_quota,$user_approval)
	{
		$sql="update user_public_quota set date_approval_convert=now() , approval_convert_by='$user_approval'
		where id_user_public_quota=$id_user_public_quota
		";
		$query_result=$this->db->query($sql);
		
		$sql="update user_public
set saldo_quota_download=saldo_quota_download+(select transfer_convert_quota from user_public_quota where id_user_public_quota=$id_user_public_quota)
where user_public_id=(select user_public_id from user_public_quota where id_user_public_quota=$id_user_public_quota)
		";
		$query_result=$this->db->query($sql);
		

		//return $query_result;
	}

	function kuota_transfer($tanggal_start,$tanggal_end,$group_user){
		$sql="select a.*,b.id_user_group from user_public_quota  a,user_public b
where 
	a.user_public_id=b.user_public_id";
	if ($group_user!=0){
	$sql .=" and b.id_user_group=$group_user";
	}
	$sql .=" and a.bonus_or_not='0'"; 
	$sql .=" and a.date_approval_convert between '".$tanggal_start."' and '".$tanggal_end."'";
		//echo $sql;
		$query_result=$this->db->query($sql);

		return $query_result;
	}

	function get_user_public(){
		$sql="select a.*,b.user_group from (select a.*,b.kabupaten_kota from user_public a left join kabupaten_kota b
on a.id_kota_kabupaten=b.id_kabupaten_kota ) a, user_group b
where a.id_user_group=b.id_user_group";
		$query_result=$this->db->query($sql);
		return $query_result;

	}

	function xls_user_public_all(){
		$sql="select 
			user_public_id as member_id,
			user_public_name as nama_lengkap,
			user_public_date_register as tanggal_daftar

			from user_public
			";
		$query_result=$this->db->query($sql);
		return $query_result;		
	}

	//komplain
	function get_amount_open_komplain(){
		$sql="select * from user_complain where status_complain=0";
		$query_result=$this->db->query($sql);
		return $query_result;	
	}

	function get_log_komplain($keyword_text,$status)
	{
		
		$sql="select * from user_complain ";
		if ($status<>'All') {
			$sql .=" where status_complain=$status";
		}else{
			$sql .=" where (status_complain=1 or status_complain=0) ";
		}

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
	function get_log_komplain_per_page($limit,$offset,$keyword_text,$status)
	{
		
		$sql="select * from user_complain ";
		if ($status<>'All') {
			$sql .=" where status_complain=$status";
		}else{
			$sql .=" where (status_complain=1 or status_complain=0) ";
		}
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
		//echo $sql;
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

	function save_admin_komplain_detail($comment_complain,$user_id,$statuskomplain,$id_user_complain){

		$sql="insert into user_complain_thread 
		(
			id_user_complain
			,deskripsi_thread
			,tanggal_thread
			,action_to_status
			,user_admin_response
		)
			values(
			'".$id_user_complain."'
			,'".$comment_complain."'
			,now()
			,'".$statuskomplain."'
			,'".$user_id."'
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
		//echo $sql;
		return $query_result;
	}//end of function save_komplain_detail

	function range_jum_download($tanggal_start,$tanggal_end){
		$sql="
		select count(*) jum_download,date_format(download_check,'%Y-%m-%d') tanggal,user_public_id from user_public_view_download
where download_check is not null
and date_format(download_check,'%Y-%m-%d') between '".$tanggal_start."' and '".$tanggal_end."'
group by user_public_id,date_format(download_check,'%Y-%m-%d')
		";
		// echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;

	}


function range_jum_user($tanggal_start,$tanggal_end,$group_user){
	$sql =" select sum(jum_user_public_laki) jum_user_public_laki,sum(jum_user_public_perempuan) jum_user_public_perempuan,tanggal from (";
	$sql .="select count(*) jum_user_public_laki,0 jum_user_public_perempuan,date_format(user_public_date_register,'%Y-%m-%d') tanggal 
		from user_public a where ";
	
	$sql .=" a.user_public_date_register between '".$tanggal_start."' and '".$tanggal_end."'";
	$sql .=" and jenis_kelamin='L' ";
	if ($group_user!=0){
	$sql .=" and a.id_user_group=$group_user";
	}
	$sql .=" group by date_format(user_public_date_register,'%Y-%m-%d')";
	$sql .=" union ";
	$sql .="select 0 jum_user_public,count(*) jum_user_public_perempuan,date_format(user_public_date_register,'%Y-%m-%d') tanggal 
		from user_public a where ";
	
	$sql .=" a.user_public_date_register between '".$tanggal_start."' and '".$tanggal_end."'";
	$sql .=" and jenis_kelamin='P' ";
	if ($group_user!=0){
	$sql .=" and a.id_user_group=$group_user";
	}
	$sql .=" group by date_format(user_public_date_register,'%Y-%m-%d')";
	$sql .=") a group by tanggal";
		

		//echo $sql;
		$query_result=$this->db->query($sql);

		return $query_result;
	}

function range_jum_user_kota($tanggal_start,$tanggal_end,$group_user){
		$sql="select a.*,kabupaten_kota from (select count(*) jum_user_public,id_kota_kabupaten
		from user_public a where ";
	
	$sql .=" a.user_public_date_register between '".$tanggal_start."' and '".$tanggal_end."'";
	if ($group_user!=0){
	$sql .=" and a.id_user_group=$group_user";
	}
	$sql .=" group by a.id_kota_kabupaten ) a , kabupaten_kota b where a.id_kota_kabupaten=b.id_kabupaten_kota";
		//echo $sql;
		$query_result=$this->db->query($sql);

		return $query_result;
	}

	function range_jum_artikel_download($tanggal_start,$tanggal_end){
		//-- date_format(download_check,'%Y-%m-%d') tanggal,
		
		$sql="
		select sum(jum_download) jum_download,sum(jum_baca) jum_baca,a.id_jurnal,b.title from (
		select count(*) jum_download,0 jum_baca,
		id_jurnal 
		from user_public_view_download
		where download_check is not null
		and date_format(download_check,'%Y-%m-%d') between trim('".$tanggal_start."') and trim('".$tanggal_end."')
		group by id_jurnal
		union
		select 0 jum_download,count(*) jum_baca,
		id_jurnal 
		from user_public_view_download
		where view_check is not null
		and date_format(view_check,'%Y-%m-%d') between trim('".$tanggal_start."') and trim('".$tanggal_end."')
		group by id_jurnal
		
		) a,jurnal b
		where a.id_jurnal=b.id_jurnal
		group by a.id_jurnal,b.title
		";
		// echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;

	}

	function get_user_pasif($group_user)
	{
		$sql="select a.*,b.user_public_name,b.alamat,b.emails 
		from user_public_quota a,user_public b
		where date_approval_convert is not null and a.user_public_id=b.user_public_id";

		if ($group_user!=0){
		$sql .=" and id_user_group='$group_user'";
		}

		$sql .=" group by user_public_id having count(*)=1";
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	

}
?>