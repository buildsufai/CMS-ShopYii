<?php

class Portlet extends CWidget
{
    public $visible = true;

    public function run()
    {
        if($this->visible)
            $this->renderContent();
    }

    protected function renderContent()
    {
        // потомки класса должны переопределять этот метод
        // для рендера необходимого содержимого портлета
    }
}