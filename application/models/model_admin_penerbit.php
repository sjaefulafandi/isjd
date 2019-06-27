<?php
/*
 * Nama			: Artikel
 * Tanggal		: 4 mei 2015
 * Pembuat		: R Yudi Rachmanu
 *
 * Description :
 * tabel jurnal , itu berisi artikel 
 * tabel direktori yang merupakan penampung informasi jurnal 
 * jumlah baca jurnal , dilihat dari jumlah artikel yang dibaca
 *  */
class model_admin_penerbit extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$db_debug=$this->db->db_debug;//save setting
		$this->tabel_author='author_baru';
		$this->tabel_masterauthor='masterauthor_baru';
	}

	function get_new_download_artikel(){
		$sql="select * from user_public_view_download
where date(download_check) between curdate()-1 and curdate()";
		$query_result=$this->db->query($sql);
			return $query_result;
	}
	function check_user_admin($user_id,$passwords)
	{
		$passwords=md5($passwords);
		$sql="select * from user_penerbit where (user_id_penerbit_default='".$user_id."' or user_id_penerbit_edited='".$user_id."') and password_penerbit='".$passwords."'";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
	}//end check users exist

	function get_total_jurnal($id_penerbit)
	{
		$sql="select * from (
select * from direktori
where issn='$id_penerbit'
) a, jurnal b
where a.id_direktori=b.id_direktori";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
	}
	function get_total_jurnal_per_tahun($id_penerbit)
	{
		$sql="select count(*) jumlah_artikel_per_tahun , b.year 
		from ( select * from direktori where issn='$id_penerbit' ) a, jurnal b 
where a.id_direktori=b.id_direktori
group by b.year";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
	}

	function get_total_jurnal_per_subjek($id_penerbit)
	{
		$sql="select count(*) jumlah_artikel,a.deskriptor,a.judul,a.penerbit from ( select * from direktori where issn='$id_penerbit' ) a, jurnal b 
where a.id_direktori=b.id_direktori
group by a.deskriptor
";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
	}



	function get_total_baca_jurnal($id_penerbit){
		$sql="select sum(hitungbaca) total_baca,sum(hitungdonlot) total_download from (
select * from direktori
where issn='$id_penerbit'
) a, jurnal b
where a.id_direktori=b.id_direktori";
$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;
	}
	
	function get_penerbit_users_download($id_penerbit){
		$sql="select distinct a.user_public_id  from (
select b.id_direktori,a.* from (
select distinct id_jurnal,user_public_id from user_public_view_download
) a, jurnal b
where a.id_jurnal=b.id_jurnal 
) a, direktori b
where a.id_direktori=b.id_direktori
and b.issn='$id_penerbit'";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;

	}

	function get_artikel_per_bidang($id_penerbit){
		$sql="select a.*,b.name_cat from (
select count(*) jum_artikel,b.id_category from ( select * from direktori where issn='$id_penerbit' ) a, jurnal b 
where a.id_direktori=b.id_direktori 
group by b.id_category
) a, category b
where a.id_category=b.id_category
";
		$query_result=$this->db->query($sql);
		//echo $sql;
		return $query_result;

	}

	function range_jum_download($tanggal_start,$tanggal_end){
		$sql="
		select count(*) jum_download,user_public_id,date_format(download_check,'%Y-%m-%d') tanggal from (
select 
	a.*,b.id_direktori 
from 
	user_public_view_download a,jurnal b
where 
	a.download_check is not null and a.id_jurnal=b.id_jurnal
	and date_format(download_check,'%Y-%m-%d') between '".$tanggal_start."' and '".$tanggal_end."'
) a, direktori b
where a.id_direktori=b.id_direktori
and b.id_penerbit='".$this->session->userdata('id_penerbit')."'
group by date_format(download_check,'%Y-%m-%d')";
		 //echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;

	}

	function range_jum_download_per_artikel($tanggal_start,$tanggal_end,$id_penerbit){
		$sql="
		select count(*) jumlah, a.id_jurnal,a.title,date_format(a.download_check,'%Y-%m-%d') tanggal from (
select b.id_direktori,b.title,a.* from user_public_view_download a, jurnal b
where a.id_jurnal=b.id_jurnal
	and date_format(a.download_check,'%Y-%m-%d') between trim('".$tanggal_start."') and trim('".$tanggal_end."')
) a, direktori b
where a.id_direktori=b.id_direktori
and b.issn='$id_penerbit' and download_check is not null


group by a.id_jurnal,a.title,date_format(a.download_check,'%Y-%m-%d')

";
		 //echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;

	}

	function range_jum_download_per_user($tanggal_start,$tanggal_end,$id_penerbit){
		$sql="
		select a.*,b.user_public_name,b.emails,b.user_group,b.kabupaten_kota from (
select count(*) jumlah, a.user_public_id,date_format(a.download_check,'%Y-%m-%d') tanggal 
from ( 
select b.id_direktori,b.title,a.* from user_public_view_download a, jurnal b 
where a.id_jurnal=b.id_jurnal 
and date_format(a.download_check,'%Y-%m-%d') between trim('".$tanggal_start."') and trim('".$tanggal_end."')
 ) a, 
direktori b where a.id_direktori=b.id_direktori and b.issn='$id_penerbit' 
and download_check is not null 
group by a.user_public_id,date_format(a.download_check,'%Y-%m-%d')
) a,( select a.*,b.user_group,c.kabupaten_kota from user_public a,user_group b,kabupaten_kota c where a.id_user_group=b.id_user_group and a.id_kota_kabupaten=c.id_kabupaten_kota)b
where a.user_public_id=b.user_public_id
";
		 //echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;

	}


}
?>