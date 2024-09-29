import React, { useState } from 'react';
import { Container, TextField, Button, IconButton } from '@mui/material';
import AddIcon from '@mui/icons-material/Add';
import RemoveIcon from '@mui/icons-material/Remove';

const AddCategory: React.FC = () => {
  const [categoryName, setCategoryName] = useState('');
  const [subcategories, setSubcategories] = useState(['']);

  const handleCategoryNameChange = (event: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    setCategoryName(event.target.value);
  };

  const handleSubcategoryChange = (index: number, event: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const newSubcategories = subcategories.slice();
    newSubcategories[index] = event.target.value;
    setSubcategories(newSubcategories);
  };

  const handleAddSubcategory = () => {
    setSubcategories([...subcategories, '']);
  };

  const handleRemoveSubcategory = (index: number) => {
    const newSubcategories = subcategories.slice();
    newSubcategories.splice(index, 1);
    setSubcategories(newSubcategories);
  };

  const handleSubmit = (event: React.FormEvent) => {
    event.preventDefault();
    // Handle category addition logic here
    console.log('Category Name:', categoryName);
    console.log('Subcategories:', subcategories);
  };

  return (
    <Container>
      <h1>Add Category</h1>
      <form onSubmit={handleSubmit}>
        <TextField
          label="Category Name"
          value={categoryName}
          onChange={handleCategoryNameChange}
          fullWidth
          required
          margin="normal"
        />
        {subcategories.map((subcategory, index) => (
          <div key={index} style={{ display: 'flex', alignItems: 'center', marginBottom: 8 }}>
            <TextField
              label={`Subcategory ${index + 1}`}
              value={subcategory}
              onChange={(event) => handleSubcategoryChange(index, event)}
              fullWidth
              required
            />
            {subcategories.length > 1 && (
              <IconButton onClick={() => handleRemoveSubcategory(index)}>
                <RemoveIcon />
              </IconButton>
            )}
          </div>
        ))}
        <Button
          type="button"
          variant="outlined"
          color="primary"
          startIcon={<AddIcon />}
          onClick={handleAddSubcategory}
          style={{ marginBottom: 16 }}
        >
          Add Subcategory
        </Button>
        <Button type="submit" 
          onClick={handleSubmit}
          style={{ marginBottom: 16, marginLeft:16 }}
          variant="contained" color="primary">
          Save Category
        </Button>
      </form>
    </Container>
  );
};

export default AddCategory;
