export interface Repository {
  id: number;
  name: string;
  html_url: string;
  description?: string;
  is_private?: boolean;
}

export interface RepositoryListProps {
  repositories: Repository[];
  isLoading: boolean;
  error: Error | null;
} 