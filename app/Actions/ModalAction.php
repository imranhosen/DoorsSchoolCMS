<?php
namespace App\Actions;

use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Array_;
use TCG\Voyager\Actions\AbstractAction;
use function League\Flysystem\toArray;

class ModalAction extends AbstractAction
{
    public function getTitle()
    {
        // Action title which display in button based on current status
        return $this->data->{'status'}==0?'Disabled':'Show Certificate';
    }

    public function getIcon()
    {
        // Action icon which display in left of button based on current status
        return $this->data->{'status'}==0?'voyager-x':'voyager-eye';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function shouldActionDisplayOnDataType()
    {
        // show or hide the action button
        return $this->dataType->slug == 'certificates';

    }
    /* public function massAction($ids, $comingFrom)
     {
         // Do something with the IDs
         return redirect($comingFrom);
     }*/
    public function getAttributes()
    {
        return [
            'class'   => 'btn btn-sm btn-info pull-right certificateModal',
            'data-id' => $this->data->{$this->data->getKeyName()},
            'id'      => 'modal-'.$this->data->{$this->data->getKeyName()},
            'data-modal_id' => 'myModal-'.$this->data->{$this->data->getKeyName()},
        ];
    }

    public function getDefaultRoute()
    {
        return 'javascript:;';
    }
}

