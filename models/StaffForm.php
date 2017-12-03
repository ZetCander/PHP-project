<?php

namespace app\models;
use yii\db\ActiveRecord;

class StaffForm extends ActiveRecord{
    
    public $projects;
    
    public static function tableName(){
        return 'staff';
    }
    
    public function attributeLabels() {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'email' => 'Email',
            'age' => 'Возраст (полных лет)',
            'gender' => 'Пол',
            'efficiency' => 'Эффективность (в %)', 
            'experience' => 'Опыт работы (лет)',
            'qualification' => 'Квалификация',
            'salary' => 'Заработная плата (рублей)',
            'projects' => 'Проекты',
        ];
    }
    
    public function rules(){
        $temp = ['name', 'surname', 'email', 'age', 'gender', 'efficiency', 
                    'qualification', 'salary'];
        return [
            [$temp, 'required'],
            [$temp, 'trim'],
            ['projects', 'trim'],
            [['name', 'surname', 'email'], 'string', 'length' => [2, 30]],
            [['age', 'experience', 'efficiency'], 'number', 'min' => 0, 'max' => 100],
            ['email', 'email'],
            ['experience', 'default', 'value' => 0],
            ['salary', 'number', 'min' => 0, 'max' => 200000],
            ];
    }
    
    public function getstaff(){
        $temp = StaffForm::find()->select(['id', 'name', 'surname', 'email'])->asArray()->all();
        foreach ($temp as $t)
        {    
            $staff[$t['id']] = "${t['name']}" . ' ' . "${t['surname']}" . ', ' . "${t['email']}";
        }
        return $staff;
    }
    
    public function getProject()
    {
        return $this->hasMany(ProjectForm::className(), ['id' => 'project_id'])
                ->viaTable('staff_project', ['staff_id' => 'id']);
    }
}
