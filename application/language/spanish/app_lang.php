<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Lenguajes Globales para la app.
$lang['app_button_save']				= 'Guardar';
$lang['app_button_clear']				= 'Limpiar'
;
$lang['app_label_name']					= 'Nombre';


// Lenguajes para la interfaz de Gantt Project.
$lang['app_project_label_title']				= 'Proyecto';

$lang['app_gantt_title']				= 'Gr&aacute;fica Gantt del Proyecto';
$lang['app_gantt_start']				= 'Inicio';
$lang['app_gantt_end']					= 'Fin';
$lang['app_gantt_name']					= 'Nombre de Tarea';
$lang['app_gantt_code']					= 'C&oacute;digo';
$lang['app_gantt_depends']				= 'Predecesoras';
$lang['app_gantt_duration']				= 'Duraci&oacute;n';
$lang['app_gantt_assignees']			= 'Recursos';
$lang['app_gantt_description']			= 'Descripci&oacute;n';
$lang['app_gantt_progress']				= 'Progreso';
$lang['app_gantt_status']				= 'Estatus';
$lang['app_gantt_role']					= 'Cargo';
$lang['app_gantt_effort']				= 'Estimaci&oacute;n';

$lang['app_gantt_button_edit_resource']	= 'Editar Recursos';
$lang['app_gantt_button_export']		= 'Exportar';

$lang['app_gantt_error_INVALID_DATE_FORMAT']	= 'Formato de Fecha Invalido';
$lang['app_gantt_error_CIRCULAR_REFERENCE']	= 'Referencia Circular';
$lang['app_gantt_error_CANNOT_DEPENDS_ON_ANCESTORS']		= 'No puede depender de un padre.';
$lang['app_gantt_error_CANNOT_DEPENDS_ON_DESCENDANTS']	= 'No puede depender de un hijo.';
$lang['app_gantt_error_TASK_MOVE_INCONSISTENT_LEVEL']		= 'Tarea movida a fuera de su nivel.';
$lang['app_gantt_error_TASK_HAS_CONSTRAINTS']				= 'La tarea posee Restricciones.';
$lang['app_gantt_error_GANTT_ERROR_DEPENDS_ON_OPEN_TASK']	= 'Esta tarea depende de una tarea abierta.';
$lang['app_gantt_error_TASK_HAS_EXTERNAL_DEPS']			= 'Esta tarea depende de una tarea externa.';
$lang['app_gantt_error_START_IS_MILESTONE']				= 'La tarea inicio in Hito.';
$lang['app_gantt_error_END_IS_MILESTONE']					= 'La tarea finaliza in Hito.';


/* End of file app_lang.php */
/* Location: ./application/language/spanish/app_lang.php */