<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase Gantt, que formatea los datos para crear el gantt de un proyecto determinado.
 * @package com.ejemplo.application.model
 * @version 1.0 25/03/2014 16:00
 * @author Jose Rodriguez <josearodrigueze@gmail.com>
 */
class Gantt_model extends CI_Model {
	
	private $table = NULL;

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Carga la Clase Task Model del paquete projects, dentro de la
	 * variable 'Task'
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */
	private function loadTaskModel() {
		$this->load->model('Task_model', 'Task');
	}

	/**
	 * Carga la Clase Role Model del paquete projects, dentro de la
	 * variable 'Role'
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */
	private function loadRoleModel() {
		$this->load->model('Role_model', 'Role');
	}

	/**
	 * Carga la Clase Resource Model del paquete projects, dentro de la
	 * variable 'Resource'
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */
	private function loadResourceModel() {
		$this->load->model('Resource_model', 'Resource');
	}

	/**
	 * Obtiene la informacion de Tareas, Recursos y Roles asociados
	 * a un ID de proyecto dado.
	 *
	 * @param 	Integer $project_id ID de Proyecto.
	 * @return  Array
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */
	public function get($project_id) {
		$this->loadTaskModel();
		$this->loadRoleModel();
		$this->loadResourceModel();

		$project = array(
			'tasks'             => $this->Task->getByProject($project_id),
		    'resources'         => $this->Resource->get(),
		    'roles'             => $this->Role->get(),
		    'selectedRow'       => 0,
		    'deletedTaskIds'    => FALSE,
		    'canWrite'          => 1,
		    'canWriteOnParent'  => 1,
		);

		return $project;
	}

	public function save($project_id, $json_project) {
		$this->loadTaskModel();
		// $this->loadRoleModel();

		$this->db->trans_start();

		$project = json_decode($json_project);

		// $this->Role->save($project->role, FALSE);
		$this->Task->remove($project_id, $project->deletedTaskIds, FALSE);
		$this->Task->save($project_id, $project->tasks, FALSE);

		$this->db->trans_complete();
        return $this->db->trans_status();
	}
}

/* End of file gantt_model.php */
/* Location: ./application/models/projects/gantt_model.php */