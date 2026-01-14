<?php

namespace App\Support;

use App\Models\Company;

class CompanyLimits
{
    public static function canCreateJob(Company $company): bool
    {
        return $company->jobs()->count() < config('limits.free.jobs');
    }

    public static function canAddCandidate(Company $company): bool
    {
        return $company->candidates()->count() < config('limits.free.candidates');
    }

    public static function canAddTeamMember(Company $company): bool
    {
        return $company->users()->count() < config('limits.free.team_members');
    }
}
