<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase Rol, provee el acceso a datos de la tabla Role.
 * @package com.ejemplo.application.model
 * @version 1.0 25/03/2014 16:00
 * @author Jose Rodriguez <josearodrigueze@gmail.com>
 */
class Role_model extends CI_Model {

	private $table = 'role';

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Devuelve los Roles almacenados en BD.
	 * Si se le pasa $id devuelde el Rol asociado.
	 *
	 * @param 	Integer $id ID de Rol. Defualt 0.
	 * @return  Array
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */	
	public function get($id = 0) {
		return (empty($id)) ? $this->All() : $this->One($id);
	}

	/**
	 * Devuelve los Roles almacenados en BD.
	 * @return Array
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */
	private function All() {
		$q = $this->db->get($this->table);
		return ($q->num_rows() > 0) ? $q->result_array() : FALSE;
	}

	/**
	 * Devuelve un Rol dado su ID.
	 * @param Integer $id
	 * @return Array
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */
	private function One($id) {
		$this->db->where('id', $id);
		$this->db->limit(1);
		$q = $this->db->get($this->table);
		return ($q->num_rows() > 0) ? $q->row_array() : FALSE;
	}
}

/* End of file role_model.php */
/* Location: ./application/models/projects/role_model.php */