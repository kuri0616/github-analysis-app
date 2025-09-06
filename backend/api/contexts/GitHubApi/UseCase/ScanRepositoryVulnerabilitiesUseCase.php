<?php

namespace App\Contexts\GitHubApi\UseCase;

use App\Models\Repository;
use App\Models\VulnerabilityScan;
use App\Services\VulnerabilityDetectorService;
use App\Contexts\GitHubApi\Exception\GitHubApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ScanRepositoryVulnerabilitiesUseCase
{
    public function __construct(
        private readonly VulnerabilityDetectorService $vulnerabilityDetector,
        private readonly Client $httpClient = new Client()
    )
    {
    }

    public function handle(string $owner, string $repositoryName): array
    {
        // Find repository in database
        $repository = Repository::where('name', $repositoryName)->first();
        if (!$repository) {
            throw new GitHubApiException("Repository {$owner}/{$repositoryName} not found in database. Please import it first.");
        }

        // Clear existing vulnerability scans for this repository
        VulnerabilityScan::where('repository_id', $repository->id)->delete();

        try {
            // Get repository tree from GitHub API (sample files for demonstration)
            $files = $this->fetchRepositoryFiles($owner, $repositoryName);
            
            // Scan files for vulnerabilities
            $vulnerabilities = $this->vulnerabilityDetector->scanRepository($repository->id, $files);
            
            // Save vulnerabilities to database
            $this->vulnerabilityDetector->saveVulnerabilities($vulnerabilities);

            return [
                'repository_id' => $repository->id,
                'total_vulnerabilities' => count($vulnerabilities),
                'severity_breakdown' => $this->getSeverityBreakdown($vulnerabilities),
                'scanned_files' => count($files)
            ];

        } catch (GuzzleException $e) {
            throw new GitHubApiException("Failed to fetch repository files: " . $e->getMessage());
        }
    }

    private function fetchRepositoryFiles(string $owner, string $repositoryName): array
    {
        // For demonstration purposes, we'll create sample vulnerable code files
        // In a real implementation, this would fetch files from GitHub API
        return [
            [
                'path' => 'src/login.php',
                'content' => '<?php
$user = $_GET["username"];
$pass = $_GET["password"];
$query = "SELECT * FROM users WHERE username=\'$user\' AND password=\'$pass\'";
$result = mysql_query($query);
echo "Welcome " . $_GET["username"];
?>'
            ],
            [
                'path' => 'src/admin.php', 
                'content' => '<?php
$api_key = "sk-1234567890abcdef";
$password = "admin123";
$cmd = $_POST["command"];
system($cmd);
include($_GET["page"] . ".php");
?>'
            ],
            [
                'path' => 'src/utils.js',
                'content' => 'function generateToken() {
    return Math.random().toString(36);
}

function displayMessage(msg) {
    document.getElementById("output").innerHTML = userInput;
}'
            ]
        ];
    }

    private function getSeverityBreakdown(array $vulnerabilities): array
    {
        $breakdown = ['critical' => 0, 'high' => 0, 'medium' => 0, 'low' => 0];
        
        foreach ($vulnerabilities as $vulnerability) {
            $severity = $vulnerability['severity'];
            if (isset($breakdown[$severity])) {
                $breakdown[$severity]++;
            }
        }

        return $breakdown;
    }
}