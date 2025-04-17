import React from 'react';
import { RepositoryListPresenter } from '../presenter/RepositoryListPresenter';
import { useRepositories } from '../hooks/useRepositories';

export const RepositoryListContainer: React.FC = () => {
  const { repositories, isLoading, error } = useRepositories();

  return (
    <RepositoryListPresenter
      repositories={repositories}
      isLoading={isLoading}
      error={error}
    />
  );
}; 