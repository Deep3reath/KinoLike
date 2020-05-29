<?php


namespace app\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class RecommendedWidget extends Widget {
    public $films;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if (($this->films) == null) $this->films = false;
    }

    public function cycleRenderingRecommended($film)
    {
        return $this->render('recommended',
            ['film' => $film]
        );
    }

    public function run()
    {
        if ($this->films == false) return false;
        foreach ($this->films as $film) {
            echo $this->cycleRenderingRecommended($film);
        }
    }
}