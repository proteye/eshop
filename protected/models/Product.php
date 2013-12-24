<?php

/**
 * This is the model class for table "{{product}}".
 *
 * The followings are the available columns in table '{{product}}':
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $url
 * @property string $full_url
 * @property string $description
 * @property string $article
 * @property double $price
 * @property string $image_url
 * @property integer $count
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_desc
 * @property double $old_price
 * @property integer $recommended
 * @property integer $novelty
 * @property integer $status
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, count, recommended, novelty, status', 'numerical', 'integerOnly'=>true),
			array('price, old_price', 'numerical'),
			array('title, url, full_url, article, image_url, meta_title, meta_keywords, meta_desc', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category_id, title, url, full_url, description, article, price, image_url, count, meta_title, meta_keywords, meta_desc, old_price, recommended, novelty, status', 'safe', 'on'=>'search'),
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
			'category_id' => 'Category',
			'title' => 'Title',
			'url' => 'Url',
			'full_url' => 'Full Url',
			'description' => 'Description',
			'article' => 'Article',
			'price' => 'Price',
			'image_url' => 'Image Url',
			'count' => 'Count',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_desc' => 'Meta Desc',
			'old_price' => 'Old Price',
			'recommended' => 'Recommended',
			'novelty' => 'Novelty',
			'status' => 'Status',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('full_url',$this->full_url,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('article',$this->article,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('count',$this->count);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('old_price',$this->old_price);
		$criteria->compare('recommended',$this->recommended);
		$criteria->compare('novelty',$this->novelty);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
