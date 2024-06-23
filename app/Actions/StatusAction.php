<?php
namespace App\Actions;

use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Array_;
use TCG\Voyager\Actions\AbstractAction;
use function League\Flysystem\toArray;

class StatusAction extends AbstractAction
{
    public function getTitle()
    {
        // Action title which display in button based on current status
        return $this->data->{'status'}==0?'Active':'Deactive';
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
        return in_array($this->dataType->slug, ['sessions' , 'clases' , 'groups' , 'subjects','grades', 'leave-types',
            'students' , 'student-documents' , 'exam-schedules', 'designations' ,'departments' , 'homework','lessons' , 'class-topics' ,
            'events', 'feemasters' , 'fee-groups' , 'feetypes', 'fees-discounts' , 'complain-types' , 'purposes', 'sources' , 'references' ,
            'enquiries', 'visitor-books' , 'general-calls' , 'dispatch-send', 'dispatch-receive' , 'complains' , 'income-heads', 'incomes-send',
            'expense-heads' , 'expenses', 'staff' , 'item-stocks' , 'items' , 'item-stores', 'item-suppliers' , 'item-categories'  , 'item-issues',
            'contents' , 'content-types' , 'class-teachers', 'timetables' , 'teacher-subjects' , 'student-promotes', 'staff-payslip', 'staff-payroll' ,
            'staff-leave-request', 'staff-leave-details', 'staff-attendances' , 'categories', 'incomes', 'roles' , 'student-fees' , 'books',
            'book-issues', 'certificates', 'id-cards' , 'attendence-types', 'student-attendances' , 'front-cms-pages', 'front-banner-images',
            'exam-marks', 'front-cms-news', 'sections','front-cms-media-gallery','governing-members','gallery-videos','student-categories',
            'student-houses','disable-reasons']);
        /*return $this->dataType->slug == 'sessions' || $this->dataType->slug == 'clases' || $this->dataType->slug == 'groups' || $this->dataType->slug == 'subjects'
            || $this->dataType->slug =='grades' || $this->dataType->slug == 'exams' || $this->dataType->slug == 'leave-types'
            || $this->dataType->slug == 'students' || $this->dataType->slug == 'student-documents' || $this->dataType->slug == 'exam-schedules'
            || $this->dataType->slug == 'designations' || $this->dataType->slug =='departments' || $this->dataType->slug == 'homework'
            || $this->dataType->slug =='lessons' || $this->dataType->slug == 'class-topics' || $this->dataType->slug == 'events'
            || $this->dataType->slug == 'feemasters' || $this->dataType->slug == 'fee-groups' || $this->dataType->slug == 'feetypes'
            || $this->dataType->slug == 'fees-discounts' || $this->dataType->slug == 'complain-types' || $this->dataType->slug == 'purposes'
            || $this->dataType->slug == 'sources' || $this->dataType->slug == 'references' || $this->dataType->slug == 'enquiries'
            || $this->dataType->slug == 'visitor-books' || $this->dataType->slug == 'general-calls' || $this->dataType->slug == 'dispatch-send'
            || $this->dataType->slug == 'dispatch-receive' || $this->dataType->slug == 'complains' || $this->dataType->slug == 'income-heads'
            || $this->dataType->slug == 'incomes-send' || $this->dataType->slug == 'expense-heads' || $this->dataType->slug == 'expenses'
            || $this->dataType->slug == 'staff' || $this->dataType->slug == 'item-stocks' || $this->dataType->slug == 'items' || $this->dataType->slug == 'item-stores'
            || $this->dataType->slug == 'item-suppliers' || $this->dataType->slug == 'item-categories'  || $this->dataType->slug == 'item-issues'
            || $this->dataType->slug == 'contents' || $this->dataType->slug == 'content-types' || $this->dataType->slug == 'class-teachers'
            || $this->dataType->slug == 'timetables' || $this->dataType->slug == 'teacher-subjects' || $this->dataType->slug == 'student-promotes'
            || $this->dataType->slug == 'staff-payslip'|| $this->dataType->slug == 'staff-payroll' || $this->dataType->slug == 'staff-leave-request'
            || $this->dataType->slug == 'staff-leave-details'|| $this->dataType->slug == 'staff-attendances' || $this->dataType->slug == 'categories'
            || $this->dataType->slug == 'incomes'|| $this->dataType->slug == 'roles' || $this->dataType->slug == 'student-fees' || $this->dataType->slug == 'books'|| $this->dataType->slug == 'book-issues'
            || $this->dataType->slug == 'certificates'|| $this->dataType->slug == 'id-cards' || $this->dataType->slug == 'attendence-types'
            || $this->dataType->slug == 'student-attendances' || $this->dataType->slug == 'front-cms-pages'|| $this->dataType->slug == 'front-banner-images'
            || $this->dataType->slug == 'exam-marks'|| $this->dataType->slug == 'front-cms-news'|| $this->dataType->slug == 'sections'
            ;*/


      // return $this->dataType->slug == 'groups' || $this->dataType->slug == 'subjects';

       /* if ($this->dataType->slug == 'groups'){
            return $this->dataType;
        }elseif ($this->dataType->slug == 'subjects'){
            return $this->dataType;
        }else{
            redirect()->back();
        }*/
        //return $this->dataType->slug == 'groups' || 'subjects';

    }
   /* public function massAction($ids, $comingFrom)
    {
        // Do something with the IDs
        return redirect($comingFrom);
    }*/

