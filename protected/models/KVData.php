<?php

/**
 * This is the model class for table "kv_data".
 *
 * The followings are the available columns in table 'kv_data':
 * @property string $key
 * @property integer $app_id
 * @property integer $user_id
 * @property string $value
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Applications $app
 * @property Users $user
 */
class KVData extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return KVData the static model class
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
		return 'kv_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key, app_id, user_id, value, created, updated', 'required'),
			array('app_id, user_id', 'numerical', 'integerOnly'=>true),
			array('key', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('key, app_id, user_id, value, created, updated', 'safe', 'on'=>'search'),
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
			'app' => array(self::BELONGS_TO, 'Applications', 'app_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key' => 'Key',
			'app_id' => 'App',
			'user_id' => 'User',
			'value' => 'Value',
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

		$criteria->compare('key',$this->key,true);
		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('value',$this->value,true);
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
