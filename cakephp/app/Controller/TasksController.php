<?php
// app/Controller/TasksController.php
/**
 * @property Task $Task
 */
class TasksController extends AppController {

	public $scaffold;

	public function index(){
		$options = array("condtion" => array(
				"status" => 0
		));

		$tasks_data = $this->Task->find("all", $options);
		$this->set('tasks_data', $tasks_data);

		$this->render("index");
	}

	public function done(){
		$message = sprintf("タスク%sを完了しました", $this->request->pass[0]);

		$this->flash($message, "/Tasks/index");
	}
}