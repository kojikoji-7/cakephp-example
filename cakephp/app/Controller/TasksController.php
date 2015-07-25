<?php
// app/Controller/TasksController.php
/**
 * @property Task $Task
 */
class TasksController extends AppController {

	public $scaffold;

	public function index(){
		$options = array("conditions" => array(
				"status" => 0
		));

		$tasks_data = $this->Task->find("all", $options);
		$this->set('tasks_data', $tasks_data);

		$this->render("index");
	}

	public function done(){
		$id = $this->request->pass[0];
		$this->Task->id = $id;
		$this->Task->saveField("status", 1);


		$message = sprintf("タスク%sを完了しました", $id);

		$this->flash($message, "/Tasks/index");
	}
}