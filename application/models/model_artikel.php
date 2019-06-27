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
class model_artikel extends CI_Model {
	public $db_debug;
	public $tabel_author;
	public $tabel_masterauthor;
	
	function __construct()
	{
		parent::__construct();
		$db_debug=$this->db->db_debug;//save setting
		$this->tabel_author='author_baru';
		$this->tabel_masterauthor='masterauthor_baru';
	}
	
	
	function get_data_artikel($keyword_text='All')
	{
		//$keyword_text=ucase($keyword_text);
		//$sql= "select * from (select a.id_jurnal,a.title title,b.name_cat,a.tanggal from jurnal a left join category b on a.id_category=b.id_category ) a ";
		
		$sql="
			select 
	* 
		from 
			(
				select a.id_jurnal,a.title title,a.tanggal,a.judul judul_jurnal,b.name_cat 
				from 
					(
						select x.id_jurnal,x.title,x.tanggal,y.id_category,y.judul from jurnal x,direktori y
						where x.id_direktori=y.id_direktori
					) a 
				left join 
					 category b
				on a.id_category=b.id_category  
			) a

		";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" where concat(upper(a.title),' ',year(a.tanggal)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
			
		}
		
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_data_artikel_per_page($limit,$offset,$keyword_text='All')
	{
		//$keyword_text=upper($keyword_text);
		//$sql= "select * from (select a.id_jurnal,a.title title,b.name_cat,a.tanggal from jurnal a left join category b on a.id_category=b.id_category ) a ";
		
		$sql="
			select 
	* 
		from 
			(
				select a.id_jurnal,a.title title,a.tanggal,a.judul judul_jurnal,b.name_cat 
				from 
					(
						select x.id_jurnal,x.title,x.tanggal,y.id_category,y.judul from jurnal x,direktori y
						where x.id_direktori=y.id_direktori
					) a 
				left join 
					 category b
				on a.id_category=b.id_category  
			) a

		";
		if($keyword_text<>'All')
		{
			
			$sql .=" where concat(upper(a.title),' ',year(a.tanggal)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
			
		}
		$sql .="LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}


	function get_data_artikel_adv($keyword_text='All',$tahun,$nama_journal)
	{
		//$keyword_text=ucase($keyword_text);
		//$sql= "select * from (select a.id_jurnal,a.title title,b.name_cat,a.tanggal from jurnal a left join category b on a.id_category=b.id_category ) a ";
		
		$sql="
			select 
	* 
		from 
			(
				select a.id_jurnal,a.title title,a.tanggal,a.judul judul_jurnal,b.name_cat 
				from 
					(
						select x.id_jurnal,x.title,x.tanggal,y.id_category,y.judul from jurnal x,direktori y
						where x.id_direktori=y.id_direktori
					) a 
				left join 
					 category b
				on a.id_category=b.id_category  
			) a

		";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" where concat(upper(a.title),' ',year(a.tanggal)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
			$sql .=" and year(a.tanggal)='".$tahun."'";
			if ($nama_journal<>'All') $sql .=" and upper(a.judul_jurnal)  REGEXP upper('[[:<:]]".$nama_journal."[[:>:]]')";			
		}
		
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_data_artikel_per_page_adv($limit,$offset,$keyword_text='All',$tahun,$nama_journal)
	{
		//$keyword_text=upper($keyword_text);
		//$sql= "select * from (select a.id_jurnal,a.title title,b.name_cat,a.tanggal from jurnal a left join category b on a.id_category=b.id_category ) a ";
			
		$sql="
			select 
	* 
		from 
			(
				select a.id_jurnal,a.title title,a.tanggal,a.judul judul_jurnal,b.name_cat 
				from 
					(
						select x.id_jurnal,x.title,x.tanggal,y.id_category,y.judul from jurnal x,direktori y
						where x.id_direktori=y.id_direktori
					) a 
				left join 
					 category b
				on a.id_category=b.id_category  
			) a

		";

		if($keyword_text<>'All')
		{
			
			$sql .=" where concat(upper(a.title),' ',year(a.tanggal)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
			$sql .=" and year(a.tanggal)='".$tahun."'";
			if ($nama_journal<>'All') $sql .=" and upper(a.judul_jurnal)  REGEXP upper('[[:<:]]".$nama_journal."[[:>:]]')";
			
		}
		$sql .="LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}


	function get_data_artikel_single($id_jurnal){
		$sql="select a.*,b.judul,b.penerbit,b.kodepanggil from jurnal a,direktori b where a.id_direktori=b.id_direktori and a.id_jurnal='".$id_jurnal."'";
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_list_artikel_number_year_volume($number,$year,$volume,$id_direktori){
		$sql="select a.*,b.judul,b.penerbit,b.kodepanggil from jurnal a,direktori b 
where a.id_direktori=b.id_direktori  and a.id_direktori='$id_direktori' and
a.year='$year' and a.volume='$volume' and a.number='$number'";
		//echo sql;
		$query_result=$this->db->query($sql);
		return $query_result;


	}
	function add_count_hit_artikel($id_jurnal,$user_id){
		$sql="update jurnal
				set
				hitungbaca=hitungbaca+1
				where
				id_jurnal='".$id_jurnal."'";
		$query_result=$this->db->query($sql);
		if ($user_id<>""){
			$sql="insert into user_public_view_download (user_public_id,id_jurnal,view_check)
				values
				('".$user_id."','".$id_jurnal."',now())";
			$query_result=$this->db->query($sql);


		}
		return $query_result;
		

	}

	function add_count_download_artikel($id_jurnal,$user_id){
		//update data donwload artikel
		$sql="update jurnal
				set
				hitungdonlot=hitungdonlot+1
				where
				id_jurnal='".$id_jurnal."'";
		$query_result=$this->db->query($sql);
		//update kuota download
		$sql="update user_public
				set
				saldo_quota_download=saldo_quota_download-1
				where
				user_public_id='".$user_id."'";
		$query_result=$this->db->query($sql);

		//insert data histori
		$sql="insert into user_public_view_download (user_public_id,id_jurnal,download_check)
				values
				('".$user_id."','".$id_jurnal."',now())";
		$query_result=$this->db->query($sql);


		return $query_result;
	}
	/*
	 * functions that handle author
	 */
	function get_data_author_artikel($keyword_text='All'){
		$sql="select * from (select distinct author_id from ".$this->tabel_author." )a,".$this->tabel_masterauthor." b
				where 
				a.author_id=b.author_id ";
				
		if($keyword_text<>'All')
		{
			$sql .=" and concat(b.authorname) REGEXP '[[:<:]]".$keyword_text."[[:>:]]'";
			
		}
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_data_author_artikel_per_page($limit,$offset,$keyword_text='All')
	{
		$sql= " select * from (select distinct author_id from ".$this->tabel_author." )a,".$this->tabel_masterauthor." b
				where 
				a.author_id=b.author_id";
		if($keyword_text<>'All')
		{
			
			$sql .=" and concat(b.authorname) REGEXP '[[:<:]]".$keyword_text."[[:>:]]'";
			
		}
		$sql .=" LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_data_author_artikel_detail($id_jurnal)
	{
		$sql="select a.*,b.*,c.authorname from ".$this->tabel_author." a,jurnal b,".$this->tabel_masterauthor." c where a.id_jurnal=b.id_jurnal and a.author_id=c.author_id and a.id_jurnal=".$id_jurnal."";
		// echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_data_author_artikel_detail_info($author_id)
	{
		$sql="select a.*,b.*,c.authorname from ".$this->tabel_author." a,jurnal b,".$this->tabel_masterauthor." c where a.id_jurnal=b.id_jurnal and a.author_id=c.author_id and a.author_id='".$author_id."'";
		// echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	//chart
	function get_count_artikel_per_year($year1,$year2){
		$sql="
			select year(tanggal) label,count(*) value from jurnal
	where (year(tanggal) > ".$year1." and year(tanggal) < ".$year2.") 
	group by year(tanggal)
	order by year(tanggal)
			";
			$query_result=$this->db->query($sql);
			return $query_result;
		}
	function get_count_artikel_per_year_line($year1,$year2){
			$sql="
			select year(tanggal) year ,count(*) value  from jurnal
	where (year(tanggal) > ".$year1." and year(tanggal) < ".$year2.") 
	group by year(tanggal)
	order by year(tanggal)
			";
			$query_result=$this->db->query($sql);
			return $query_result;
		}
		function get_count_artikel_per_year_line_search($year1,$year2,$keyword_text){
			$sql="
			select year(tanggal) year ,count(*) value  from (";
      
      $sql.="
			select 
	* 
		from 
			(
				select a.id_jurnal,a.title title,a.tanggal,a.judul judul_jurnal,b.name_cat 
				from 
					(
						select x.id_jurnal,x.title,x.tanggal,y.id_category,y.judul from jurnal x,direktori y
						where x.id_direktori=y.id_direktori
					) a 
				left join 
					 category b
				on a.id_category=b.id_category  
    	) a		

		";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" where concat(upper(a.title),' ',year(a.tanggal)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
			
		}
	    
      $sql .=" ) a where (year(a.tanggal) > ".$year1." and year(a.tanggal) < ".$year2.") 
	group by year(a.tanggal)
	order by year(a.tanggal)
			";
			//echo $sql;
			$query_result=$this->db->query($sql);
			return $query_result;
		}

	function get_count_artikel_per_month($year){
			$sql="
			select monthname(str_to_date(month(tanggal),'%m')) month, count(*) value  from jurnal
where year(tanggal)=$year
group by month(tanggal)

			";
			$query_result=$this->db->query($sql);
			return $query_result;

	}

	function get_sum_baca_artikel_per_year_line($year1,$year2){
			$sql="
			select year(tanggal) year ,sum(hitungbaca) baca,sum(hitungdonlot) donlot  from jurnal
	where (year(tanggal) > ".$year1." and year(tanggal) < ".$year2.") 
	group by year(tanggal)
	order by year(tanggal)
			";
			$query_result=$this->db->query($sql);
			return $query_result;
		}

	function get_compotition_count_viewed_downloaded(){
		$sql="
			select sum(jumlah_jurnal) jumlah_artikel,sum(jumlah_baca) jumlah_baca,sum(jumlah_download) jumlah_download from (
	select count(*) jumlah_jurnal,0 jumlah_baca,0 jumlah_download from jurnal
	union
	select 0 jumlah_jurnal,count(*) jumlah_baca,0 jumlah_download from jurnal
	where hitungbaca<>0 or hitungbaca is not null
	union
	select 0 jumlah_jurnal,0 jumlah_baca,count(*) jumlah_download from jurnal
	where hitungdonlot<>0 or hitungdonlot is not null

	) a
		";
		$query_result=$this->db->query($sql);
			return $query_result;
	}

	function get_new_download_artikel(){
		$sql="select * from user_public_view_download
where date(download_check) between curdate()-1 and curdate()";
		$query_result=$this->db->query($sql);
			return $query_result;
	}

	// info detail artikel per jurnal, untuk keperluan menu direktori

	function get_artikel_per_jurnal_per_tahun_per_volume($id_jurnal){

		$sql="select count(*),year,volume from jurnal
			where id_direktori='$id_jurnal'
			group by year,volume";
	}

	// end of info detail per jurnal menu direktori

	// menghitung penerbit berdasarkan jumlah yang terbaca
	function get_penerbit_terbaca(){
		$sql="
select sum(hitungbaca) jumbaca,penerbit from (
select penerbit,hitungbaca from jurnal a,direktori b
where a.id_direktori=b.id_direktori
) a
group by penerbit
order by sum(hitungbaca) desc
limit 0,10
		";
		$query_result=$this->db->query($sql);
			return $query_result;
	} 

	function get_author_terbaca(){
		$sql="select a.*,b.authorname from (
select sum(a.hitungbaca) jumbaca ,b.author_id from jurnal a,author_baru b
where a.id_jurnal=b.id_jurnal
group by b.author_id 
order by sum(a.hitungbaca) desc
) a,masterauthor_baru b
where a.author_id=b.author_id
limit 0,10
";
			$query_result=$this->db->query($sql);
			return $query_result;

	}

	function get_total_baca_donlot()
	{
		$sql="select sum(hitungbaca) hitung_baca,sum(hitungdonlot) hitung_download from jurnal";
		$query_result=$this->db->query($sql);
			return $query_result;		
	}

	function get_category(){

		$sql="
select count(*) jum_artikel,name_cat,id_category from (select a.id_jurnal,a.title title,b.name_cat,a.id_category,a.tanggal 
from jurnal a left join category b on a.id_category=b.id_category ) a
group by name_cat,id_category 
		";
		$query_result=$this->db->query($sql);
			return $query_result;	
	}

	function get_category_single($bidang){

		$sql="
select count(*) jum_artikel,name_cat,id_category from (select a.id_jurnal,a.title title,b.name_cat,a.id_category,a.tanggal 
from jurnal a left join category b on a.id_category=b.id_category ) a
where a.id_category='".$bidang."'
group by name_cat,id_category 
		";
		$query_result=$this->db->query($sql);
			return $query_result;	
	}
	
	function get_data_artikel_bidang($keyword_text='All',$bidang='Kategori')
	{
		//$keyword_text=ucase($keyword_text);
		$sql= "select * from (select a.id_jurnal,a.title title,b.name_cat,a.id_category,a.tanggal from jurnal a left join category b on a.id_category=b.id_category ) a ";
		if($bidang<>'Kategori')
		{
			$sql .=" where id_category='".$bidang."'";	
			if($keyword_text<>'All')
			{
				//tenaga
				$sql .=" and concat(upper(a.title),' ',year(a.tanggal)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
				
			}
		}else{
			if($keyword_text<>'All')
			{
				//tenaga
				$sql .=" where concat(upper(a.title),' ',year(a.tanggal)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
				
			}

		}
		
		
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_data_artikel_bidang_per_page($limit,$offset,$keyword_text='All',$bidang)
	{
		//$keyword_text=upper($keyword_text);
		$sql= "select * from (select a.id_jurnal,a.title title,b.name_cat,a.id_category,a.tanggal from jurnal a left join category b on a.id_category=b.id_category ) a ";
		if($bidang<>'Kategori')
		{
			$sql .=" where id_category='".$bidang."'";	
			if($keyword_text<>'All')
			{
				//tenaga
				$sql .=" and concat(upper(a.title),' ',year(a.tanggal)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
				
			}
		}else{
			if($keyword_text<>'All')
			{
				//tenaga
				$sql .=" where concat(upper(a.title),' ',year(a.tanggal)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
				
			}

		}
		
		$sql .="LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}


}// end class
?>
