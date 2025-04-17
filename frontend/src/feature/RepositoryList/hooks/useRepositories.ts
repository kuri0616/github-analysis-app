import useSWR from 'swr';
import { Repository } from '../types';

const fetcher = (url: string) => fetch(url).then((res) => res.json());

export const useRepositories = () => {
  const { data, error, isLoading } = useSWR<Repository[]>(
    '/api/github/repositories',
    fetcher
  );

  return {
    repositories: data || [],
    isLoading,
    error: error as Error | null,
  };
}; 