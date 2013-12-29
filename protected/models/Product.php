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
 * @property integer $image_id
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
        const YES = 1;
        const NO = 0;
        const UPLOAD_FOLDER = '/upload/product/images/';
        
        public $images;
        
        public function init()
        {
            parent::init();
            // Устанавливаем "Отображать?" при создании Категории по умолчанию "ДА".
            if ($this->isNewRecord) {
                $this->status = self::YES;
            }
        }
        
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
			array('category_id, count, created, image_id, recommended, novelty, status', 'numerical', 'integerOnly'=>true),
			array('price, old_price', 'numerical'),
			array('title, url, full_url, article, meta_title, meta_keywords, meta_desc', 'length', 'max'=>255),
                        array('title, url, article', 'required'),
                        array('full_url', 'unique'),
			array('description', 'safe'),
                        array('images', 'file', 'types' => 'jpg|gif|png', 'allowEmpty' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category_id, title, url, full_url, description, article, price, image_id, count, meta_title, meta_keywords, meta_desc, old_price, recommended, novelty, status', 'safe', 'on'=>'search'),
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
                    'other_images' => array(self::HAS_MANY, 'Image', 'product_id'),
                    'main_image' => array (self::BELONGS_TO, 'Image', 'image_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Категория',
			'title' => 'Заголовок',
			'url' => 'URL',
			'full_url' => 'Полный путь URL',
			'description' => 'Описание',
			'article' => 'Артикул',
			'price' => 'Цена',
			'image_id' => 'Главное изображения',
			'count' => 'Количество',
                        'created' => 'Дата создания',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_desc' => 'Meta Description',
			'old_price' => 'Старая цена',
			'recommended' => 'Рекомендуемый',
			'novelty' => 'Новинка',
			'status' => 'Показать?',
                        'images' => 'Изображения',
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
		$criteria->compare('count',$this->count);
                $criteria->compare('created',$this->created);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('old_price',$this->old_price);
		$criteria->compare('recommended',$this->recommended);
		$criteria->compare('novelty',$this->novelty);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination' => array(
                            'pageSize' => 20,
                        ),
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
        
        // Действия перед сохранением.
        protected function beforeSave()
        {
            // Формируем Дату создания объекта.
            if ($this->isNewRecord) {
                $this->created = time();
            }
 
            return parent::beforeSave();
        }
        
        protected function afterSave() {
            parent::afterSave();
            
            $images = CUploadedFile::getInstances($this, 'images');
            if (isset($images) &&  count($images) > 0)
            {
                foreach($images as $img)
                {
                    $imgType = explode('/', $img->type);
                    $imageName = md5(microtime()) . '.' . $imgType[1];
                    if($img->saveAs($this->getFolder() . $imageName))
                    {
                        $image = new Image();
                        $image->product_id = $this->id;
                        $image->name = $imageName;
                        $image->mime = $img->type;
                        $image->created = time();
                        $image->save();
                        if (!$this->image_id) {
                            $this->image_id = (int)$image->id;
                            $this->updateByPk($this->id, array('image_id'=>$this->image_id));
                        }
                    }
                }
            }
        }
        
        protected function beforeValidate()
        {
            // Формируем full_url.
            $this->full_url = $this->make_full_url();
            
            return parent::beforeValidate();
        }
        
        protected function afterDelete() {
            foreach ($this->other_images as $img) {
                $img->delete();
            }
            
            parent::afterDelete();
        }

        // Функция формирования Полного пути URL.
        public function make_full_url()
        {
            return Category::model()->findByPk($this->category_id)->full_url . '/' . $this->url;
        }
        
        public function getFolder()
        {
            $folder = Yii::getPathOfAlias('webroot') . self::UPLOAD_FOLDER;
            if (is_dir($folder) == false)
                mkdir($folder, 0755, true);
            return $folder;
        }
}