<?php $this->pageTitle=Yii::app()->name; ?>

<h1>ברוכים הבאים למסך עדכון הגדרות של מערכת ה-BI </h1>

<h3>
    
    <?php 
    if (Yii::app()->user->isGuest)
    {
        echo CHtml::link('לחץ כאן כדי להתחבר','index.php?r=site/login');
    }
    else
    {
        echo 'הנך מחובר למערכת, לחץ על האפשרות הרצויה מהתפריט בצד ימין';
    }
                ?>
</h3>