<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property integer $role_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property integer $created
 * @property integer $status
 */
class User extends CActiveRecord
{
        const YES = 1;
        const NO = 0;
        const SALT = 'ad5lu9$er@7h';
        const ROLE_ADMIN = 'admin';
        const ROLE_MODER = 'moderator';
        const ROLE_USER = 'user';
        const ROLE_BANNED = 'banned';
        public $confirm_password;
        
        public function init()
        {
            parent::init();
            // Устанавливаем "Отображать?" при создании Категории по умолчанию "ДА".
            if ($this->isNewRecord) {
                $this->status = self::YES;
                $this->role_id = 3;
            }
        }
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, created, status', 'numerical', 'integerOnly'=>true),
			array('login, password, name, email, phone', 'length', 'max'=>255),
                        array('login', 'required'),
			array('password', 'required', 'on'=>'insert, change_password'),
                        array('confirm_password', 'compare', 'operator'=>'==', 'compareAttribute'=>'password', 'on'=>'insert, change_password'),
			array('address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, password, role_id, name, email, phone, address, created, status', 'safe', 'on'=>'search'),
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
                    'role' => array(self::BELONGS_TO, 'Role', 'role_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Логин',
			'password' => 'Пароль',
                        'confirm_password' => 'Подтвреждение пароля',
			'role_id' => 'Роль',
			'name' => 'Имя',
			'email' => 'Email',
			'phone' => 'Телефон',
			'address' => 'Адрес',
			'created' => 'Дата создания',
			'status' => 'Включен?',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('status',$this->status);

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
        
        protected function beforeSave()
        {
                if ($this->isNewRecord) {
                    $this->created = time();
                }
                
                if (isset($this->password))
                    $this->password = md5(SALT . $this->password);
                
                return parent::beforeSave();
        }
}
