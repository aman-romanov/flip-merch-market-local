import React from 'react';
import { TextField, Button } from '@mui/material';
import { useParams } from 'react-router-dom';

const EditCategory: React.FC = () => {
  const { id } = useParams<{ id: string }>();

  const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    // Handle edit category logic
  };

  return (
    <form onSubmit={handleSubmit}>
      <TextField label="Category Name" fullWidth required />
      <Button type="submit" variant="contained" color="primary">Save</Button>
    </form>
  );
};

export default EditCategory;
