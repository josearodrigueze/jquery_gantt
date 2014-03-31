<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase Task, provee el acceso a datos de la tabla Task.
 * @package com.ejemplo.application.model
 * @version 1.0 25/03/2014 16:00
 * @author Jose Rodriguez <josearodrigueze@gmail.com>
 */
class Task_model extends CI_Model {

	private $table = 'task';

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Devuelve las tareas pertenecientes al proyecto con $id dado.
	 * @param Integer $id
	 * @return Array
	 * @version 1.0 25/03/2014 16:00
	 * @author Jose Rodriguez <josearodrigueze@gmail.com>
	 */
	public function getByProject($project_id) {
		$this->db->where(array('project_id' => $project_id, 'deleted' => 0));
		$q = $this->db->get($this->table);

		if($q->num_rows() <= 0)
			return array();

		$tasks = $q->result_array();

		foreach ($tasks as &$task) {
			$task['startIsMilestone'] = (Boolean) $task['startIsMilestone'];
			$task['endIsMilestone'] = (Boolean) $task['endIsMilestone'];
			$task['collapsed'] = (Boolean) $task['collapsed'];

			$task['start'] = (Integer) $task['start'];
			$task['end'] = (Integer) $task['end'];
			
			$task['assigs'] = $this->getAssigs($task['id']);
		}

		return $tasks;
	}

	private function getAssigs($task_id) {
		$this->db->where('task_id', $task_id);
		$q = $this->db->get('assigs');

		$assigs = array();
		if($q->num_rows() > 0){
			$assigs = $q->result_array();
			foreach ($assigs as &$assig)
				$assig['effort'] = (Integer) $assig['effort'];
		}
		return $assigs;
	}

	public function save($project_id, $tasks, $managerTransaction = TRUE) {
		$this->startTransaction($managerTransaction);

		foreach ($tasks as &$task) {

			// Agregamos el ID de proyecto al las Tareas
			$task->project_id = $project_id;

			// Determinamos si es una tarea nueva (insert).
			if (preg_match('/^tmp_*/', $task->id)) {
				unset($task->id);
				$this->db->insert($this->table, $task);
				$task->id = $this->db->insert_id();
			} else {
				// Tarea ya existente Update.
				$this->db->where('id', $task->id);
				$this->db->update($this->table, $task);
			}

			if (!empty($task->assigs)) {
				unset($task->assigs->id);
				$task->assigs = $this->saveAssigs($task->assigs, $task->id);
			}
		}
		return $this->endTransaction($managerTransaction);
	}

	private function saveAssigs($assigs, $task_id) {
		$table = 'assigs';
		foreach ($assigs as &$assig) {
			$assig->task_id = $task_id;

			// Determinamos si es una asignacion nueva (insert).
			if (preg_match('/^tmp_*/', $assig->id)) {
				unset($assig->id);
				$this->db->insert($table, $assig);
				$assig->id = $this->db->insert_id();
			} else {

				// asignacion ya existente Update.
				$this->db->where('id', $assig->id);
				$this->db->update($table, $assig);
			}
		}
		return $assigs;
	}

	private function startTransaction($do = TRUE) {
		if ($do)
			$this->db->trans_start();
	}

	private function endTransaction($do = TRUE) {
		if ($do) {
			$this->db->trans_complete();
        	return $this->db->trans_status();
		}
	}

	public function remove($project_id, $tasksIds, $managerTransaction = TRUE) {
		if (empty($tasksIds) OR !is_array($tasksIds))
			return;

		$this->startTransaction($managerTransaction);
		$tableAssigs = 'assigs';

		// Elimina la assignacion de tareas.
		$this->db->where_in('task_id', $tasksIds);
		$this->db->delete($tableAssigs);

		// Elimina las tareas
		$this->db->where_in('id', $tasksIds);
		$this->db->where('project_id', $project_id);
		$this->db->delete($this->table);

		return $this->endTransaction($managerTransaction);
	}

}

/* End of file task_model.php */
/* Location: ./application/models/projects/task_model.php */