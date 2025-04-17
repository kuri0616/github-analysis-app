import React from 'react';
import { 
  Box, 
  Card, 
  CardContent, 
  Typography, 
  CircularProgress, 
  Alert,
  Grid
} from '@mui/material';
import { RepositoryListProps } from '../types';

export const RepositoryListPresenter: React.FC<RepositoryListProps> = ({
  repositories,
  isLoading,
  error,
}) => {
  if (isLoading) {
    return (
      <Box display="flex" justifyContent="center" alignItems="center" minHeight="200px">
        <CircularProgress />
      </Box>
    );
  }

  if (error) {
    return (
      <Alert severity="error">
        エラーが発生しました: {error.message}
      </Alert>
    );
  }

  if (repositories.length === 0) {
    return (
      <Alert severity="info">
        リポジトリが見つかりませんでした。
      </Alert>
    );
  }

  return (
    <Grid container spacing={2}>
      {repositories.map((repo) => (
        <Grid item xs={12} sm={6} md={4} key={repo.id}>
          <Card>
            <CardContent>
              <Typography variant="h6" component="div" gutterBottom>
                {repo.name}
              </Typography>
              {repo.description && (
                <Typography variant="body2" color="text.secondary" gutterBottom>
                  {repo.description}
                </Typography>
              )}
              <Typography variant="body2">
                <a href={repo.html_url} target="_blank" rel="noopener noreferrer">
                  GitHubで見る
                </a>
              </Typography>
            </CardContent>
          </Card>
        </Grid>
      ))}
    </Grid>
  );
}; 