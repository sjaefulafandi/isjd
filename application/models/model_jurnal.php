<?php
/*
 * Nama			: Jurnal
 * Tanggal		: 4 mei 2015
 * Pembuat		: R Yudi Rachmanu
 *
 * Description :
 * tabel jurnal , itu berisi artikel 
 * tabel direktori yang merupakan penampung informasi jurnal 
 * jumlah baca jurnal , dilihat dari jumlah artikel yang dibaca
 *  */
class model_jurnal extends CI_Model {
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
	
	
	function get_data_jurnal($keyword_text='All',$jenis='judul')
	{
		//$keyword_text=ucase($keyword_text);
		$sql= "select ifnull(b.jum_artikels,0) jum_artikels,a.* from direktori a left join (select count(*) jum_artikels, a.id_direktori from direktori a,jurnal b
where a.id_direktori=b.id_direktori
group by a.id_direktori) b on a.id_direktori=b.id_direktori
";
		if($keyword_text<>'All' && $jenis=='judul')
		{
			//tenaga
			$sql .=" where concat(upper(a.judul)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
			
		}
		
		if($keyword_text<>'All' && $jenis=='subjek')
		{
			//tenaga
			$sql .=" where concat(upper(a.deskriptor))=upper('".$keyword_text."')";
			
		}

		if($keyword_text<>'All' && $jenis=='penerbit')
		{
			//tenaga
			$sql .=" where concat(upper(a.penerbit))=upper('".$keyword_text."')";
			
		}

		if($keyword_text<>'All' && $jenis=='issn')
		{
			//tenaga
			$sql .=" where concat(upper(a.issn))=upper('".$keyword_text."')";
			
		}

		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_data_jurnal_per_page($limit,$offset,$keyword_text='All',$jenis='judul')
	{
		//$keyword_text=upper($keyword_text);
		$sql= "select ifnull(b.jum_artikels,0) jum_artikels,a.* from direktori a left join (select count(*) jum_artikels, a.id_direktori from direktori a,jurnal b
where a.id_direktori=b.id_direktori
group by a.id_direktori) b on a.id_direktori=b.id_direktori
 ";
		if($keyword_text<>'All' && $jenis=='judul')
		{
			
			$sql .=" where concat(upper(a.judul)) REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]')";
			
		}
		if($keyword_text<>'All' && $jenis=='subjek')
		{
			//tenaga
			$sql .=" where concat(upper(a.deskriptor)) =upper('".$keyword_text."')";
			
		}

		if($keyword_text<>'All' && $jenis=='penerbit')
		{
			//tenaga
			$sql .=" where concat(upper(a.penerbit))=upper('".$keyword_text."')";
			
		}

		if($keyword_text<>'All' && $jenis=='issn')
		{
			//tenaga
			$sql .=" where concat(upper(a.issn))=upper('".$keyword_text."')";
			
		}

		$sql .="LIMIT ".$offset.", ".$limit;
		
		//echo $sql;

