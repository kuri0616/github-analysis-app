<?php

namespace App\Contexts\GitHubApi\UseCase;

use App\Models\Repository;
use App\Models\VulnerabilityScan;
use Illuminate\Support\Collection;

class FetchRepositoryVulnerabilitiesUseCase
{
    public function handle(int $repositoryId): Collection
    {
        $repository = Repository::findOrFail($repositoryId);
        
        return VulnerabilityScan::where('repository_id', $repository->id)
            ->with('repository')
            ->orderBy('severity', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getVulnerabilitySummary(int $repositoryId): array
    {
        $repository = Repository::findOrFail($repositoryId);
        
        $vulnerabilities = VulnerabilityScan::where('repository_id', $repository->id)->get();
        
        $summary = [
            'total_vulnerabilities' => $vulnerabilities->count(),
            'by_severity' => [
                'critical' => $vulnerabilities->where('severity', 'critical')->count(),
                'high' => $vulnerabilities->where('severity', 'high')->count(),
                'medium' => $vulnerabilities->where('severity', 'medium')->count(),
                'low' => $vulnerabilities->where('severity', 'low')->count(),
            ],
            'by_type' => $vulnerabilities->groupBy('vulnerability_type')->map->count(),
            'files_affected' => $vulnerabilities->pluck('file_path')->unique()->count(),
            'last_scan' => $vulnerabilities->max('created_at'),
        ];

        return $summary;
    }
}