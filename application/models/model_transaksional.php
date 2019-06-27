<?php
/*
 * Nama			: Transaksional
 * Tanggal		: 9 Juli 2015
 * Pembuat		: R Yudi Rachmanu
 *
 * Description :
 *  */
class model_transaksional extends CI_Model {
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
	
	/*
		get the data off all members transaction for add new kuota
	*/
	function get_user_kuota(){

		// $sql="select * from user_public_quota where date_transfer between '2015-07-01' and '2015-07-05' ";
		$sql="select * from user_public_quota where approval_convert_by is null or approval_convert_by=''";
		$query_result=$this->db->query($sql);
		return $query_result;
	}// end of get_user_kuota


}// end class model_transaksional
?>