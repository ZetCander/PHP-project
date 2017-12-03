<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\StaffForm;
use \app\models\ProjectForm;
use \app\models\ConnectForm;


class GeneralController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'main';
        
        $this->view->title = 'Главная';
    
        return $this->render('index');
    }
    
       public function actionStatistic(){
        
        $this->view->title = 'Статистические данные';
        
        //общие выплаты, средняя з/п и кол-во сотрудников
        $stat['total'] = (new \yii\db\Query())
                            ->select(['SUM(salary) AS sum' , 'ROUND(AVG(salary)) AS avg'])
                            ->from('staff')
                            ->addSelect('COUNT(id) AS snumb')
                            ->all();
        //количество мужчин и женщин
        $stat['snumber'] = (new \yii\db\Query())
                                    ->select(['COUNT(gender) AS cgen', 'gender'])
                                    ->from('staff')
                                    ->groupBy('gender')
                                    ->all();
        //количество сотрудников по каждой квалификации
        $stat['qual'] = (new \yii\db\Query())
                            ->select(['COUNT(qualification) AS cqual', 'qualification'])
                            ->groupBy('qualification')
                            ->from('staff')
                            ->all();
        //максимальная з/п      
        $temp = (new \yii\db\Query())
                            ->select(['salary'])
                            ->from('staff')
                            ->max('salary');
        $stat['maxsal'] = (new \yii\db\Query())
                            ->select(['id', 'name', 'surname', 'salary'])
                            ->where(['salary' => $temp])
                            ->from('staff')
                            ->all();
        //минимальная з/п
        $temp = (new \yii\db\Query())
                            ->select(['salary'])
                            ->from('staff')
                            ->min('salary');
        $stat['minsal'] = (new \yii\db\Query())
                            ->select(['id', 'name', 'surname', 'salary'])
                            ->where(['salary' => $temp])
                            ->from('staff')
                            ->all();
         
        //максимальный опыт работы
        $stat['maxexp'] = (new \yii\db\Query())
                            ->select(['MAX(experience) AS maxexp', 'id', 'name', 'surname'])
                            ->from('staff')
                            ->all();
        //эффективность сотрудников 
        $stat['effic'] = (new \yii\db\Query())
                            ->select(['efficiency', 'name', 'surname', 'id'])
                            ->from('staff')
                            ->all();
        
        //количество проектов каждого сотрудника
        $stat['staffproj'] = (new \yii\db\Query())
                    ->select(['COUNT({{staff_project}}.project_id) AS pCount'])
                    ->addSelect(['staff.surname', 'staff.name', 'staff.id'])
                    ->innerJoin('staff', '`staff`.`id` = `staff_project`.`staff_id`')
                    ->from('staff_project')
                    ->groupBy($columns = '{{staff_project}}.staff_id')
                    ->all();
        
        return $this->render('statistic', compact(['stat', 'temp']));
    }
}