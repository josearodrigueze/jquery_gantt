<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase Resource, provee el acceso a datos de la tabla Resource.
 * @package com.ejemplo.application.model
 * @version 1.0 25/03/2014 16:00
 * @author Jose Rodriguez <josearodrigueze@gmail.com>
 */
class Resource_model extends CI_Model {

	private $table = 'resource';

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Devuelve los Recursos almacenados en BD.
	 * Si se le pasa $id devuelde el Recurso asociado.
	 *
	 * @param 	Integer $id ID de Recurso. Defualt 0.
	 * @return  Array
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */	
	public function get($id = 0) {
		return (empty($id)) ? $this->All() : $this->One($id);
	}

	/**
	 * Devuelve los Recursos almacenados en BD.
	 * @return Array
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */
	private function All() {
		$q = $this->db->get($this->table);
		return ($q->num_rows() > 0) ? $q->result_array() : FALSE;
	}

	/**
	 * Devuelve un Recurso dado su ID.
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

	/**
	 * Muestra los agengtes asociados a la empresa en session.
	 * @return array agentes
	 * @version 1.0 31/03/2014 09:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */
	public function getAgents() {
		$table = 'eagente';
		$this->db->select('CODAGENTE AS id');
		$this->db->select('CONCAT(NOMBREAGENTE, \' \', APELLIDOAGENTE) AS name', FALSE);
		$this->db->where('ESTATUSAGENTE', 'A');
		$this->db->where('NITEMPRESA', $this->session->userdata('loginEmpresa'));
		$this->db->where_not_in('PRIV', array('superadmin', 'admin'));
		$rs = $this->db->get($table);
		return ($rs->num_rows() > 0) ? $rs->result_array() : array();
	}

}

/* End of file resource_model.php */
/* Location: ./application/models/projects/resource_model.php */