   public function getDefaultRoute()
    {
        return route($this->dataType->slug . '.active', array("id" => $this->data->{$this->data->getKeyName()}));

        // URL for action button when click
        /*if ($this->dataType->slug == 'students') {
            return route('students.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'contents') {
            return route('contents.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'teacher-subjects') {
            return route('teacher-subjects.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'student-promotes') {
            return route('student-promotes.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'class-teachers') {
            return route('class-teachers.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'timetables') {
            return route('timetables.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'content-types') {
            return route('content-types.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'staff') {
            return route('staff.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'item-issues') {
            return route('item-issues.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'item-stocks') {
            return route('item-stocks.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'items') {
            return route('items.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'item-stores') {
            return route('item-stores.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'item-suppliers') {
            return route('item-suppliers.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'item-categories') {
            return route('item-categories.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'clases') {
            return route('clases.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'income-heads') {
            return route('income-heads.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'incomes') {
            return route('incomes.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'expense-heads') {
            return route('expense-heads.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'expenses') {
            return route('expenses.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'visitor-books') {
            return route('visitor-books.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'general-calls') {
            return route('general-calls.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'dispatch-send') {
            return route('dispatch-send.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'dispatch-receive') {
            return route('dispatch-receive.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'complains') {
            return route('complains.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }  else if ($this->dataType->slug == 'student-documents') {
            return route('student-documents.active', array("id" => $this->data->{$this->data->getKeyName()}));
        } else if ($this->dataType->slug == 'sessions') {
            return route('sessions.active', array("id" => $this->data->{$this->data->getKeyName()}));
        } else if ($this->dataType->slug == 'groups') {
            return route('groups.active', array("id" => $this->data->{$this->data->getKeyName()}));
        } else if ($this->dataType->slug == 'subjects') {
            return route('subjects.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'grades') {
            return route('grades.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'exams') {
            return route('exams.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'leave-types') {
            return route('leave_types.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'staff') {
            return route('staff.active', array("id" => $this->data->{$this->data->getKeyName()}));
        } else if ($this->dataType->slug == 'staff-leave-request') {
            return route('staff-leave-request.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'staff-payroll') {
            return route('staff-payroll.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'staff-payslip') {
            return route('staff-payslip.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'exam-schedules') {
            return route('exam-schedules.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'departments') {
            return route('departments.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'designations') {
            return route('designations.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'homework') {
            return route('homework.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'lessons') {
            return route('lessons.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'class-topics') {
            return route('class-topics.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'events') {
            return route('events.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'feemasters') {
            return route('feemasters.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'fee-groups') {
            return route('fee-groups.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'feetypes') {
            return route('feetypes.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'fees-discounts') {
            return route('fees-discounts.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'complain-types') {
            return route('complain-types.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'purposes') {
            return route('purposes.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'sources') {
            return route('sources.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'references') {
            return route('references.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }else if ($this->dataType->slug == 'enquiries') {
            return route('enquiries.active', array("id" => $this->data->{$this->data->getKeyName()}));
        }
        else {
            redirect()->back();
        }*/
    }

 /*   public function getDefaultRoute()
    {
        return route('my.route');
    }*/
}

