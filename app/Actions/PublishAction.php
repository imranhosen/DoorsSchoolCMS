<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class PublishAction extends AbstractAction
{
    public function getTitle()
    {
// Action title which display in button based on current status
        return $this->data->{'status'} == 0 ? 'Publish' : 'Unpublish';
    }

    public function getIcon()
    {
// Action icon which display in left of button based on current status
        return $this->data->{'status'} == 0 ? 'voyager-x' : 'voyager-external';
    }

    public function getAttributes()
    {
// Action button class
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
            'style' => 'margin-right:4px'
        ];
    }

    public function shouldActionDisplayOnDataType()
    {
// show or hide the action button, in this case will show for posts model
//return $this->dataType->slug == 'posts';
        return in_array($this->dataType->slug, ['posts', 'exams']);
    }

    public function getDefaultRoute()
    {
// URL for action button when click
        return route($this->dataType->slug . '.publish', array("id" => $this->data->{$this->data->getKeyName()}));
//return route('posts.publish', array("id"=>$this->data->{$this->data->getKeyName()}));
    }
}
