<?php

namespace marqu3s\itam\models;

use marqu3s\itam\Module;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "itam_os_license".
 *
 * @property integer $id
 * @property integer $id_os
 * @property string $key
 * @property integer $allowed_activations
 * @property integer $digital_license
 * @property string $date
 *
 * @property Os $os
 */
class OsLicense extends ActiveRecord
{
    public $licensesInUse;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'itam_os_license';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_os'], 'required'],
            [['id_os', 'allowed_activations', 'digital_license'], 'integer'],
            [['key'], 'string', 'max' => 50],
            [['date'], 'string', 'max' => 10],
            [['id_os'], 'exist', 'skipOnError' => true, 'targetClass' => Os::className(), 'targetAttribute' => ['id_os' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('model', 'ID'),
            'id_os' => Module::t('model', 'OS'),
            'key' => Module::t('model', 'Activation key'),
            'allowed_activations' => Module::t('model', 'Allowed activations'),
            'digital_license' => Module::t('model', 'Digital license'),
            'date' => Module::t('model', 'Accquisition date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOs()
    {
        return $this->hasOne(Os::className(), ['id' => 'id_os']);
    }


    public function getLicensesInUse()
    {
        $workstationCount = AssetWorkstation::find()->where(['id_os_license' => $this->id])->count();
        $serverCount = AssetServer::find()->where(['id_os_license' => $this->id])->count();

        return $workstationCount + $serverCount;
    }

    /**
     * @inheritdoc
     * @return OsLicenseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OsLicenseQuery(get_called_class());
    }
}