import { Repository } from '../api/repository';

export const mockRepositories: Repository[] = [
  {
    id: 1,
    name: "github-analysis-app",
    description: "GitHub上のリポジトリやプルリクエストの分析を行うウェブアプリケーション",
    is_private: false,
    user_id: 1,
    html_url: "https://github.com/kuri0616/github-analysis-app",
    created_at: "2024-01-15T10:30:00Z",
    updated_at: "2024-03-20T14:45:00Z",
    user: {
      id: 1,
      name: "kuri0616",
      avatar_url: "https://github.com/kuri0616.png",
      html_url: "https://github.com/kuri0616"
    }
  },
  {
    id: 2,
    name: "react-data-visualization",
    description: "Reactを使ったデータ可視化ライブラリとチャートコンポーネント集",
    is_private: false,
    user_id: 1,
    html_url: "https://github.com/kuri0616/react-data-visualization",
    created_at: "2024-02-01T09:15:00Z",
    updated_at: "2024-03-18T16:20:00Z",
    user: {
      id: 1,
      name: "kuri0616",
      avatar_url: "https://github.com/kuri0616.png",
      html_url: "https://github.com/kuri0616"
    }
  },
  {
    id: 3,
    name: "typescript-utils",
    description: "TypeScript開発で便利なユーティリティ関数とヘルパークラス",
    is_private: true,
    user_id: 2,
    html_url: "https://github.com/kuri0616/typescript-utils",
    created_at: "2024-01-20T11:00:00Z",
    updated_at: "2024-03-19T13:30:00Z",
    user: {
      id: 2,
      name: "developer-2",
      avatar_url: "https://github.com/developer-2.png",
      html_url: "https://github.com/developer-2"
    }
  },
  {
    id: 4,
    name: "laravel-api-boilerplate",
    description: "Laravel REST API開発のためのボイラープレートプロジェクト",
    is_private: false,
    user_id: 3,
    html_url: "https://github.com/kuri0616/laravel-api-boilerplate",
    created_at: "2024-02-10T08:45:00Z",
    updated_at: "2024-03-22T10:15:00Z",
    user: {
      id: 3,
      name: "backend-dev",
      avatar_url: "https://github.com/backend-dev.png",
      html_url: "https://github.com/backend-dev"
    }
  },
  {
    id: 5,
    name: "docker-compose-templates",
    description: "様々な開発環境用のDocker Composeテンプレート集",
    is_private: false,
    user_id: 1,
    html_url: "https://github.com/kuri0616/docker-compose-templates",
    created_at: "2024-01-25T15:20:00Z",
    updated_at: "2024-03-21T09:50:00Z",
    user: {
      id: 1,
      name: "kuri0616",
      avatar_url: "https://github.com/kuri0616.png",
      html_url: "https://github.com/kuri0616"
    }
  },
  {
    id: 6,
    name: "vue-component-library",
    description: "再利用可能なVue.jsコンポーネントライブラリ",
    is_private: false,
    user_id: 4,
    html_url: "https://github.com/kuri0616/vue-component-library",
    created_at: "2024-02-05T12:10:00Z",
    updated_at: "2024-03-17T17:40:00Z",
    user: {
      id: 4,
      name: "frontend-specialist",
      avatar_url: "https://github.com/frontend-specialist.png",
      html_url: "https://github.com/frontend-specialist"
    }
  }
];