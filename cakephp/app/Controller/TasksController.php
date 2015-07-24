<?php
// app/Controller/TasksController.php
/**
 * @property User $User
 */
class TasksController extends AppController {

	public $scaffold;

	public function index(){
		$tasks_data = array();
		$this->set('tasks_data', $tasks_data);

		$this->render("index");
	}

	public function done(){
		$message = sprintf("タスク%sを完了しました", $this->request->pass[0]);

		$this->flash($message, "/Tasks/index");
	}
}