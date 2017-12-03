<?php

namespace app\models;
use yii\db\ActiveRecord;

class ConnectForm extends ActiveRecord{
    
    public static function tableName(){
        return 'staff_project';
    }
    
    public function getStaff()
    {
        return $this->hasMany(StaffForm::className(), ['id' => 'staff_id']);
    }
    
    public function getProject()
    {
        return $this->hasMany(ProjectForm::className(), ['id' => 'project_id']);
    }
}