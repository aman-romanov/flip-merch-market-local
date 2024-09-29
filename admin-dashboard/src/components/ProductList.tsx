import React from 'react';
import { products } from '../products'; // Adjust import according to your file structure
import {
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Paper,
} from '@mui/material';

interface ProductListProps {
  selectedCategory: string;
}

const ProductList: React.FC<ProductListProps> = ({ selectedCategory }) => {
  const filteredProducts = products.filter(product =>
    product.categories.includes(selectedCategory)
  );

  return (
    <TableContainer component={Paper}>
      <Table>
        <TableHead>
          <TableRow>
            <TableCell>ID</TableCell>
            <TableCell>Image</TableCell>
            <TableCell>Name</TableCell>
            <TableCell>Price</TableCell>
            <TableCell>Description</TableCell>
            <TableCell>Link</TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          {filteredProducts.map(product => (
            <TableRow key={product.id}>
              <TableCell>{product.id}</TableCell>
              <TableCell>
                <img
                  src={`${product.mainImage}`}
                  alt={product.name}
                  style={{ width: '80px', height: '60px' }}
                />
              </TableCell>
              <TableCell>{product.name}</TableCell>
              <TableCell>{product.price}₽</TableCell>
              <TableCell>{product.description}</TableCell>
              <TableCell>
                <a href={product.link} target="_blank" rel="noopener noreferrer">
                  View Product
                </a>
              </TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </TableContainer>
  );
};

export default ProductList;
