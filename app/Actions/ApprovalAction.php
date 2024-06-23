<?php
namespace App\Actions;

use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Array_;
use TCG\Voyager\Actions\AbstractAction;
use function League\Flysystem\toArray;

class ApprovalAction extends AbstractAction
{
    public function getTitle()
    {
        // Action title which display in button based on current status
        return $this->data->{'status'}==0?'Approved':'Disapprove';
    }

    public function getIcon()
    {
        // Action icon which display in left of button based on current status
        return $this->data->{'status'}==0?'voyager-x':'voyager-external';
    }

    public function getPolicy()
    {
        return 'edit';
    }
    public function getAttributes()
    {
        // Action button class
        return [
            'class' => 'btn btn-sm btn-primary pull-right ',
            'style' => 'margin-right:4px'
        ];
    }

    public function shouldActionDisplayOnDataType()
    {
        // show or hide the action button, in this case will show for posts model
        return in_array($this->dataType->slug, ['online-admissions']);

    }

   public function getDefaultRoute()
    {
        return route($this->dataType->slug . '.approve', array("id" => $this->data->{$this->data->getKeyName()}));

    }
}

