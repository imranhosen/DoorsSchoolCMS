<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backEnd\income;
use App\Http\Controllers\frontEnd\HomeController;
use App\Http\Controllers\frontEnd\about\AboutController;
use App\Http\Controllers\frontEnd\facility\FacilityController;
use App\Http\Controllers\frontEnd\activity\ActivityController;
use App\Http\Controllers\frontEnd\campus\CampusController;
use App\Http\Controllers\frontEnd\admin_corner\AdminCornerController;
use App\Http\Controllers\frontEnd\student_corner\StudentCornerController;
use App\Http\Controllers\frontEnd\result\ResultController;
use App\Http\Controllers\frontEnd\gallery\GalleryController;
use App\Http\Controllers\frontEnd\admission\AdmissionController;
use App\Http\Controllers\frontEnd\contact\ContactController;
use App\Http\Controllers\frontEnd\notice_board\NoticeBoardController;
use App\Http\Controllers\backEnd\Import\ImportExcelController;
use App\Http\Controllers\frontEnd\login\LoginController;
use App\Http\Controllers\Voyager\student_categories\StudentCategoryController;
use App\Http\Controllers\Voyager\student_houses\StudentHouseController;
use App\Http\Controllers\Voyager\disable_reasons\DisableReasonController;
use App\Http\Controllers\Voyager\online_exams\OnlineExamController;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/optimize', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    return "Successfully Optimized!"; });
Route::get('/',[HomeController::class, 'index'])->name('home.index');
/*Route::get('/', function () {
    //return view('welcome');
    //Route::get('index',[HomeController::class, 'index'])->name('home.index');

});*/
//Excel Export
Route::controller(\App\Http\Controllers\backEnd\Excel\ExportExcelController::class)->group(function(){
    Route::get('index', 'index');
    Route::get('admin/export/excel', 'exportExcelFile')->name('export.excel');
    Route::get('admin/exportExcelFileOfStudent', 'exportExcelFileOfStudent')->name('exportExcelFileOfStudent');
});
//Excel Import
Route::controller(ImportExcelController::class)->group(function (){
    Route::post('admin/import-excel-complain','importComplain')->name('importComplain');
    Route::post('admin/import-excel-student','importStudent')->name('importStudent');
    Route::post('admin/import-excel-staff','importStaff')->name('importStaff');
});
//frontEnd
Route::group(['prefix' => 'frontend'], function (){
    //independence
    Route::get('independence',[GalleryController::class, 'independenceIndex'])->name('independenceIndex');
    //login page
    Route::get('user-login',[LoginController::class, 'login'])->name('userLogin');
    Route::post('user-login',[LoginController::class, 'postLogin'])->name('userLogged');
    //left sidebar
    Route::get('chairman-index',[AdminCornerController::class, 'chairmanIndex'])->name('chairmanIndex');
    Route::get('principle-index',[AdminCornerController::class, 'principleIndex'])->name('principleIndex');
    Route::get('vice-principle-index',[AdminCornerController::class, 'vicePrincipleIndex'])->name('vicePrincipleIndex');
    //mixed
    Route::get('news/{news}',[NoticeBoardController::class, 'newsView'])->name('news.view');
    Route::get('news-all',[NoticeBoardController::class, 'newsAllView'])->name('newsAll.view');
    //contact us
    Route::get('contact-index',[ContactController::class, 'contactIndex'])->name('contact.index');
    Route::post('contact-index',[ContactController::class, 'contactSave'])->name('contact.save');
    //admission
    Route::get('admission-form-hsc-general',[AdmissionController::class, 'hscGeneral'])->name('hscGeneral.index');
    Route::get('admission-formhsc-bmt',[AdmissionController::class, 'hscBMT'])->name('hscBMT.index');
    Route::get('online-admission',[AdmissionController::class, 'OnlineAdmissionIndex'])->name('OnlineAdmissionIndex');
    Route::post('online-admission/store',[AdmissionController::class, 'OnlineAdmissionStore'])->name('OnlineAdmissionStore');
    //gallery
    Route::get('photo',[GalleryController::class, 'photo'])->name('photo.index');
    Route::get('video',[GalleryController::class, 'video'])->name('video.index');
    Route::get('alumnai',[GalleryController::class, 'alumnai'])->name('alumnai.index');
    //result
    Route::get('science-result',[ResultController::class, 'scienceResult'])->name('scienceResult.index');
    Route::get('humanities-result',[ResultController::class, 'humanitiesResult'])->name('humanitiesResult.index');
    Route::get('bs-result',[ResultController::class, 'bsResult'])->name('bsResult.index');
    Route::get('commerce-result',[ResultController::class, 'commerceResult'])->name('commerceResult.index');
    //student corner
    Route::get('routine',[StudentCornerController::class, 'routine'])->name('routine.index');
    Route::get('syllabus',[StudentCornerController::class, 'syllabus'])->name('syllabus.index');
    Route::get('book-list',[StudentCornerController::class, 'bookList'])->name('bookList.index');
    Route::get('examinations',[StudentCornerController::class, 'examinations'])->name('examinations.index');
    Route::get('dress-code',[StudentCornerController::class, 'dressCode'])->name('dressCode.index');
    Route::get('id-card-and-library-card',[StudentCornerController::class, 'idLibraryCard'])->name('idLibraryCard.index');
    Route::get('fees-and-payments',[StudentCornerController::class, 'feesAndPayment'])->name('feesAndPayment.index');
    Route::get('holiday-calendar',[StudentCornerController::class, 'holidayCalendar'])->name('holidayCalendar.index');
    Route::get('academic-calendar',[StudentCornerController::class, 'academicCalendar'])->name('academicCalendar.index');
    Route::get('policies-and-guidelines',[StudentCornerController::class, 'policiesGuidelines'])->name('policiesGuidelines.index');
    Route::get('guideline-for-parents',[StudentCornerController::class, 'guidelineParents'])->name('guidelineParents.index');
    //About Us
    Route::get('historical',[AboutController::class, 'historical'])->name('historical.index');
    Route::get('college-code',[AboutController::class, 'clzCode'])->name('clzCode.index');
    Route::get('mission-and-vision',[AboutController::class, 'missionVision'])->name('missionVision.index');
    Route::get('at-a-glance',[AboutController::class, 'atAglance'])->name('atAglance.index');
    Route::get('our-facilities',[AboutController::class, 'facilities'])->name('facilities.index');
    //facilities
    Route::get('courses',[FacilityController::class, 'courses'])->name('courses.index');
    Route::get('departments',[FacilityController::class, 'department'])->name('department.index');
    Route::get('library',[FacilityController::class, 'library'])->name('library.index');
    Route::get('science-lab',[FacilityController::class, 'scienceLab'])->name('scienceLab.index');
    Route::get('ict-lab',[FacilityController::class, 'ictLab'])->name('ictLab.index');
    Route::get('multimedia-classroom',[FacilityController::class, 'multimediaClassroom'])->name('multimediaClassroom.index');
    Route::get('scholarships',[FacilityController::class, 'scholarship'])->name('scholarship.index');
    //activities
    Route::get('sports',[ActivityController::class, 'sports'])->name('sports.index');
    Route::get('cultural-program',[ActivityController::class, 'culturalProgram'])->name('culturalProgram.index');
    Route::get('excursion',[ActivityController::class, 'excursion'])->name('excursion.index');
    Route::get('religious-ceremonies',[ActivityController::class, 'religiousCeremonies'])->name('religiousCeremonies.index');
    Route::get('rover-scout',[ActivityController::class, 'roverScout'])->name('roverScout.index');
    Route::get('red-crescent',[ActivityController::class, 'redCrescent'])->name('redCrescent.index');
    Route::get('bncc',[ActivityController::class, 'bncc'])->name('bncc.index');
    //campus
    Route::get('land-area',[CampusController::class, 'landArea'])->name('landArea.index');
    Route::get('infrastructure',[CampusController::class, 'infrastructure'])->name('infrastructure.index');
    Route::get('campus-map',[CampusController::class, 'campusMap'])->name('campusMap.index');
    //admin corner
    Route::get('governing_body',[AdminCornerController::class, 'governingBody'])->name('governingBody.index');
    Route::get('chairman',[AdminCornerController::class, 'chairman'])->name('chairman.index');
    Route::get('principal',[AdminCornerController::class, 'principal'])->name('principal.index');
    Route::get('vice-principal',[AdminCornerController::class, 'vicePrincipal'])->name('vicePrincipal.index');
    Route::get('teacher_info',[AdminCornerController::class, 'teacherInfo'])->name('teacherInfo.index');
    Route::get('employee_info',[AdminCornerController::class, 'employeeInfo'])->name('employeeInfo.index');
});

