import apiClient from "./client";

// Repository types
export interface Repository {
  id: number;
  name: string;
  description?: string;
  is_private: boolean;
  user_id: number;
  html_url: string;
  created_at: string;
  updated_at: string;
  user: {
    id: number;
    name: string;
    avatar_url?: string;
    html_url: string;
  };
}

// Vulnerability types
export interface VulnerabilityScan {
  id: number;
  repository_id: number;
  file_path: string;
  vulnerability_type: string;
  severity: 'low' | 'medium' | 'high' | 'critical';
  description: string;
  line_number?: number;
  code_snippet?: string;
  recommendation?: string;
  created_at: string;
  updated_at: string;
}

export interface VulnerabilitySummary {
  total_vulnerabilities: number;
  by_severity: {
    critical: number;
    high: number;
    medium: number;
    low: number;
  };
  by_type: Record<string, number>;
  files_affected: number;
  last_scan?: string;
}

export interface ScanResult {
  repository_id: number;
  total_vulnerabilities: number;
  severity_breakdown: {
    critical: number;
    high: number;
    medium: number;
    low: number;
  };
  scanned_files: number;
}

// API functions
export const repositoryApi = {
  // Get all repositories
  getRepositories: async (): Promise<Repository[]> => {
    const response = await apiClient.get('/github/repositories');
    return response.data;
  },

  // Scan repository for vulnerabilities
  scanRepositoryVulnerabilities: async (owner: string, repository: string): Promise<ScanResult> => {
    const response = await apiClient.post(`/github/vulnerabilities/${owner}/${repository}/scan`);
    return response.data.data;
  },

  // Get vulnerability results for a repository
  getRepositoryVulnerabilities: async (repositoryId: number): Promise<{
    vulnerabilities: VulnerabilityScan[];
    summary: VulnerabilitySummary;
  }> => {
    const response = await apiClient.get(`/github/repositories/${repositoryId}/vulnerabilities`);
    return response.data.data;
  },
};