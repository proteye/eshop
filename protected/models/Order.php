<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property integer $id
 * @property string $order_content
 * @property double $summ
 * @property integer $user_id
 * @property integer $delivery_id
 * @property double $delivery_cost
 * @property integer $payment_id
 * @property integer $status_id
 * @property integer $created
 * @property integer $closing_date
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $comment
 * @property string $legal_info
 * @property integer $confirm
 * @property integer $paid
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, delivery_id, payment_id, status_id, created, closing_date, confirm, paid', 'numerical', 'integerOnly'=>true),
			array('summ, delivery_cost', 'numerical'),
			array('name, email, phone, address, legal_info', 'length', 'max'=>255),
			array('order_content, comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_content, summ, user_id, delivery_id, delivery_cost, payment_id, status_id, created, closing_date, name, email, phone, address, comment, legal_info, confirm, paid', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_content' => 'Order Content',
			'summ' => 'Summ',
			'user_id' => 'User',
			'delivery_id' => 'Delivery',
			'delivery_cost' => 'Delivery Cost',
			'payment_id' => 'Payment',
			'status_id' => 'Status',
			'created' => 'Created',
			'closing_date' => 'Closing Date',
			'name' => 'Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'address' => 'Address',
			'comment' => 'Comment',
			'legal_info' => 'Legal Info',
			'confirm' => 'Confirm',
			'paid' => 'Paid',
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
		$criteria->compare('order_content',$this->order_content,true);
		$criteria->compare('summ',$this->summ);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('delivery_id',$this->delivery_id);
		$criteria->compare('delivery_cost',$this->delivery_cost);
		$criteria->compare('payment_id',$this->payment_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('created',$this->created);
		$criteria->compare('closing_date',$this->closing_date);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('legal_info',$this->legal_info,true);
		$criteria->compare('confirm',$this->confirm);
		$criteria->compare('paid',$this->paid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