//Student Portal
Route::group(['prefix' => 'admin'], function (){
    //student attendence
    Route::get('student-attendence-by-user',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'searchAttendenceByUserIndex'])->name('searchAttendenceByUserIndex');
    Route::post('student-attendence-by-user',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'fetchAttendenceDataByUser'])->name('fetchAttendenceDataByUser');
    //teacher
    Route::get('teachers',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'teacherList'])->name('teacherList');
    //fee manager
    Route::get('fee-manager-by-user',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'feeManagerByUser'])->name('feeManagerByUser');
    Route::post('fetch-fee-manager-by-user',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'fetchFeeManagerByUser'])->name('fetchFeeManagerByUser');
    //book
    //FRoute::get('issued-book-by-user',[\App\Http\Controllers\Voyager\BookController::class, 'issueBookByUser'])->name('issueBookByUser');
//BackEnd
    //fee collection
    Route::get('student-fee-master',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'studentFeeMasterIndex'])->name('studentFeeMasterIndex');
    Route::get('student-fee-master-assign/{fee_master}',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'studentFeeMasterAssign'])->name('studentFeeMasterAssign');
    Route::post('fetch-student-fee-master',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'fetchStudentForFeeMaster'])->name('fetchStudentForFeeMaster');
    Route::post('student-fee-master-assign',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'studentFeeMasterAssignStore'])->name('studentFeeMasterAssignStore');
    Route::get('student-fee',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'studentFeeIndex'])->name('studentFeeIndex');
    Route::post('student-fee',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'studentSearch'])->name('studentSearch');
    Route::get('student-fee-id',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'searchFeeByIdIndex'])->name('searchFeeByIdIndex');
    Route::post('student-fee-id',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'fetchFeeByPaymentId'])->name('fetchFeeByPaymentId');
    Route::get('add-student-fee/{student}',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'addStudentFee'])->name('addStudentFee');
    Route::get('add-student-fee/fetchStudentFee/{studentFeeId}',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'fetchStudentFee'])->name('fetchStudentFee');
    Route::put('update-student-fees',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'updateStudentFees'])->name('updateStudentFees');
    Route::delete('delete-student-fees/{student_fee}',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'deleteStudentFees'])->name('deleteStudentFees');
    Route::get('student-due-fees',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'studentDueFeesindex'])->name('studentDueFeesindex');
    Route::post('student-due-fees-search',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'studentDueFeesSearch'])->name('studentDueFeesSearch');
    Route::get('fetchDueFee/{dueFeeId}',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'fetchDueFee'])->name('fetchDueFee');
    Route::put('collect-due-fees',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'collectDueFees'])->name('collectDueFees');
    Route::get('fees-forward-index',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'feesForwardindex'])->name('feesForwardindex');
    Route::post('fetch-student-for-fees-forward',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'fetchStudentForFeesForward'])->name('fetchStudentForFeesForward');
    Route::post('student-fees-forward-store',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'studentFeesForwardStore'])->name('studentFeesForwardStore');
    Route::get('fees-statement-index',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'feesStatementindex'])->name('feesStatementindex');
    Route::post('fetch-students',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'fetchStudent'])->name('fetchStudent');
    Route::post('fetch-student-fees',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'fetchStudentFees'])->name('fetchStudentFees');
    Route::get('balance-fees-index',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'balanceFeesindex'])->name('balanceFeesindex');
    Route::post('fetch-student-balance-fees',[\App\Http\Controllers\backEnd\feeCollection\FeeCollectionController::class, 'studentBalanceFeesSearch'])->name('studentBalanceFeesSearch');

    //human Resource
    Route::post('fetch-student-library-card',[\App\Http\Controllers\backEnd\libraryMemberAdd\StudentAddLibraryController::class, 'fetchStudentForLibraryCard'])->name('fetchStudentForLibraryCard');

    //student & staff library card add
    Route::get('student-add-library',[\App\Http\Controllers\backEnd\libraryMemberAdd\StudentAddLibraryController::class, 'index'])->name('student.add.library');
    Route::post('fetch-student-library-card',[\App\Http\Controllers\backEnd\libraryMemberAdd\StudentAddLibraryController::class, 'fetchStudentForLibraryCard'])->name('fetchStudentForLibraryCard');
    Route::get('fetch-student-library-number/{studentId}',[\App\Http\Controllers\backEnd\libraryMemberAdd\StudentAddLibraryController::class, 'fetchStudentLibraryNumber'])->name('fetchStudentLibraryNumber');
    Route::get('fetch-staff-library-number/{staffId}',[\App\Http\Controllers\backEnd\libraryMemberAdd\StaffAddLibraryController::class, 'fetchStaffLibraryNumber'])->name('fetchStaffLibraryNumber');
    Route::post('fetch-groups',[\App\Http\Controllers\backEnd\libraryMemberAdd\StudentAddLibraryController::class, 'fetchGroup'])->name('fetchGroup');
    Route::post('fetch-subjects',[\App\Http\Controllers\backEnd\libraryMemberAdd\StudentAddLibraryController::class, 'fetchSubject'])->name('fetchSubject');
    Route::post('student-get',[\App\Http\Controllers\backEnd\libraryMemberAdd\StudentAddLibraryController::class, 'showStudent'])->name('studentShow');
    Route::put('libraryCardUpdated',[\App\Http\Controllers\backEnd\libraryMemberAdd\StudentAddLibraryController::class, 'updateStudentLibraryCard'])->name('updateStudentLibraryCard');
    Route::get('staff-add-library',[\App\Http\Controllers\backEnd\libraryMemberAdd\StaffAddLibraryController::class, 'index'])->name('staff.add.library');
    Route::put('libraryCardUpdateStaff',[\App\Http\Controllers\backEnd\libraryMemberAdd\StaffAddLibraryController::class, 'updateStaffLibraryCard'])->name('updateStaffLibraryCard');

    //certificate
    Route::get('certificates-index', [\App\Http\Controllers\backEnd\certificate\CertificateController::class, 'certificateIndex'])->name('certificateIndex');
    Route::post('certificates/fetch/students', [\App\Http\Controllers\backEnd\certificate\CertificateController::class, 'fetchStudentForCertificate'])->name('fetchStudentForCertificate');
    Route::post('certificates/generate/students', [\App\Http\Controllers\backEnd\certificate\CertificateController::class, 'generateCertificate'])->name('generateCertificate');
    Route::get('staffidcard',[\App\Http\Controllers\backEnd\certificate\CertificateController::class, 'staffIdCardIndex'])->name('staffIdCardIndex');
    Route::post('fetchStaffForIdCard',[\App\Http\Controllers\backEnd\certificate\CertificateController::class, 'fetchStaffForIdCard'])->name('fetchStaffForIdCard');
    Route::post('generate-staff-id-card',[\App\Http\Controllers\backEnd\certificate\CertificateController::class, 'generateStaffIdCard'])->name('generateStaffIdCard');

    //Route::get('certificates/modal', [\App\Http\Controllers\Voyager\CertificateController::class, 'modal'])->name('certificates.active');
    Route::get('id-card-index', [\App\Http\Controllers\backEnd\certificate\CertificateController::class, 'idCardIndex'])->name('idCardIndex');
    Route::post('id-card/fetch/students', [\App\Http\Controllers\backEnd\certificate\CertificateController::class, 'fetchStudentForIdCard'])->name('fetchStudentForIdCard');
    Route::post('id-card/generate/students', [\App\Http\Controllers\backEnd\certificate\CertificateController::class, 'generateIdCard'])->name('generateIdCard');
    //Route::get('id-card/modal', [\App\Http\Controllers\Voyager\CertificateController::class, 'modal'])->name('idCardModal');
    //staff directory
    Route::get('staff-directory',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'staffDirectoryIndex'])->name('staffDirectoryIndex');
    Route::post('staff/directory',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'fetchStaffBySearch'])->name('fetchStaffBySearch');
    Route::post('staff/role/directory',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'fetchStaffByRole'])->name('fetchStaffByRole');
    Route::get('staff/payroll',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'staffPayrollIndex'])->name('staffPayrollIndex');
    Route::post('staff/payroll',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'fetchStaffByRoleMonthYear'])->name('fetchStaffByRoleMonthYear');
    Route::get('staff/fetchStaffPayroll/{staff}/{month}/{year}',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'fetchStaffPayroll'])->name('fetchStaffPayroll');
    Route::post('staff/payroll/store',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'staffPayrollStore'])->name('staffPayrollStore');
    //Route::get('staffidcard',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'staffIdCardIndex'])->name('staffIdCardIndex');

    //Staff Attendance
    Route::get('stafftAttendence',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'staffAttendence'])->name('staffAttendence');
    Route::post('fetchStaffDataForAttendence',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'fetchStaffDataForAttendence'])->name('fetchStaffDataForAttendence');
    Route::post('staffAttendenceSave',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'staffAttendenceSave'])->name('staffAttendance.save');
    Route::get('searchStaffAttendence',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'searchStaffAttendenceIndex'])->name('searchStaffAttendenceIndex');
    Route::post('fetchStaffAttendenceData',[\App\Http\Controllers\backEnd\staffDetails\StaffDetailController::class, 'fetchStaffAttendenceData'])->name('fetchStaffAttendenceData');

    //income
    Route::get('search-incomes-index', [\App\Http\Controllers\backEnd\income\IncomeController::class, 'incomeIndex'])->name('incomeIndex');
    Route::post('search/incomes/index', [\App\Http\Controllers\backEnd\income\IncomeController::class, 'fetchIncome'])->name('fetchIncome');
   //expense
    Route::get('search-expenses-index', [\App\Http\Controllers\backEnd\expense\ExpenseController::class, 'expenseIndex'])->name('expenseIndex');
    Route::post('search/expenses/index', [\App\Http\Controllers\backEnd\expense\ExpenseController::class, 'fetchExpense'])->name('fetchExpense');
    //student Id card
    Route::get('studentIdCard',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'studentIdCardIndex'])->name('studentIdCard');
    Route::post('studentIdCard',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'studentIdCardGenerate'])->name('studentIdCardGenerate');

    //communicate
    Route::get('notification/add',[\App\Http\Controllers\backEnd\communicate\CommunicationController::class, 'notificationIndex'])->name('notificationIndex');
    Route::get('smsGot',[\App\Http\Controllers\backEnd\item_issue\ItemIssueController::class, 'index'])->name('smsIndex');

    //examination
    Route::get('exam-schedule',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'examScheduleIndex'])->name('examScheduleIndex');
    Route::post('exam-schedule',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'examScheduleStore'])->name('examScheduleStore');
    Route::get('exam-marks-entry',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'examMarksIndex'])->name('examMarksIndex');
    Route::post('exam-marks-entry',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'fetchStudentForMarksEntry'])->name('fetchStudentForMarksEntry');
    Route::post('save-marks',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'saveStudentMarks'])->name('saveStudentMarks');
    //Route::get('assign-exam',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'assignExamGroupIndex'])->name('assignExamGroupIndex');
    Route::get('student-exam-assign/{exam}',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'studentExamAssign'])->name('studentExamAssign');
    Route::post('fetch-student-exam',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'fetchStudentForExam'])->name('fetchStudentForExam');
    Route::post('student-exam-assign-store',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'studentExamAssignStore'])->name('studentExamAssignStore');
    Route::get('generate-marksheet-index',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'generateMarksheetIndex'])->name('generateMarksheetIndex');
    Route::post('fetch-exam',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'fetchExam'])->name('fetchExam');
    Route::post('fetch-student-for-marksheet',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'fetchStudentForMarksheet'])->name('fetchStudentForMarksheet');
    Route::post('generate-students-marksheet', [\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'generateMarksheet'])->name('generateMarksheet');
    Route::get('generate-admitcard-index',[\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'generateAdmitcardIndex'])->name('generateAdmitcardIndex');
    Route::post('generate-students-admitcard', [\App\Http\Controllers\backEnd\examination\ExaminationController::class, 'generateAdmitcard'])->name('generateAdmitcard');

    // Online Examination
    Route::get('student-online-exam-assign/{exam}', [OnlineExamController::class, 'studentOnlineExamAssign'])->name('studentOnlineExamAssign');
    Route::post('student-online-exam-assign', [OnlineExamController::class, 'studentOnlineExamAssignStore'])->name('studentOnlineExamAssignStore');
    Route::get('student-online-question-assign/{exam}', [OnlineExamController::class, 'studentOnlineQuestionAssign'])->name('studentOnlineQuestionAssign');
    Route::post('student-online-exam-question-assign', [OnlineExamController::class, 'studentOnlineExamQuestionAssignStore'])->name('studentOnlineExamQuestionAssignStore');
    Route::post('fetch-question', [OnlineExamController::class, 'fetchQuestionForAssignExam'])->name('fetchQuestionForAssignExam');


    //Student Attendence
    Route::get('studentAttendence',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'studentAttendence'])->name('studentAttendence');
    Route::post('fetchstudentDataForAttendence',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'fetchstudentDataForAttendence'])->name('fetchStudentDataForAttendence');
    Route::post('studentAttendenceSave',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'studentAttendenceSave'])->name('studentAttendance.save');
    Route::get('searchStudentAttendence',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'searchAttendenceIndex'])->name('seachAttendenceIndex');
    Route::post('fetchAttendenceData',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'fetchAttendenceData'])->name('fetchAttendenceData');
    Route::get('student-attendence-by-user',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'searchAttendenceByUserIndex'])->name('searchAttendenceByUserIndex');
    Route::post('student-attendence-by-user',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'fetchAttendenceDataByUser'])->name('fetchAttendenceDataByUser');

    //Academics
    Route::get('timetable/create',[\App\Http\Controllers\backEnd\academic\AcademicController::class, 'timeTableIndex'])->name('timeTable.create');
    Route::post('timetable/save',[\App\Http\Controllers\backEnd\academic\AcademicController::class, 'saveTimetable'])->name('timeTable.save');
    Route::get('assignClassTeacher/create',[\App\Http\Controllers\backEnd\academic\AcademicController::class, 'assignClassTeacherIndex'])->name('assignClassTeacher.create');
    Route::post('assignClassTeacher/save',[\App\Http\Controllers\backEnd\academic\AcademicController::class, 'saveAssignClassTeacher'])->name('assignClassTeacher.save');
    Route::get('assignSubject/create',[\App\Http\Controllers\backEnd\academic\AcademicController::class, 'assignSubjectIndex'])->name('assignSubject.create');
    Route::post('assignSubject/save',[\App\Http\Controllers\backEnd\academic\AcademicController::class, 'saveAssignSubject'])->name('assignSubject.save');
    Route::get('promoteStudents/create',[\App\Http\Controllers\backEnd\academic\AcademicController::class, 'promoteStudentIndex'])->name('promoteStudent.create');
    Route::post('promoteStudents/create',[\App\Http\Controllers\backEnd\academic\AcademicController::class, 'fetchStudentPromote'])->name('fetchStudentData');
    Route::post('promoteStudents/save',[\App\Http\Controllers\backEnd\academic\AcademicController::class, 'savePromoteStudent'])->name('promoteStudent.save');


    //student details
    Route::get('student-report',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'studentReportindex'])->name('student.report');
    Route::post('student-report',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'fetchStudentReport'])->name('fetchStudentReport');

    Route::get('guardian-report',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'guardianReportIndex'])->name('guardian.report');
    Route::post('guardian-report',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'fetchGuardianReport'])->name('fetchGuardianReport');

    Route::get('student-history',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'studentHistoryIndex'])->name('student.history');
    Route::post('student-history',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'fetchStudentHistory'])->name('fetchStudentHistory');

    Route::get('disabled-student',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'studentDisabledIndex'])->name('student.disabled');
    Route::post('disabled-student',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'fetchDisabledStudent'])->name('fetchDisabledStudent');

    //inventory
    Route::post('fetch-staffs',[\App\Http\Controllers\backEnd\item_issue\ItemIssueController::class, 'fetchStaff'])->name('fetchStaffInItemIssue');

    //download centre view route
    Route::get('assignment-lists', [\App\Http\Controllers\Voyager\ContentTypeController::class, 'assignmentList'])->name('assignment-lists.index');
    Route::get('studyMaterial-lists', [\App\Http\Controllers\Voyager\ContentTypeController::class, 'studyMaterialList'])->name('studyMaterial-lists.index');
    Route::get('syllabus-lists', [\App\Http\Controllers\Voyager\ContentTypeController::class, 'syllabusList'])->name('syllabus-lists.index');
    Route::get('other_download_list', [\App\Http\Controllers\Voyager\ContentTypeController::class, 'otherDownloadList'])->name('otherDownload-lists.index');
});


