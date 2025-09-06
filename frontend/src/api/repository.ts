import apiClient from "./client";

export interface GitHubUser {
  id: number;
  name: string;
  avatar_url: string;
  html_url: string;
}

export interface Repository {
  id: number;
  name: string;
  description: string | null;
  is_private: boolean;
  user_id: number;
  html_url: string;
  created_at: string;
  updated_at: string;
  user?: GitHubUser;
}

export const repositoryApi = {
  async getAll(): Promise<Repository[]> {
    const response = await apiClient.get('/github/repositories');
    return response.data;
  }
};