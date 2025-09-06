import React, { useEffect, useState } from 'react';
import { Repository, repositoryApi } from '../api/repository';

const RepositoryList: React.FC = () => {
  const [repositories, setRepositories] = useState<Repository[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchRepositories = async () => {
      try {
        setLoading(true);
        const data = await repositoryApi.getAll();
        setRepositories(data);
      } catch (err) {
        setError('リポジトリの取得に失敗しました。');
        console.error('Error fetching repositories:', err);
      } finally {
        setLoading(false);
      }
    };

    fetchRepositories();
  }, []);

  if (loading) {
    return (
      <div className="flex justify-center items-center p-8">
        <div className="text-lg">読み込み中...</div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="flex justify-center items-center p-8">
        <div className="text-red-500 text-lg">{error}</div>
      </div>
    );
  }

  return (
    <div className="container mx-auto p-4">
      <h1 className="text-3xl font-bold text-gray-800 mb-6">リポジトリ一覧</h1>
      
      {repositories.length === 0 ? (
        <div className="text-center text-gray-500 p-8">
          リポジトリが見つかりませんでした。
        </div>
      ) : (
        <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
          {repositories.map((repo) => (
            <div
              key={repo.id}
              className="bg-white rounded-lg shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow"
            >
              <div className="flex items-start justify-between mb-3">
                <h2 className="text-xl font-semibold text-gray-800 truncate">
                  {repo.name}
                </h2>
                {repo.is_private && (
                  <span className="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                    Private
                  </span>
                )}
              </div>
              
              {repo.description && (
                <p className="text-gray-600 mb-3 line-clamp-2">
                  {repo.description}
                </p>
              )}
              
              <div className="space-y-2 text-sm text-gray-500">
                <div>
                  <span className="font-medium">ID:</span> {repo.id}
                </div>
                <div>
                  <span className="font-medium">所有者:</span> {repo.user?.name || `User ${repo.user_id}`}
                </div>
                <div>
                  <span className="font-medium">作成日:</span> {new Date(repo.created_at).toLocaleDateString('ja-JP')}
                </div>
                <div>
                  <span className="font-medium">更新日:</span> {new Date(repo.updated_at).toLocaleDateString('ja-JP')}
                </div>
              </div>
              
              <div className="mt-4 pt-4 border-t border-gray-100">
                <a
                  href={repo.html_url}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium"
                >
                  GitHubで見る
                  <svg className="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                  </svg>
                </a>
              </div>
            </div>
          ))}
        </div>
      )}
      
      <div className="mt-8 text-center text-gray-500">
        {repositories.length} 件のリポジトリが見つかりました。
      </div>
    </div>
  );
};

export default RepositoryList;