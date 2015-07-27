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

	public function select(){
		//全件　select * from tasks
// 		$options = array();

		//条件付き　select * from tasks where status < 0 order by id DESC limit 2
// 		$options = array(
// 			"conditions" => array(
// 				"status >" => 0
// 			),
// 			"order" => "id DESC",
// 			"limit" => 2
// 		);

		//条件付き　select * from tasks where (status = 1 OR name IN ('TEST', 'TEST1'))
// 		$options = array(
// 				"conditions" => array(
// 					"OR" => array(
// 						"status" => 1,
// 						"name" => array("TEST", "TEST1")
// 					)
// 				),
// 		);
// 		$taskList = $this->Task->find("all", $options);
// 		debug($taskList);

		//件数取得　select xount(*) from tasks
		//条件の付け方は通常のSELECT文と同じ
// 		$count = $this->Task->find("count", $options);
// 		debug($count);

		//最初の1件取得 select * from tasks WHERE id = 1
// 		$options = array(
// 				"conditions" => array(
// 					"id " => 1
// 				),
// 		);
// 		$taskData = $this->Task->find("first", $options);
// 		debug($taskData);

		//マジックfind
// 		$taskData = $this->Task->findById(1);
// 		$taskData = $this->Task->findAllByStatus(0);

		//queryメソッド(直接SQLを叩く)
		$sql = "SELECT * FROM tasks WHERE id IN(1,3,5)";
		$list = $this->Task->query($sql);
		debug($list);
	}
}