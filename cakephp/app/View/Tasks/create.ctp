<!-- app/View/Tasks/create.ctp -->
<form action="<?php echo $this->Html->url("/Tasks/create");?>" method="POST">
	タスク名：<input type="text" name="name" size="40">
	<br><br>
	<input type="submit" value="タスクを作成">
</form>