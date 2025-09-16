import apiClient from "./client";

export interface GitHubUser {
  id: number;
  name: string;
  avatar_url: string | null;
  html_url: string | null;
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
  fetchAll: async (): Promise<Repository[]> => {
    const response = await apiClient.get("/github/repositories");
    return response.data;
  },
};