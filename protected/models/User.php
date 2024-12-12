<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $last_login_time
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property TblIssue[] $tblIssues
 * @property TblIssue[] $tblIssues1
 * @property TblProject[] $tblProjects
 */
class User extends TrackStarActiveRecord
{	
	
	public $password_repeat;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, username, password,password_repeat', 'required'),
			// array('create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('email, username, password', 'length', 'max'=>256),
			array('password', 'compare', 'compareAttribute'=>'password_repeat'),
			array('password_repeat', 'safe'),
			array('email, username', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, username, password,password_repeat, last_login_time, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tblIssues' => array(self::HAS_MANY, 'TblIssue', 'requester_id'),
			'tblIssues1' => array(self::HAS_MANY, 'TblIssue', 'owner_id'),
			'tblProjects' => array(self::MANY_MANY, 'TblProject', 'tbl_project_user_assignment(user_id, project_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'username' => 'Username',
			'password' => 'Password',
			'last_login_time' => 'Last Login Time',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User ID',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
		// public function behaviors()
		// {
			// return array(
			// 'CTimestampBehavior' => array(
			// 'class' => 'zii.behaviors.CTimestampBehavior',
			// 'createAttribute' => 'create_time',
			// 'updateAttribute' => 'update_time',
			// 'setUpdateOnCreate' => true,
			// ),
			// );
		// }
		
		/**
		* apply a hash on the password before we store it in the database
		*/
		protected function afterValidate()
		{
			parent::afterValidate();
			if(!$this->hasErrors())
			$this->password = $this->hashPassword($this->password);
		}
		
		/**
		* Generates the password hash.
		* @param string password
		* @return string hash
		*/
		public function hashPassword($password)
		{
			return md5($password);
		}
		
		/**
	* Checks if the given password is correct.
	* @param string the password to be validated
	* @return boolean whether the password is valid
	*/
	public function validatePassword($password)
	{
	return $this->hashPassword($password)===$this->password;
	}
	
}
