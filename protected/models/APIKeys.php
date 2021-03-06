<?php

/**
 * This is the model class for table "api_keys".
 *
 * The followings are the available columns in table 'api_keys':
 * @property integer $id
 * @property string $api_key
 * @property integer $app_id
 * @property integer $api_status
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property KeyStatuses $apiStatus
 * @property Applications $app
 */
class APIKeys extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return APIKeys the static model class
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
		return 'api_keys';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('api_key, app_id, api_status, created, updated', 'required'),
			array('app_id, api_status', 'numerical', 'integerOnly'=>true),
			array('api_key', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, api_key, app_id, api_status, created, updated', 'safe', 'on'=>'search'),
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
			'apiStatus' => array(self::BELONGS_TO, 'KeyStatuses', 'api_status'),
			'app' => array(self::BELONGS_TO, 'Applications', 'app_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'api_key' => 'Api Key',
			'app_id' => 'App',
			'api_status' => 'Api Status',
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
		$criteria->compare('api_key',$this->api_key,true);
		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('api_status',$this->api_status);
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
