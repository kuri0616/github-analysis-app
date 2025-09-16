import React, { useEffect, useState } from 'react';
import { Repository, repositoryApi } from '../api/repositories';

const RepositoryList: React.FC = () => {
  const [repositories, setRepositories] = useState<Repository[]>([]);
  const [loading, setLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchRepositories = async () => {
      try {
        setLoading(true);
        setError(null);
        const data = await repositoryApi.fetchAll();
        setRepositories(data);
      } catch (err) {
        setError('リポジトリの取得に失敗しました');
        console.error('Failed to fetch repositories:', err);
      } finally {
        setLoading(false);
      }
    };

    fetchRepositories();
  }, []);

  if (loading) {
    return (
      <div className="flex justify-center items-center min-h-32">
        <div className="text-gray-600">読み込み中...</div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="bg-red-50 border border-red-200 rounded-md p-4">
        <div className="text-red-800">{error}</div>
      </div>
    );
  }

  return (
    <div className="space-y-4">
      <h1 className="text-2xl font-bold text-gray-900">リポジトリ一覧</h1>
      
      {repositories.length === 0 ? (
        <div className="text-center py-8 text-gray-500">
          リポジトリが見つかりませんでした
        </div>
      ) : (
        <div className="bg-white shadow overflow-hidden sm:rounded-md">
          <ul className="divide-y divide-gray-200">
            {repositories.map((repo) => (
              <li key={repo.id}>
                <div className="px-4 py-4 sm:px-6">
                  <div className="flex items-center justify-between">
                    <div className="flex-1 min-w-0">
                      <h3 className="text-lg font-medium text-gray-900 truncate">
                        <a 
                          href={repo.html_url} 
                          target="_blank" 
                          rel="noopener noreferrer"
                          className="hover:text-blue-600"
                        >
                          {repo.name}
                        </a>
                      </h3>
                      {repo.description && (
                        <p className="mt-1 text-sm text-gray-600">
                          {repo.description}
                        </p>
                      )}
                      <div className="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                        <span>ID: {repo.id}</span>
                        <span>
                          {repo.is_private ? (
                            <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                              プライベート
                            </span>
                          ) : (
                            <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                              パブリック
                            </span>
                          )}
                        </span>
                        {repo.user && (
                          <span className="flex items-center space-x-1">
                            {repo.user.avatar_url && (
                              <img 
                                src={repo.user.avatar_url} 
                                alt={repo.user.name} 
                                className="w-4 h-4 rounded-full"
                              />
                            )}
                            <span>オーナー: {repo.user.name}</span>
                          </span>
                        )}
                      </div>
                      <div className="mt-1 text-xs text-gray-400">
                        作成日時: {new Date(repo.created_at).toLocaleString('ja-JP')} | 
                        更新日時: {new Date(repo.updated_at).toLocaleString('ja-JP')}
                      </div>
                    </div>
                    <div className="flex-shrink-0">
                      <a 
                        href={repo.html_url} 
                        target="_blank" 
                        rel="noopener noreferrer"
                        className="text-blue-600 hover:text-blue-800 text-sm font-medium"
                      >
                        GitHubで見る →
                      </a>
                    </div>
                  </div>
                </div>
              </li>
            ))}
          </ul>
        </div>
      )}
    </div>
  );
};

export default RepositoryList;