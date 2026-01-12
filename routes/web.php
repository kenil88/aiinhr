<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\CandidateDetail;
use App\Livewire\Admin\CompaniesIndex;
use App\Livewire\Admin\JobApplications;
use App\Livewire\Admin\JobsIndex;
use App\Livewire\Company\Applications\ApplicationShow;
use App\Livewire\Company\Candidates\CandidateShow;
use App\Livewire\Company\Candidates\CandidatesIndex;
use App\Livewire\Company\Jobs\JobApplications as CompanyJobApplications;
use App\Livewire\Company\TeamMembers;
use App\Livewire\Dashboard\HrDashboard;
use App\Livewire\Company\Jobs\JobForm;
use App\Livewire\Company\Jobs\JobsIndex as CompanyJobsIndex;
use App\Livewire\Company\Jobs\JobStages;
use App\Livewire\Company\Profile\CompanyProfileView;
use App\Livewire\Company\Settings\CompanyProfile;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Company ATS Routes (HR / Recruiter / Viewer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'company', 'active', 'company.active'])->group(function () {

    Route::get('/dashboard', HrDashboard::class)
        ->name('dashboard');

    Route::get('/team', TeamMembers::class)
        ->name('company.team');
});

Route::middleware(['auth', 'active', 'company'])
    ->get('/company/resume/{application}', [ResumeController::class, 'show'])
    ->name('company.resume.show');


Route::middleware(['auth', 'active', 'company'])
    ->prefix('company')
    ->name('company.')
    ->group(function () {

        Route::get('/jobs', CompanyJobsIndex::class)->name('jobs');
        Route::get('/jobs/create', JobForm::class)->name('jobs.create');
        Route::get('/jobs/{job}/edit', JobForm::class)->name('jobs.edit');

        Route::get('/jobs/{job}/applications', CompanyJobApplications::class)
            ->name('jobs.applications');

        Route::get('/applications/{application}', ApplicationShow::class)
            ->name('applications.show');

        Route::get('/candidates', CandidatesIndex::class)
            ->name('candidates.index');

        Route::get('/candidates/{candidate}', CandidateShow::class)
            ->name('candidates.show');

        Route::get('/profile', CompanyProfileView::class)
            ->name('profile.view');

        // Edit company profile (Owner only)
        Route::get('/settings/profile', CompanyProfile::class)
            ->middleware('role:owner')
            ->name('profile.edit');

        Route::get('/company/jobs/{job}/stages', JobStages::class)
            ->name('company.jobs.stages');
    });


/*
|--------------------------------------------------------------------------
| Profile Routes (Authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
/*
|--------------------------------------------------------------------------
| Admin Routes (Platform Owner)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', AdminDashboard::class)
            ->name('dashboard');

        Route::get('/companies', CompaniesIndex::class)
            ->name('companies');

        Route::get('/jobs', JobsIndex::class)
            ->name('jobs');

        Route::get('/jobs/{job}/applications', JobApplications::class)
            ->name('jobs.applications');

        Route::get('/applications/{application}', CandidateDetail::class)
            ->name('applications.show');
    });

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
