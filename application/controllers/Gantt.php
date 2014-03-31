<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gantt extends CI_Controller {

	public function index($project_id = 1) {
        $this->load->helper('url');
        $this->load->model('Project_model', 'Project');
        $this->load->model('Gantt_model', 'Gantt');

        // Cuando se configure el lenguaje de las app, eliminar el segundo parametro.
        $this->lang->load('app', 'spanish');

        $project = $this->Project->get($project_id);
        $project_name = $project['name'];

        $data = array(
            'project'       => $this->Gantt->get($project_id),
            'project_id'    => $project_id,
            'project_name'  => $project_name,
        );

        $this->load->view('gantt', $data);
    }

    /**
     * Guadar la informacion de Gantt en Base de Datos.
     * 
     * @version 1.0 31/03/2014 16:35
     * @author Jose A. Rodriguez E. <josearodrigueze@gmail.com>
     */
    public function saveGantt() {
        $response = array();
        $ganttAction = $this->input->post('CM');
        if ($ganttAction == 'SVPROJECT') {
            $this->load->model('Gantt_model', 'Gantt');

            $project_id  = $this->input->post('_q');
            $wasSave = $this->Gantt->save($project_id, $this->input->post('prj'));
            if ($wasSave) {
                $msg = 'El Gantt guardado satisfactoriamente.';
                $project = $this->Gantt->get($project_id);
            } else {
                $msg = 'El Gantt no pudo ser guardado. Por favor, intenteo de nuevo.';
                $project = FALSE;
            }

            $response = array('ok' => $wasSave, 'project' => $project, 'message' => $msg);
        }
        echo json_encode($response);
    }

}

/* End of file gantt.php */
/* Location: ./application/controllers/gantt.php */