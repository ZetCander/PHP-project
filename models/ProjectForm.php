<?php

namespace app\models;
use yii\db\ActiveRecord;

class ProjectForm extends ActiveRecord{
    
    public $thestaff;
    
    public static function tableName(){
        return 'project';
    }

    public function attributeLabels() {
        return [
            'pname' => 'Название проекта',
            'description' => 'Описание проекта',
            'thestaff' => 'Участники проекта'
           ];
    }
    
    public function rules(){
        return [
            ['pname', 'required'],
            [['pname', 'description'], 'trim'],
            ['pname', 'string', 'length' => [1, 30]],
            ['thestaff', 'trim']
            ];
    }
    
    public function getStaff()
    {
        return $this->hasMany(StaffForm::className(), ['id' => 'staff_id'])
                ->viaTable('staff_project', ['project_id' => 'id']);
    }
    
    public function getprojects(){
        $temp = ProjectForm::find()->select(['id', 'pname'])->asArray()->all();
        foreach ($temp as $t)
        {    
            $proj[$t['id']] = "${t['pname']}";
        }
        return $proj;
    }
}
