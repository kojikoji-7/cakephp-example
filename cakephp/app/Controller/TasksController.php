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

		$this->Session->setFlash($message);
		$this->redirect("/Tasks/index");
	}

	public function create(){
		if($this->request->is("post")){	//登録処理
			$data = array("name" => $this->request->data["name"]);

			$id = $this->Task->save($data);

			$message = sprintf("タスク%sを登録しました", $id);

			$this->Session->setFlash($message);
			$this->redirect("/Tasks/index");
		}
		$this->render("create");
	}
}