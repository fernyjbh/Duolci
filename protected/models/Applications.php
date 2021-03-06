<?php

/**
 * This is the model class for table "applications".
 *
 * The followings are the available columns in table 'applications':
 * @property integer $id
 * @property string $app_id
 * @property string $app_name
 * @property integer $developer_id
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property ApiKeys[] $apiKeys
 * @property Developers $developer
 */
class Applications extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Applications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'applications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, app_name, developer_id, created, updated', 'required'),
			array('developer_id', 'numerical', 'integerOnly'=>true),
			array('app_id', 'length', 'max'=>64),
			array('app_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, app_name, developer_id, created, updated', 'safe', 'on'=>'search'),
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
			'apiKeys' => array(self::HAS_MANY, 'ApiKeys', 'app_id'),
			'developer' => array(self::BELONGS_TO, 'Developers', 'developer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'app_id' => 'App',
			'app_name' => 'App Name',
			'developer_id' => 'Developer',
			'created' => 'Created',
			'updated' => 'Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('app_name',$this->app_name,true);
		$criteria->compare('developer_id',$this->developer_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeValidate()
	{
	        if ($this->isNewRecord)
                        $this->created = new CDbExpression('NOW()');
                        
	        $this->updated = new CDbExpression('NOW()');	         
	        return parent::beforeSave();
	}
	
}
