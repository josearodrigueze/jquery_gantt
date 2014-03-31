<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model {
	private $table = 'project';

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Obtiene los datops de un proyecto dado su ID.
	 * @param  Integer $id ID de proyecto
	 * @return mixed     datos del proyecto | FALSE;
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */
	public function get($id) {
		$rs = $this->db->get($this->table, array('id' => $id));
		return ($rs->num_rows()) ? $rs->row_array() : FALSE;
	}

}

/* End of file Project.php */
/* Location: ./application/models/Project.php */