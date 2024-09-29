import React from 'react';
import {
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Paper,
  IconButton,
} from '@mui/material';
import EditIcon from '@mui/icons-material/Edit';
import DeleteIcon from '@mui/icons-material/Delete';

interface CategoryListProps {
  products: { categories: string[]; subcategory: string[] }[];
  onSelectCategory: (category: string) => void;
  onDeleteCategory: (category: string) => void;
}

const CategoryList: React.FC<CategoryListProps> = ({ products, onSelectCategory, onDeleteCategory }) => {
  // Extract unique categories and their subcategories
  const categoryMap = products.reduce((acc, product) => {
    product.categories.forEach((category, index) => {
      if (!acc[category]) {
        acc[category] = new Set();
      }
      acc[category].add(product.subcategory[index]);
    });
    return acc;
  }, {} as { [key: string]: Set<string> });

  const handleEdit = (category: string) => {
    // Placeholder function for edit action
    console.log('Edit category:', category);
  };

  return (
    <TableContainer component={Paper}>
      <Table>
        <TableHead>
          <TableRow>
            <TableCell>Category</TableCell>
            <TableCell>Subcategories</TableCell>
            <TableCell>Actions</TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          {Object.entries(categoryMap).map(([category, subcategories]) => (
            <TableRow key={category} onClick={() => onSelectCategory(category)}>
              <TableCell>{category}</TableCell>
              <TableCell>
                {Array.from(subcategories).map((subcat, index) => (
                  <div key={index}>{subcat}</div>
                ))}
              </TableCell>
              <TableCell>
                <IconButton onClick={() => handleEdit(category)}>
                  <EditIcon />
                </IconButton>
                <IconButton onClick={() => onDeleteCategory(category)}>
                  <DeleteIcon />
                </IconButton>
              </TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </TableContainer>
  );
};

export default CategoryList;
