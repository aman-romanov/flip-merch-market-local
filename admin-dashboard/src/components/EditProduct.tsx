import React from 'react';
import { TextField, Button } from '@mui/material';
import { useParams } from 'react-router-dom';

const EditProduct: React.FC = () => {
  const { id } = useParams<{ id: string }>();

  const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    // Handle edit product logic
  };

  return (
    <form onSubmit={handleSubmit}>
      <TextField label="Product Name" fullWidth required />
      <TextField label="Price" fullWidth required />
      <Button type="submit" variant="contained" color="primary">Save</Button>
    </form>
  );
};

export default EditProduct;