		$query_result=$this->db->query($sql);
		return $query_result;
	}

	function get_jurnal_detail($id){
		$sql="select * from direktori where id_direktori='$id'";
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;	

	}

	function get_artikel_jurnal($id_jurnal){
			$sql="select count(*) jum_artikel,year,volume,number from jurnal
where id_direktori='$id_jurnal'
group by year,volume,number";
//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;

	}

	//jurnal per subjek section
	function get_data_jurnal_subjek($keyword_text='All')
	{
		//$keyword_text=ucase($keyword_text);
		/*$sql= "select distinct a.deskriptor,ifnull(b.jum_artikel,0) jum_artikel from direktori a left join (
			select count(*) jum_artikel,a.deskriptor from direktori a,jurnal b
where a.id_direktori=b.id_direktori
group by a.deskriptor
			) b  on a.deskriptor=b.deskriptor
			";
			*/
			$sql="select count(*) jum_jurnal,deskriptor from direktori where deskriptor is not null and deskriptor <>'' ";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" and deskriptor REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}
		
		$sql .=" group by deskriptor ";
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_data_jurnal_subjek_per_page($limit,$offset,$keyword_text='All')
	{
		//$keyword_text=upper($keyword_text);
		/*$sql= "select distinct a.deskriptor,ifnull(b.jum_artikel,0) jum_artikel from direktori a left join (
			select count(*) jum_artikel,a.deskriptor from direktori a,jurnal b
where a.id_direktori=b.id_direktori
group by a.deskriptor
			) b  on a.deskriptor=b.deskriptor";
		*/
		$sql="select count(*) jum_jurnal,deskriptor from direktori  where deskriptor is not null and deskriptor <>'' ";
		
		if($keyword_text<>'All')
		{
			
			$sql .=" and deskriptor REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}

		$sql .=" group by deskriptor ";
		$sql .=" LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	// jurnal per penerbit

	function get_data_jurnal_penerbit($keyword_text='All')
	{
		//$keyword_text=ucase($keyword_text);
		/*$sql= "select distinct a.deskriptor,ifnull(b.jum_artikel,0) jum_artikel from direktori a left join (
			select count(*) jum_artikel,a.deskriptor from direktori a,jurnal b
where a.id_direktori=b.id_direktori
group by a.deskriptor
			) b  on a.deskriptor=b.deskriptor
			";
			*/
			$sql="select count(*) jum_jurnal,penerbit from direktori where penerbit is not null and penerbit <>'' ";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" and penerbit REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}
		
		$sql .=" group by penerbit ";
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_data_jurnal_penerbit_per_page($limit,$offset,$keyword_text='All')
	{
		//$keyword_text=upper($keyword_text);
		/*$sql= "select distinct a.deskriptor,ifnull(b.jum_artikel,0) jum_artikel from direktori a left join (
			select count(*) jum_artikel,a.deskriptor from direktori a,jurnal b
where a.id_direktori=b.id_direktori
group by a.deskriptor
			) b  on a.deskriptor=b.deskriptor";
		*/
		$sql="select count(*) jum_jurnal,penerbit from direktori where penerbit is not null and penerbit <>''";
		
		if($keyword_text<>'All')
		{
			
			$sql .=" and penerbit REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}

		$sql .=" group by penerbit ";
		$sql .=" LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}

	//per issn
	function get_data_jurnal_issn($keyword_text='All')
	{
		//$keyword_text=ucase($keyword_text);
		/*$sql= "select distinct a.deskriptor,ifnull(b.jum_artikel,0) jum_artikel from direktori a left join (
			select count(*) jum_artikel,a.deskriptor from direktori a,jurnal b
where a.id_direktori=b.id_direktori
group by a.deskriptor
			) b  on a.deskriptor=b.deskriptor
			";
			*/
			$sql="select count(*) jum_jurnal,issn from direktori where issn is not null and issn <>'' ";
		if($keyword_text<>'All')
		{
			//tenaga
			$sql .=" and issn REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}
		
		$sql .=" group by issn ";
		//echo $sql;
		$query_result=$this->db->query($sql);
		return $query_result;
	}
	function get_data_jurnal_issn_per_page($limit,$offset,$keyword_text='All')
	{
		//$keyword_text=upper($keyword_text);
		/*$sql= "select distinct a.deskriptor,ifnull(b.jum_artikel,0) jum_artikel from direktori a left join (
			select count(*) jum_artikel,a.deskriptor from direktori a,jurnal b
where a.id_direktori=b.id_direktori
group by a.deskriptor
			) b  on a.deskriptor=b.deskriptor";
		*/
		$sql="select count(*) jum_jurnal,issn from direktori where issn is not null and issn <>''";
		
		if($keyword_text<>'All')
		{
			
			$sql .=" and issn REGEXP upper('[[:<:]]".$keyword_text."[[:>:]]') ";
			
		}

		$sql .=" group by issn ";
		$sql .=" LIMIT ".$offset.", ".$limit;
		$query_result=$this->db->query($sql);
		return $query_result;
	}

}// end class
?>