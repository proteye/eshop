<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $url
 * @property string $full_url
 * @property string $content
 * @property string $title_menu
 * @property string $image
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_desc
 * @property integer $created
 * @property integer $sort
 * @property integer $status
 */
class Category extends CActiveRecord
{
        const YES = 1;
        const NO = 0;
        private $tree; // массив Категорий в виде дерево для выпадающего списка.
        
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
		return '{{category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('parent_id', 'compare', 'operator'=>'!=', 'compareAttribute'=>'id'),
                        array('title, url', 'required'),
                        array('full_url', 'unique'),
			array('parent_id, created, sort, status', 'numerical', 'integerOnly'=>true),
			array('title, url, full_url, title_menu, meta_title, meta_keywords, meta_desc', 'length', 'max'=>255),
                        array('image', 'file', 'types' => 'jpg|gif|png', 'allowEmpty' => true),
			array('content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, title, url, full_url, content, title_menu, meta_title, meta_keywords, meta_desc, created, sort, status', 'safe', 'on'=>'search'),
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
                    'products' => array(self::HAS_MANY, 'Product', 'category_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Родительская категория',
			'title' => 'Заголовок',
			'url' => 'URL адрес',
			'full_url' => 'Полный адрес URL',
			'content' => 'Описание',
			'title_menu' => 'Заголовок меню',
                        'image' => 'Изображение',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_desc' => 'Meta Description',
			'created' => 'Дата создания',
			'sort' => 'Порядок сортировки',
			'status' => 'Отображать?',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('full_url',$this->full_url,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('title_menu',$this->title_menu,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
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
        
        protected function beforeValidate()
        {
            // Формируем full_url.
            $this->full_url = $this->make_full_url();
            
            return parent::beforeValidate();
        }

        // Функция формирования Полного пути URL.
        public function make_full_url()
        {
            if ($this->parent_id == 0)
                return 'catalog/' . $this->url;
            
            return self::model()->findByPk($this->parent_id)->full_url . '/' . $this->url;
        }
        
        // Вытащить переменную массив $tree.
        public function getTree()
        {
            return $this->tree;
        }
        
        // Формирование списка Категорий для dropDownList.
	public static function listCategory($map, $shift = 0, $first_null = false)
	{
            if(!empty($map))
            {
                if ($first_null && !Category::model()->tree[0])
                    Category::model()->tree[0] = '-';
                foreach ($map as $page) {
                    for ($i = 0; $i < $shift; $i++)
                        Category::model()->tree[$page['id']] .= '_';
                    Category::model()->tree[$page['id']] .= $page['label'];
                    Category::listCategory($page['items'], $shift + 2);
                }
            }
            else
            {
                Category::model()->tree[0] = '-';
            }
	}
        
        // Построение дерева Категорий для создания иерархического Меню.
        public static function make_tree($start_level = 0, $hierarchy = true)
        {
            $pages = Category::model()->findAll("parent_id=$start_level ORDER BY sort ASC");
            $map = array();

            foreach ($pages as $page) {
                $title = $page->title_menu ? $page->title_menu : $page->title;
                $active = ($page->full_url === Yii::app()->request->pathInfo);
                $array[] = array('id' => $page->id, 'label' => $title, 'url' => array('site/categ', 'full_url' => $page->full_url), 'active' => $active);
            }
            
            if (!$hierarchy)
                return $array;
                
            if(!empty($array))
                foreach($array as $page) {
                    $page['items'] = Category::make_tree($page['id']);
                    $map[] = $page;
                }
            
            return $map;
        }
}