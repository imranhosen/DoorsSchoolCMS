<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class ForceDeleteAction extends AbstractAction
{
    public function getTitle()
    {
        //return __('voyager::generic.delete');
        return 'Trash';
    }

    public function getIcon()
    {
        return 'voyager-trash';
    }

    public function getPolicy()
    {
        return 'restore';
    }

   /* public function getPolicy()
    {
        return 'read';w
    }*/

    public function getAttributes()
    {
        return [
            'class'   => 'btn btn-sm btn-danger pull-right forceDelete',
            'data-id' => $this->data->{$this->data->getKeyName()},
            'id'      => 'forceDelete-'.$this->data->{$this->data->getKeyName()},
            'style' => 'margin-right:4px'
        ];
    }

    public function shouldActionDisplayOnDataType()
    {
        return in_array($this->dataType->slug, ['subjects' , 'feemasters' , 'fee-groups', 'feetypes' , 'fees-discounts' , 'enquiries',
            'complain-types' , 'purposes' , 'references', 'sources' , 'visitor-books' , 'general-calls', 'dispatch-send' ,
            'dispatch-receive' , 'complains', 'income-heads' , 'incomes' , 'expense-heads', 'expenses' , 'item-stocks' , 'items' ,
            'item-stores', 'item-suppliers' , 'item-categories' , 'item-issues', 'contents' , 'content-types' , 'class-teachers',
            'timetables' , 'teacher-subjects' , 'student-promotes', 'exams' , 'exam-schedules', 'staff-payslip', 'staff-payroll' ,
            'staff' , 'designations', 'departments', 'leave-types', 'staff-leave-request', 'staff-leave-details', 'staff-attendances',
            'students', 'incomes', 'clases', 'groups', 'sessions', 'student-fees', 'lessons', 'class-topics', 'grades', 'books',
            'book-issues', 'homework', 'certificates', 'id-cards', 'posts', 'categories', 'attendence-types', 'student-attendances',
            'student-documents', 'events', 'front-cms-media-gallery', 'front-cms-news', 'front-cms-pages', 'front-banner-images',
            'roles', 'users', 'exam-marks' , 'sections', 'governing-members','gallery-videos','online-admissions','student-categories',
            'student-houses','disable-reasons']);
   /*     return $this->dataType->slug == 'subjects' || $this->dataType->slug == 'feemasters' || $this->dataType->slug == 'fee-groups'
            || $this->dataType->slug == 'feetypes' || $this->dataType->slug == 'fees-discounts' || $this->dataType->slug == 'enquiries'
            || $this->dataType->slug == 'complain-types' || $this->dataType->slug == 'purposes' || $this->dataType->slug == 'references'
            || $this->dataType->slug == 'sources' || $this->dataType->slug == 'visitor-books' || $this->dataType->slug == 'general-calls'
            || $this->dataType->slug == 'dispatch-send' || $this->dataType->slug == 'dispatch-receive' || $this->dataType->slug == 'complains'
            || $this->dataType->slug == 'income-heads' || $this->dataType->slug == 'incomes' || $this->dataType->slug == 'expense-heads'
            || $this->dataType->slug == 'expenses' || $this->dataType->slug == 'item-stocks' || $this->dataType->slug == 'items' || $this->dataType->slug == 'item-stores'
            || $this->dataType->slug == 'item-suppliers' || $this->dataType->slug == 'item-categories' || $this->dataType->slug == 'item-issues'
            || $this->dataType->slug == 'contents' || $this->dataType->slug == 'content-types' || $this->dataType->slug == 'class-teachers'
            || $this->dataType->slug == 'timetables' || $this->dataType->slug == 'teacher-subjects' || $this->dataType->slug == 'student-promotes'
            || $this->dataType->slug == 'exams' || $this->dataType->slug == 'exam-schedules'|| $this->dataType->slug == 'staff-payslip'
            || $this->dataType->slug == 'staff-payroll' || $this->dataType->slug == 'staff' || $this->dataType->slug == 'designations'
            || $this->dataType->slug == 'departments'|| $this->dataType->slug == 'leave-types'|| $this->dataType->slug == 'staff-leave-request'
            || $this->dataType->slug == 'staff-leave-details'|| $this->dataType->slug == 'staff-attendances'|| $this->dataType->slug == 'students'
            || $this->dataType->slug == 'incomes'|| $this->dataType->slug == 'clases'|| $this->dataType->slug == 'groups'|| $this->dataType->slug == 'sessions'
            || $this->dataType->slug == 'student-fees'|| $this->dataType->slug == 'lessons'|| $this->dataType->slug == 'class-topics'
            || $this->dataType->slug == 'grades'|| $this->dataType->slug == 'books'|| $this->dataType->slug == 'book-issues'|| $this->dataType->slug == 'homework'
            || $this->dataType->slug == 'certificates'|| $this->dataType->slug == 'id-cards'|| $this->dataType->slug == 'posts'|| $this->dataType->slug == 'categories'
            || $this->dataType->slug == 'attendence-types'|| $this->dataType->slug == 'student-attendances'|| $this->dataType->slug == 'student-documents'
            || $this->dataType->slug == 'events'|| $this->dataType->slug == 'front-cms-media-gallery'|| $this->dataType->slug == 'front-cms-news'
            || $this->dataType->slug == 'front-cms-pages'|| $this->dataType->slug == 'front-banner-images'|| $this->dataType->slug == 'roles'
            || $this->dataType->slug == 'users'|| $this->dataType->slug == 'exam-marks' || $this->dataType->slug == 'sections';*/
    }

    public function getDefaultRoute()
    {
        return 'javascript:;';
        //return route($this->dataType->slug . '.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));

/*      if ($this->dataType->slug == 'subjects') {
          return route('subjects.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'contents') {
          return route('contents.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'teacher-subjects') {
          return route('teacher-subjects.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'student-promotes') {
          return route('student-promotes.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'class-teachers') {
          return route('class-teachers.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'timetables') {
          return route('timetables.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'content-types') {
          return route('content-types.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'item-issues') {
          return route('item-issues.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'item-stocks') {
          return route('item-stocks.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'items') {
          return route('items.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'item-stores') {
          return route('item-stores.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'item-suppliers') {
          return route('item-suppliers.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'item-categories') {
          return route('item-categories.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'income-heads') {
          return route('income-heads.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'incomes') {
          return route('incomes.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'expense-heads') {
          return route('expense-heads.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'expenses') {
          return route('expenses.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'visitor-books') {
          return route('visitor-books.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'general-calls') {
          return route('general-calls.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'dispatch-send') {
          return route('dispatch-send.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'dispatch-receive') {
          return route('dispatch-receive.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }else if ($this->dataType->slug == 'complains') {
          return route('complains.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }elseif ($this->dataType->slug == 'enquiries'){
          return route('enquiries.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }elseif ($this->dataType->slug == 'complain-types'){
          return route('complain-types.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }elseif ($this->dataType->slug == 'purposes'){
          return route('purposes.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }elseif ($this->dataType->slug == 'references'){
          return route('references.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }elseif ($this->dataType->slug == 'sources'){
          return route('sources.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }elseif ($this->dataType->slug == 'feemasters'){
        return route('feemasters.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
       }elseif ($this->dataType->slug == 'fee-groups'){
          return route('fee-groups.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }elseif ($this->dataType->slug == 'feetypes'){
          return route('feetypes.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }elseif ($this->dataType->slug == 'fees-discounts'){
          return route('fees-discounts.forceDelete', array("id" => $this->data->{$this->data->getKeyName()}));
      }
      else{
            redirect()->back();
        }*/


    }
}