Route::group(['prefix' => 'admin'], function () {
//publish route
    Route::get('exams/publish', [\App\Http\Controllers\Voyager\ExamController::class, 'publish'])->name('exams.publish');
    //Route::get('student-histories',[\App\Http\Controllers\backEnd\studentDetails\StudentDetailController::class, 'studentHistoryIndex'])->name('student-histories.index');

    // Route::get('posts/publish','Voyager\PostController@publish')->name('posts.publish');
   Route::get('posts/publish', [\App\Http\Controllers\Voyager\PostController::class, 'publish'])->name('posts.publish');
   Route::get('posts/publish', [\App\Http\Controllers\Voyager\PostController::class, 'publish'])->name('posts.publish');

   Route::get('students/active', [\App\Http\Controllers\Voyager\StudentController::class, 'active'])->name('students.active');
   Route::get('student-documents/active', [\App\Http\Controllers\Voyager\StudentDocumentController::class, 'active'])->name('student-documents.active');

//status route
    //admission
    Route::get('student-categories/active', [StudentCategoryController::class, 'active'])->name('student-categories.active');
    Route::get('student-houses/active', [StudentHouseController::class, 'active'])->name('student-houses.active');
    Route::get('disable-reasons/active', [DisableReasonController::class, 'active'])->name('disable-reasons.active');
    //online admission
    Route::get('online-admissions/approve', [AdmissionController::class, 'active'])->name('online-admissions.approve');

    //new
    Route::get('front-cms-media-gallery/active', [\App\Http\Controllers\Voyager\FrontCmsMediaGalleryController::class, 'active'])->name('front-cms-media-gallery.active');
    Route::get('governing-members/active', [\App\Http\Controllers\Voyager\GoverningMemberController::class, 'active'])->name('governing-members.active');
    Route::get('gallery-videos/active', [\App\Http\Controllers\Voyager\GalleryVideoController::class, 'active'])->name('gallery-videos.active');

    //section
    Route::get('sections/active', [\App\Http\Controllers\Voyager\SectionController::class, 'active'])->name('sections.active');
    //Human Resource
    Route::get('staff-payroll/active', [\App\Http\Controllers\Voyager\PayrollController::class, 'active'])->name('staff-payroll.active');
    Route::get('staff-payslip/active', [\App\Http\Controllers\Voyager\PayslipController::class, 'active'])->name('staff-payslip.active');
    Route::get('staff-leave-request/active', [\App\Http\Controllers\Voyager\StaffLeaveRequestController::class, 'active'])->name('staff-leave-request.active');
    Route::get('staff-leave-details/active', [\App\Http\Controllers\Voyager\StaffLeaveDetailsController::class, 'active'])->name('staff-leave-details.active');
    Route::get('staff-attendances/active', [\App\Http\Controllers\Voyager\StaffController::class, 'active'])->name('staff-attendances.active');

    //academics
    Route::get('class-teachers/active', [\App\Http\Controllers\backEnd\academic\AcademicController::class, 'active1'])->name('class-teachers.active');
    Route::get('timetables/active', [\App\Http\Controllers\backEnd\academic\AcademicController::class, 'active2'])->name('timetables.active');
    Route::get('teacher-subjects/active', [\App\Http\Controllers\backEnd\academic\AcademicController::class, 'active3'])->name('teacher-subjects.active');
    Route::get('student-promotes/active', [\App\Http\Controllers\backEnd\academic\AcademicController::class, 'active4'])->name('student-promotes.active');
    Route::get('contents/active', [\App\Http\Controllers\Voyager\ContentController::class, 'active'])->name('contents.active');
    Route::get('content-types/active', [\App\Http\Controllers\Voyager\ContentTypeController::class, 'active'])->name('content-types.active');
    Route::get('sessions/active', [\App\Http\Controllers\Voyager\SessionController::class, 'active'])->name('sessions.active');
    Route::get('clases/active', [\App\Http\Controllers\Voyager\ClassController::class, 'active'])->name('clases.active');
    Route::get('groups/active', [\App\Http\Controllers\Voyager\GroupController::class, 'active'])->name('groups.active');
    Route::get('subjects/active', [\App\Http\Controllers\Voyager\SubjectController::class, 'active'])->name('subjects.active');
    Route::get('grades/active', [\App\Http\Controllers\Voyager\GradeController::class, 'active'])->name('grades.active');

    //examination
    Route::get('exams/active', [\App\Http\Controllers\Voyager\ExamController::class, 'active'])->name('exams.active');
    Route::get('exam-schedules/active', [\App\Http\Controllers\Voyager\ExamScheduleController::class, 'active'])->name('exam-schedules.active');
    Route::get('exam-marks/active', [\App\Http\Controllers\Voyager\ExamMarksController::class, 'active'])->name('exam-marks.active');

    Route::get('staff/active', [\App\Http\Controllers\Voyager\StaffController::class, 'active'])->name('staff.active');
    Route::get('leave_types/active', [\App\Http\Controllers\Voyager\LeaveTypeController::class, 'active'])->name('leave-types.active');
    Route::get('staff-leave-request/active', [\App\Http\Controllers\Voyager\LeaveRequestController::class, 'active'])->name('staff-leave-request.active');
    Route::get('staff-payslip/active', [\App\Http\Controllers\Voyager\PayslipController::class, 'active'])->name('staff-payslip.active');
    Route::get('staff-payroll/active', [\App\Http\Controllers\Voyager\PayrollController::class, 'active'])->name('staff-payroll.active');
    Route::get('departments/active', [\App\Http\Controllers\Voyager\DepartmentController::class, 'active'])->name('departments.active');
    Route::get('designations/active', [\App\Http\Controllers\Voyager\DesignationController::class, 'active'])->name('designations.active');
    Route::get('homework/active', [\App\Http\Controllers\Voyager\HomeworkController::class, 'active'])->name('homework.active');
    Route::get('lessons/active', [\App\Http\Controllers\Voyager\LessonController::class, 'active'])->name('lessons.active');
    Route::get('class-topics/active', [\App\Http\Controllers\Voyager\ClassTopicController::class, 'active'])->name('class-topics.active');

    //inventory module status route
    Route::get('item-stocks/active', [\App\Http\Controllers\Voyager\ItemStockController::class, 'active'])->name('item-stocks.active');
    Route::get('items/active', [\App\Http\Controllers\Voyager\ItemController::class, 'active'])->name('items.active');
    Route::get('item-stores/active', [\App\Http\Controllers\Voyager\ItemStoreController::class, 'active'])->name('item-stores.active');
    Route::get('item-suppliers/active', [\App\Http\Controllers\Voyager\ItemSupplierController::class, 'active'])->name('item-suppliers.active');
    Route::get('item-categories/active', [\App\Http\Controllers\Voyager\ItemCategoryController::class, 'active'])->name('item-categories.active');
    Route::get('item-issues/active', [\App\Http\Controllers\backEnd\item_issue\ItemIssueController::class, 'active'])->name('item-issues.active');

    //front CMS status route
    Route::get('events/active', [\App\Http\Controllers\Voyager\EventController::class, 'active'])->name('events.active');
    Route::get('categories/active', [\App\Http\Controllers\Voyager\CategoryController::class, 'active'])->name('categories.active');
    Route::get('front-cms-news/active', [\App\Http\Controllers\Voyager\FrontCmsNewsController::class, 'active'])->name('front-cms-news.active');

    //fee collection status route
    Route::get('feemasters/active', [\App\Http\Controllers\Voyager\FeeMasterController::class, 'active'])->name('feemasters.active');
    Route::get('fee-groups/active', [\App\Http\Controllers\Voyager\FeeGroupController::class, 'active'])->name('fee-groups.active');
    Route::get('feetypes/active', [\App\Http\Controllers\Voyager\FeeTypeController::class, 'active'])->name('feetypes.active');
    Route::get('fees-discounts/active', [\App\Http\Controllers\Voyager\FeeDiscountController::class, 'active'])->name('fees-discounts.active');

    //front office status route
    Route::get('complain-types/active', [\App\Http\Controllers\Voyager\ComplainTypeController::class, 'active'])->name('complain-types.active');
    Route::get('purposes/active', [\App\Http\Controllers\Voyager\PurposeController::class, 'active'])->name('purposes.active');
    Route::get('sources/active', [\App\Http\Controllers\Voyager\SourceController::class, 'active'])->name('sources.active');
    Route::get('references/active', [\App\Http\Controllers\Voyager\ReferenceController::class, 'active'])->name('references.active');
    Route::get('enquiries/active', [\App\Http\Controllers\Voyager\EnquiryController::class, 'active'])->name('enquiries.active');
    Route::get('visitor-books/active', [\App\Http\Controllers\Voyager\VisitorBookController::class, 'active'])->name('visitor-books.active');
    Route::get('general-calls/active', [\App\Http\Controllers\Voyager\GeneralCallController::class, 'active'])->name('general-calls.active');
    Route::get('dispatch-send/active', [\App\Http\Controllers\Voyager\DispatchSendController::class, 'active'])->name('dispatch-send.active');
    Route::get('dispatch-receive/active', [\App\Http\Controllers\Voyager\DispatchReceiveController::class, 'active'])->name('dispatch-receive.active');
    Route::get('complains/active', [\App\Http\Controllers\Voyager\ComplainController::class, 'active'])->name('complains.active');

    //income status route
    Route::get('income-heads/active', [\App\Http\Controllers\Voyager\IncomeHeadController::class, 'active'])->name('income-heads.active');
    Route::get('incomes/active', [\App\Http\Controllers\Voyager\IncomeController::class, 'active'])->name('incomes.active');

    //expense status route
    Route::get('expense-heads/active', [\App\Http\Controllers\Voyager\ExpenseHeadController::class, 'active'])->name('expense-heads.active');
    Route::get('expenses/active', [\App\Http\Controllers\Voyager\ExpenseController::class, 'active'])->name('expenses.active');

    Route::get('student-fees/active', [\App\Http\Controllers\Voyager\StudentFeeController::class, 'active'])->name('student-fees.active');
    Route::get('books/active', [\App\Http\Controllers\Voyager\BookController::class, 'active'])->name('books.active');
    Route::get('book-issues/active', [\App\Http\Controllers\Voyager\BookIssueController::class, 'active'])->name('book-issues.active');
    Route::get('certificates/active', [\App\Http\Controllers\Voyager\CertificateController::class, 'active'])->name('certificates.active');
    Route::get('id-cards/active', [\App\Http\Controllers\Voyager\IdCardController::class, 'active'])->name('id-cards.active');
    Route::get('attendence-types/active', [\App\Http\Controllers\Voyager\AttendenceTypeController::class, 'active'])->name('attendence-types.active');
    Route::get('student-attendances/active', [\App\Http\Controllers\Voyager\StudentAttendanceController::class, 'active'])->name('student-attendances.active');
    Route::get('front-cms-pages/active', [\App\Http\Controllers\Voyager\FrontCmsPagesController::class, 'active'])->name('front-cms-pages.active');
    Route::get('front-banner-images/active', [\App\Http\Controllers\Voyager\FrontBannerImageController::class, 'active'])->name('front-banner-images.active');
    //role
    Route::get('roles/active', [\App\Http\Controllers\Voyager\RoleController::class, 'active'])->name('roles.active');
    Route::get('users/active', [\App\Http\Controllers\Voyager\UserController::class, 'active'])->name('users.active');




//forceDelete action
    //online examination
    Route::get('question-types/force-delete/{id}', [\App\Http\Controllers\Voyager\GalleryVideoController::class, 'forceDelete'])->name('question-types.forceDelete');
    Route::get('questions/force-delete/{id}', [\App\Http\Controllers\Voyager\GalleryVideoController::class, 'forceDelete'])->name('questions.forceDelete');
    Route::get('online-exams/force-delete/{id}', [\App\Http\Controllers\Voyager\GalleryVideoController::class, 'forceDelete'])->name('online-exams.forceDelete');
    Route::get('online-exam-students/force-delete/{id}', [\App\Http\Controllers\Voyager\GalleryVideoController::class, 'forceDelete'])->name('online-exam-students.forceDelete');
    Route::get('online-exam-questions/force-delete/{id}', [\App\Http\Controllers\Voyager\GalleryVideoController::class, 'forceDelete'])->name('online-exam-questions.forceDelete');
    //new
    Route::get('governing-members/force-delete/{id}', [\App\Http\Controllers\Voyager\GoverningMemberController::class, 'forceDelete'])->name('governing-members.forceDelete');
    Route::get('gallery-videos/force-delete/{id}', [\App\Http\Controllers\Voyager\GalleryVideoController::class, 'forceDelete'])->name('gallery-videos.forceDelete');

    //section
    Route::get('sections/force-delete/{id}', [\App\Http\Controllers\Voyager\SectionController::class, 'forceDelete'])->name('sections.forceDelete');

    //videos
    Route::get('videos/force-delete/{id}', [\App\Http\Controllers\Voyager\SmsController::class, 'forceDelete'])->name('videos.forceDelete');
    //sms
    Route::get('sms/force-delete/{id}', [\App\Http\Controllers\Voyager\SmsController::class, 'forceDelete'])->name('sms.forceDelete');

    Route::get('student-history/force-delete/{id}', [\App\Http\Controllers\Voyager\SmsController::class, 'forceDelete'])->name('student-histories.forceDelete');

    //role & permission
    Route::get('roles/force-delete/{id}', [\App\Http\Controllers\Voyager\RoleController::class, 'forceDelete'])->name('roles.forceDelete');
    Route::get('permissions/force-delete/{id}', [\App\Http\Controllers\Voyager\RoleController::class, 'forceDelete'])->name('permissions.forceDelete');
    //attendence
    Route::get('attendence-types/force-delete/{id}', [\App\Http\Controllers\Voyager\AttendenceTypeController::class, 'forceDelete'])->name('attendence-types.forceDelete');
    Route::get('events/force-delete/{id}', [\App\Http\Controllers\Voyager\EventController::class, 'forceDelete'])->name('events.forceDelete');
    Route::get('front-cms-media-gallery/force-delete/{id}', [\App\Http\Controllers\Voyager\FrontCmsMediaGalleryController::class, 'forceDelete'])->name('front-cms-media-gallery.forceDelete');
    Route::get('front-cms-news/force-delete/{id}', [\App\Http\Controllers\Voyager\FrontCmsNewsController::class, 'forceDelete'])->name('front-cms-news.forceDelete');
    Route::get('front-cms-pages/force-delete/{id}', [\App\Http\Controllers\Voyager\FrontCmsPagesController::class, 'forceDelete'])->name('front-cms-pages.forceDelete');
    Route::get('front-banner-images/force-delete/{id}', [\App\Http\Controllers\Voyager\FrontBannerImageController::class, 'forceDelete'])->name('front-banner-images.forceDelete');

    //category
    Route::get('categories/force-delete/{id}', [\App\Http\Controllers\Voyager\CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

    //user
    Route::get('users/force-delete/{id}', [\App\Http\Controllers\Voyager\UserController::class, 'forceDelete'])->name('users.forceDelete');

    //front cms
    Route::get('pages/force-delete/{id}', [\App\Http\Controllers\Voyager\PageController::class, 'forceDelete'])->name('pages.forceDelete');
    Route::get('posts/force-delete/{id}', [\App\Http\Controllers\Voyager\PostController::class, 'forceDelete'])->name('posts.forceDelete');

    //fee collection
    Route::get('student-fees/force-delete/{id}', [\App\Http\Controllers\Voyager\StudentFeeController::class, 'forceDelete'])->name('student-fees.forceDelete');
    Route::get('students/force-delete/{id}', [\App\Http\Controllers\Voyager\StudentController::class, 'forceDelete'])->name('students.forceDelete');
     // online class
    Route::get('lessons/force-delete/{id}', [\App\Http\Controllers\Voyager\LessonController::class, 'forceDelete'])->name('lessons.forceDelete');
    Route::get('class-topics/force-delete/{id}', [\App\Http\Controllers\Voyager\ClassTopicController::class, 'forceDelete'])->name('class-topics.forceDelete');
    //examination
    Route::get('grades/force-delete/{id}', [\App\Http\Controllers\Voyager\GradeController::class, 'forceDelete'])->name('grades.forceDelete');
    Route::get('exam-types/force-delete/{id}', [\App\Http\Controllers\Voyager\ExamMarksController::class, 'forceDelete'])->name('exam-types.forceDelete');
    Route::get('exam-groups/force-delete/{id}', [\App\Http\Controllers\Voyager\ExamMarksController::class, 'forceDelete'])->name('exam-groups.forceDelete');
    Route::get('marksheets/force-delete/{id}', [\App\Http\Controllers\Voyager\ExamMarksController::class, 'forceDelete'])->name('marksheets.forceDelete');

    //homework
    Route::get('homework/force-delete/{id}', [\App\Http\Controllers\Voyager\HomeworkController::class, 'forceDelete'])->name('homework.forceDelete');
    //certificate
    Route::get('certificates/force-delete/{id}', [\App\Http\Controllers\Voyager\CertificateController::class, 'forceDelete'])->name('certificates.forceDelete');
    Route::get('id-cards/force-delete/{id}', [\App\Http\Controllers\Voyager\IdCardController::class, 'forceDelete'])->name('id-cards.forceDelete');

    //student Admission
    Route::get('students/force-delete/{id}', [\App\Http\Controllers\Voyager\StudentController::class, 'forceDelete'])->name('students.forceDelete');
    Route::get('student-documents/force-delete/{id}', [\App\Http\Controllers\Voyager\StudentDocumentController::class, 'forceDelete'])->name('student-documents.forceDelete');
    Route::get('online-admissions/force-delete/{id}', [AdmissionController::class, 'forceDelete'])->name('online-admissions.forceDelete');
    Route::get('student-categories/force-delete/{id}', [StudentCategoryController::class, 'forceDelete'])->name('student-categories.forceDelete');
    Route::get('student-houses/force-delete/{id}', [StudentHouseController::class, 'forceDelete'])->name('student-houses.forceDelete');
    Route::get('disable-reasons/force-delete/{id}', [DisableReasonController::class, 'forceDelete'])->name('disable-reasons.forceDelete');

    //academics
    Route::get('clases/force-delete/{id}', [\App\Http\Controllers\Voyager\ClassController::class, 'forceDelete'])->name('clases.forceDelete');
    Route::get('groups/force-delete/{id}', [\App\Http\Controllers\Voyager\GroupController::class, 'forceDelete'])->name('groups.forceDelete');
    Route::get('sessions/force-delete/{id}', [\App\Http\Controllers\Voyager\SessionController::class, 'forceDelete'])->name('sessions.forceDelete');
    //student attendence
    Route::get('student-attendances/force-delete/{id}', [\App\Http\Controllers\Voyager\StudentAttendanceController::class, 'forceDelete'])->name('student-attendances.forceDelete');
    Route::get('attendence-types/force-delete/{id}', [\App\Http\Controllers\Voyager\AttendenceTypeController::class, 'forceDelete'])->name('attendence-types.forceDelete');
    //library
    Route::get('book-issues/force-delete/{id}', [\App\Http\Controllers\Voyager\BookIssueController::class, 'forceDelete'])->name('book-issues.forceDelete');
    Route::get('books/force-delete/{id}', [\App\Http\Controllers\Voyager\BookController::class, 'forceDelete'])->name('books.forceDelete');

    //Human Resource
    Route::get('staff-payroll/force-delete/{id}', [\App\Http\Controllers\Voyager\PayrollController::class, 'forceDelete'])->name('staff-payroll.forceDelete');
    Route::get('staff-payslip/force-delete/{id}', [\App\Http\Controllers\Voyager\PayslipController::class, 'forceDelete'])->name('staff-payslip.forceDelete');
    Route::get('staff/force-delete/{id}', [\App\Http\Controllers\Voyager\StaffController::class, 'forceDelete'])->name('staff.forceDelete');
    Route::get('designations/force-delete/{id}', [\App\Http\Controllers\Voyager\DesignationController::class, 'forceDelete'])->name('designations.forceDelete');
    Route::get('departments/force-delete/{id}', [\App\Http\Controllers\Voyager\DepartmentController::class, 'forceDelete'])->name('departments.forceDelete');
    Route::get('leave-types/force-delete/{id}', [\App\Http\Controllers\Voyager\LeaveTypeController::class, 'forceDelete'])->name('leave-types.forceDelete');
    Route::get('staff-leave-request/force-delete/{id}', [\App\Http\Controllers\Voyager\StaffLeaveRequestController::class, 'forceDelete'])->name('staff-leave-request.forceDelete');
    Route::get('staff-leave-details/force-delete/{id}', [\App\Http\Controllers\Voyager\StaffLeaveDetailsController::class, 'forceDelete'])->name('staff-leave-details.forceDelete');
    Route::get('staff-attendances/force-delete/{id}', [\App\Http\Controllers\Voyager\StaffController::class, 'forceDelete'])->name('staff-attendances.forceDelete');
    Route::get('staff-id-cards/force-delete/{id}', [\App\Http\Controllers\Voyager\StaffController::class, 'forceDelete'])->name('staff-id-cards.forceDelete');

    //examination
    Route::get('exams/force-delete/{id}', [\App\Http\Controllers\Voyager\ExamController::class, 'forceDelete'])->name('exams.forceDelete');
    Route::get('exam-schedules/force-delete/{id}', [\App\Models\ExamSchedule::class, 'forceDelete'])->name('exam-schedules.forceDelete');
    Route::get('exam-marks/force-delete/{id}', [\App\Http\Controllers\Voyager\ExamMarksController::class, 'forceDelete'])->name('exam-marks.forceDelete');
    Route::get('admitcards/force-delete/{id}', [\App\Http\Controllers\Voyager\ExamMarksController::class, 'forceDelete'])->name('admitcards.forceDelete');

    //downloadCentre
    Route::get('contents/force-delete/{id}', [\App\Http\Controllers\Voyager\ContentController::class, 'forceDelete'])->name('contents.forceDelete');
    Route::get('content-types/force-delete/{id}', [\App\Http\Controllers\Voyager\ContentTypeController::class, 'forceDelete'])->name('content-types.forceDelete');
    //inventory
    Route::get('item-issues/force-delete/{id}', [\App\Http\Controllers\Voyager\ItemIssueController::class, 'forceDelete'])->name('item-issues.forceDelete');
    Route::get('item-stocks/force-delete/{id}', [\App\Http\Controllers\Voyager\ItemStockController::class, 'forceDelete'])->name('item-stocks.forceDelete');
    Route::get('items/force-delete/{id}', [\App\Http\Controllers\Voyager\ItemController::class, 'forceDelete'])->name('items.forceDelete');
    Route::get('item-stores/force-delete/{id}', [\App\Http\Controllers\Voyager\ItemStoreController::class, 'forceDelete'])->name('item-stores.forceDelete');
    Route::get('item-suppliers/force-delete/{id}', [\App\Http\Controllers\Voyager\ItemSupplierController::class, 'forceDelete'])->name('item-suppliers.forceDelete');
    Route::get('item-categories/force-delete/{id}', [\App\Http\Controllers\Voyager\ItemCategoryController::class, 'forceDelete'])->name('item-categories.forceDelete');

    //academics
    Route::get('subjects/force-delete/{id}', [\App\Http\Controllers\Voyager\SubjectController::class, 'forceDelete'])->name('subjects.forceDelete');
    Route::get('class-teachers/force-delete/{id}', [\App\Http\Controllers\backEnd\academic\AcademicController::class, 'forceDelete1'])->name('class-teachers.forceDelete');
    Route::get('timetables/force-delete/{id}', [\App\Http\Controllers\backEnd\academic\AcademicController::class, 'forceDelete2'])->name('timetables.forceDelete');
    Route::get('teacher-subjects/force-delete/{id}', [\App\Http\Controllers\backEnd\academic\AcademicController::class, 'forceDelete3'])->name('teacher-subjects.forceDelete');
    Route::get('student-promotes/force-delete/{id}', [\App\Http\Controllers\backEnd\academic\AcademicController::class, 'forceDelete4'])->name('student-promotes.forceDelete');

   //fee collection
    Route::get('feemasters/force-delete/{id}', [\App\Http\Controllers\Voyager\FeeMasterController::class, 'forceDelete'])->name('feemasters.forceDelete');
    Route::get('fee-groups/force-delete/{id}', [\App\Http\Controllers\Voyager\FeeGroupController::class, 'forceDelete'])->name('fee-groups.forceDelete');
    Route::get('feetypes/force-delete/{id}', [\App\Http\Controllers\Voyager\FeeTypeController::class, 'forceDelete'])->name('feetypes.forceDelete');
    Route::get('fees-discounts/force-delete/{id}', [\App\Http\Controllers\Voyager\FeeDiscountController::class, 'forceDelete'])->name('fees-discounts.forceDelete');

    //front office force delete route
    Route::get('complain-types/forceDelete/{id}', [\App\Http\Controllers\Voyager\ComplainTypeController::class, 'forceDelete'])->name('complain-types.forceDelete');
    Route::get('purposes/forceDelete/{id}', [\App\Http\Controllers\Voyager\PurposeController::class, 'forceDelete'])->name('purposes.forceDelete');
    Route::get('sources/forceDelete/{id}', [\App\Http\Controllers\Voyager\SourceController::class, 'forceDelete'])->name('sources.forceDelete');
    Route::get('references/forceDelete/{id}', [\App\Http\Controllers\Voyager\ReferenceController::class, 'forceDelete'])->name('references.forceDelete');
    Route::get('enquiries/forceDelete/{id}', [\App\Http\Controllers\Voyager\EnquiryController::class, 'forceDelete'])->name('enquiries.forceDelete');
    Route::get('visitor-books/forceDelete/{id}', [\App\Http\Controllers\Voyager\VisitorBookController::class, 'forceDelete'])->name('visitor-books.forceDelete');
    Route::get('general-calls/forceDelete/{id}', [\App\Http\Controllers\Voyager\GeneralCallController::class, 'forceDelete'])->name('general-calls.forceDelete');
    Route::get('dispatch-send/forceDelete/{id}', [\App\Http\Controllers\Voyager\DispatchSendController::class, 'forceDelete'])->name('dispatch-send.forceDelete');
    Route::get('dispatch-receive/forceDelete/{id}', [\App\Http\Controllers\Voyager\DispatchReceiveController::class, 'forceDelete'])->name('dispatch-receive.forceDelete');
    Route::get('complains/forceDelete/{id}', [\App\Http\Controllers\Voyager\ComplainController::class, 'forceDelete'])->name('complains.forceDelete');

    //income force delete route
    Route::get('income-heads/forceDelete/{id}', [\App\Http\Controllers\Voyager\IncomeHeadController::class, 'forceDelete'])->name('income-heads.forceDelete');
    Route::get('incomes/forceDelete/{id}', [\App\Http\Controllers\Voyager\IncomeController::class, 'forceDelete'])->name('incomes.forceDelete');

    //expense force delete route
    Route::get('expense-heads/forceDelete/{id}', [\App\Http\Controllers\Voyager\ExpenseHeadController::class, 'forceDelete'])->name('expense-heads.forceDelete');
    Route::get('expenses/forceDelete/{id}', [\App\Http\Controllers\Voyager\ExpenseController::class, 'forceDelete'])->name('expenses.forceDelete');
    Voyager::routes();
});
