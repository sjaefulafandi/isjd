<?php
/*
 * Nama Controller	: Model_user_public
 * Pembuat			: R Yudi Rachmanu
 * Tanggal 			: 
 * Penjelasan		: 
 * 1. 
 */
class model_referensi extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	function save_tarif_download($harga,$konversidownload,$selgroupmember,$optjenistarif,$status_tarif)
	{
		$sql="
			insert into tarif_download (
				id_user_group,
				jenis_tarif,
				harga,
				harga_to_download,
				status_tarif,
				tanggal_update
				) values (
				'".$selgroupmember."'
				,'".$optjenistarif."'
				,'".$harga."'
				,'".$konversidownload."'
				,'".$status_tarif."'
				,now()
				)
		";
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_tarif_download($harga,$konversidownload,$selgroupmember,$optjenistarif,$jenis_cari)
	{
		if ($jenis_cari==1){
		$sql="select * 
			from 
			tarif_download 
			where 
			id_user_group='$selgroupmember' 
			and jenis_tarif='$optjenistarif'
			and harga='$harga'
			and harga_to_download='$konversidownload'
			and status_tarif=1 
			";

		}else{
			$sql="select * 
			from 
			tarif_download 
			where 
			id_user_group='$selgroupmember' 
			and jenis_tarif='$optjenistarif' 
			and status_tarif=1
			";		
		}

		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function update_tarif_download_default($id_tarif_download)
	{
		$sql="update tarif_download
		set
		status_tarif=0
		where
		id_tarif_download='$id_tarif_download'";
		$query_result=$this->db->query($sql);
		return $query_result;
	}

	function show_tarif($aktif_tarif,$id_user_group=NULL,$id_tarif_download=NULL){
		$sql="
			select a.*,b.user_group 
				from 
			tarif_download a, user_group b
			where 
			a.id_user_group=b.id_user_group";
		
		$sql .=" and a.status_tarif='$aktif_tarif'";
		
		if ($id_user_group <> NULL)
		{
			$sql .=" and a.id_user_group='$id_user_group'";	
		}

		if ($id_tarif_download <> NULL)
		{
			$sql .=" and a.id_tarif_download='$id_tarif_download'";	
		}
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;	
		return $query_result;	
	}

	//show kota kabupaten
	function show_kota_kabupaten($q){
		
		$sql="select * from kabupaten_kota where kabupaten_kota like '%$q%'";
		$query_result=$this->db->query($sql);
		return $query_result;		

	}

	//show user group 
	function get_user_group($id_user_group=NULL){

		$sql="select * from user_group ";
		if ($id_user_group <> NULL){
		$sql .=" where id_user_group='$id_user_group'";
		}
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;	
	}

	function save_group_user($nama_group_user){
		$sql="insert into user_group (user_group) values ('".$nama_group_user."')";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;	
	}
	
	function get_kota(){
		$sql="select * from kabupaten_kota";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;	
	}
	function save_kota($nama_kota){
		$sql="insert into kabupaten_kota (kabupaten_kota) values ('".$nama_kota."')";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;	
	}
	// penerbit
	function get_penerbit($keyword_text='All'){
		$sql="select * from user_penerbit ";
		if($keyword_text<>'All')
		{
			$sql.=" where penerbit like '%$keyword_text%'";
		}
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;	
	}

	function get_penerbit_per_page($limit,$offset,$keyword_text='All'){
		$sql="select * from user_penerbit ";
		if($keyword_text<>'All')
		{
			$sql.=" where penerbit like '%$keyword_text%' ";
		}
		$sql .="LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function save_penerbit($nama_penerbit){
		$sql="insert into user_penerbit (penerbit,user_id_penerbit_default) values ('".$nama_penerbit."',lpad(LAST_INSERT_ID()+1,6,'0'));";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;	
	}

	
}
?>