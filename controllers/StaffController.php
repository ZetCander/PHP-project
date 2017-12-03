<?php

namespace app\controllers;

use app\models\ProjectForm;
use app\models\StaffForm;
use Yii;

class StaffController extends GeneralController{
    
    public function actionCreate(){
        
        $this->view->title = 'Добавить сотрудника';
        
        $employee = new StaffForm();
        $projects = ProjectForm::getprojects();
        
        if( $employee->load(Yii::$app->request->post()) ){
            
            if( $employee->save() ){
                
                $project = ProjectForm::findAll($employee->projects);
            
                foreach ($project as $p)
                {
                    $employee->link('project', $p);
                }
                   
               Yii::$app->session->setFlash('success', 'Данные приняты');        
              return $this->refresh(); 
           }else{
               Yii::$app->session->setFlash('error', 'Ошибка');            
           }   
        }
            return $this->render('create', compact('employee', 'projects'));
    }
    
    public function actionErase(){
        
        $this->view->title = 'Удаление';
        
        $id = Yii::$app->request->get()['name'];
        
        $employee = StaffForm::find()->with('project')->where("id = $id")->one();
        if($employee){
            $employee->delete();
        }
        
        return $this->render('erase', compact(['employee']));
    }
    
    public function actionList(){
        
        $this->view->title = 'Список сотрудников';
        
        $query = StaffForm::find()->orderBy(['surname' => SORT_ASC]);
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 2]);
        $staff = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        return $this->render('list', compact(['pages', 'staff']));
    }
        
    public function actionShow(){
        
        $this->view->title = 'Просмотр';
        
        $id = Yii::$app->request->get()['name'];
    
        $employee = StaffForm::find()->asArray()->with('project')->where("id = $id")->one();
        
        return $this->render('show', compact(['employee']));
    }
    
    public function actionEdit(){
        
        $this->view->title = 'Редактирование';
        
        $id = Yii::$app->request->get()['name'];
        
        $employee = StaffForm::find()->with('project')->where("id = $id")->one();
        $projects = ProjectForm::getprojects();
        
        foreach ($employee->project as $ep){
            $employee->projects[] = $ep->id;
        }
        
        if( $employee->load(Yii::$app->request->post()) ){
                                   
           if( $employee->save()){
               
               $projects = ProjectForm::findAll($employee->projects);

               //описана после всех действий
               self::foredit($projects, $employee);
                       
               Yii::$app->session->setFlash('success', 'Данные приняты');
           return $this->refresh(); 
        }else{
               Yii::$app->session->setFlash('error', 'Ошибка');            
           }
        }

        return $this->render('edit', compact(['employee', 'projects']));
    }
    
    private function foredit($projects, $employee){
        
//          Думаю, что если полностью чистить все связи, а потом заново 
//          создавать, то будет быстрее, но я решил удалять после проверки   
//                foreach ($employee->project as $ep){
//                    $employee->unlink('project', $ep, $delete = true);
//                }
               
                foreach ($projects as $p)
                {
                    //если уже есть связь, то не добавляем
                        if(!in_array($p, $employee->project)){
                            $employee->link('project', $p);
                        }
                }
                
                foreach ($employee->project as $ep)
                {
                    //если связь была, но в полученной форме её нет,
                    //то удаляем её
                        if(!in_array($ep, $projects)){
                            $employee->unlink('project', $ep, $delete = true);
                        }
                }
                
    }
}
