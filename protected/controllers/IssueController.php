<?php

class IssueController extends Controller
{
	/**
	* @var private property containing the associated Project model
	instance.
	*/
	private $_project = null;
	/**
	* Protected method to load the associated Project model class
	* @project_id the primary identifier of the associated Project
	* @return object the Project data model based on the primary key
	*/
	protected function loadProject($project_id) {
	//if the project property is null, create it based on input id
	if($this->_project===null)
	{
	$this->_project=Project::model()->findbyPk($project_id);
	if($this->_project===null)
	{
	throw new CHttpException(404,'The requested project does not
	exist.');
	}

	}
	return $this->_project;
	}
	
	/**
* In-class defined filter method, configured for use in the above
filters() method
* It is called before the actionCreate() action method is run in
order to ensure a proper project context
*/
public function filterProjectContext($filterChain)
{
//set the project identifier based on either the GET or POST input
//request variables, since we allow both types for our actions
$projectId = null;
if(isset($_GET['pid']))
$projectId = $_GET['pid'];
else
if(isset($_POST['pid']))
$projectId = $_POST['pid'];
$this->loadProject($projectId);
//complete the running of other filters and execute the requested action
$filterChain->run();
}

	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			//'projectContext + create', //check to ensure valid project context
			'projectContext + create index admin', //perform a check to ensure valid project context
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/* public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	} */

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$issue=$this->loadModel($id);
		$comment=$this->createComment($issue);
		$this->render('view',array(
		'model'=>$issue,
		'comment'=>$comment,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Issue;
		$model->project_id = $this->_project->id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Issue']))
		{
			$model->attributes=$_POST['Issue'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Issue']))
		{
			$model->attributes=$_POST['Issue'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Issue', array(
		'criteria'=>array(
		'condition'=>'project_id=:projectId','params'=>array(':projectId'=>$this->_project->id),
		),
		));
		// $dataProvider=new CActiveDataProvider('Issue');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Issue('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Issue']))
			$model->attributes=$_GET['Issue'];
	$model->project_id = $this->_project->id;
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Issue the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Issue::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Issue $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='issue-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	* Returns the project model instance to which this issue belongs
	*/
	public function getProject()
	{
	return $this->_project;
	}
	
	/**
	* Creates a new comment on an issue
	*/
	protected function createComment($issue)
	{
		$comment=new Comment;
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if($issue->addComment($comment))
			{
				Yii::app()->user->setFlash('commentSubmitted',"Your comment has been added." );
				$this->refresh();
			}
		}
		return $comment;
	}
}
