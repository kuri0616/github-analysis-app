import React from 'react';
import { Container, Typography, Box } from '@mui/material';
import { RepositoryListContainer } from './container/RepositoryListContainer';

export const RepositoryListPage: React.FC = () => {
  return (
    <Container maxWidth="lg">
      <Box py={4}>
        <Typography variant="h4" component="h1" gutterBottom>
          GitHubリポジトリ一覧
        </Typography>
        <RepositoryListContainer />
      </Box>
    </Container>
  );
}; 