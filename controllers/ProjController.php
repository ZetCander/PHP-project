<?php

namespace app\controllers;

use app\models\ProjectForm;
use app\models\StaffForm;
use Yii;

class ProjController extends GeneralController{
    
    public function actionCreate(){
        
        $this->view->title = 'Добавить проект';
        $project = new ProjectForm();
              
        $staff = StaffForm::getstaff();
        
        if( $project->load(Yii::$app->request->post()) ){
            
            if( $project->save() ){
                $staff = StaffForm::findAll($project->thestaff);
                
            foreach ($staff as $s)
            {
                $project->link('staff', $s);
            }
            
                    
               Yii::$app->session->setFlash('success', 'Данные приняты');        
              return $this->refresh(); 
           }else{
               Yii::$app->session->setFlash('error', 'Ошибка');            
           }   
        }
            return $this->render('create', compact('staff', 'project'));
    }
    
    public function actionErase(){
        
        $this->view->title = 'Удаление';
        $id = Yii::$app->request->get()['name'];
       
        $project = ProjectForm::find()->with('staff')->where("id = $id")->one();
        if($project){
            $project->delete();
        }
        
        return $this->render('erase', compact(['project']));
    }

    
    public function actionList(){
        
        $this->view->title = 'Список проектов';
        
        $project = ProjectForm::find()->orderBy(['pname' => SORT_ASC])->all();   
        
        return $this->render('list', compact(['project']));
    }
        
    public function actionShow(){
        
        $this->view->title = 'Просмотр';
        
        $id = Yii::$app->request->get()['name'];
    
        $project = ProjectForm::find()->asArray()->with('staff')->where("id = $id")->one();
        
        return $this->render('show', compact(['project']));
    }
    
    public function actionEdit(){
        
        $this->view->title = 'Редактирование';
        
        $id = Yii::$app->request->get()['name'];
        
        $project = ProjectForm::find()->with('staff')->where("id = $id")->one();
        //получаем данные о всех сотрудниках
        $staff = StaffForm::getstaff();
        
        //заполняем поле связей 
        foreach ($project->staff as $ps){
            $project->thestaff[] = $ps->id;
        }
        
        if( $project->load(Yii::$app->request->post()) ){
                                   
           if( $project->save()){
               //вместо всех сотрудников теперь хранит данные о сотрудниках 
               //из полученной формы
               $staff = StaffForm::findAll($project->thestaff);
               //описана после всех действий
               self::foredit($project, $staff);
                        
               Yii::$app->session->setFlash('success', 'Данные приняты');
           return $this->refresh(); 
        }else{
               Yii::$app->session->setFlash('error', 'Ошибка');            
           }
        }
        return $this->render('edit', compact(['staff', 'project']));
    }
    
     private function foredit($project, $staff){
        
//          Думаю, что если полностью чистить все связи, а потом заново 
//          создавать, то будет быстрее, но я решил удалять после проверки   
//                foreach ($project->staff as $ps){
//                    $employee->unlink('staff', $ps, $delete = true);
//                }
               
                foreach ($staff as $s)
                {
                    //если уже есть связь, то не добавляем
                        if(!in_array($s, $project->staff)){
                            $project->link('staff', $s);
                        }
                }
                
                foreach ($project->staff as $ps)
                {
                    //если связь была, но в полученной форме её нет,
                    //то удаляем её
                        if(!in_array($ps, $staff)){
                            $project->unlink('staff', $ps, $delete = true);
                         }
                }
                
    }
}
