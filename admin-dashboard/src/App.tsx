import React, { useState } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Sidebar from './components/Sidebar';
import Header from './components/Header';
import CategoryList from './components/CategoryList';
import EditCategory from './components/EditCategory';
import ProductList from './components/ProductList';
import EditProduct from './components/EditProduct';
import AddCategory from './components/AddCategory';
import AddProduct from './components/AddProduct';
import { Container } from '@mui/material';
import { products as initialProducts } from './products'; // Adjust the import based on your file structure

const App: React.FC = () => {
  const [selectedCategory, setSelectedCategory] = useState<string>("");
  const [products, setProducts] = useState(initialProducts);

  const handleSelectCategory = (category: string) => {
    setSelectedCategory(category);
  };

  const handleDeleteCategory = (category: string) => {
    setProducts(prevProducts => {
      // Remove products with the deleted category
      const updatedProducts = prevProducts.filter(product => !product.categories.includes(category));
      return updatedProducts;
    });
  };

  return (
    <Router>
      <Header />
      <div style={{ display: 'flex' }}>
        <Sidebar />
        <Container>
          <Routes>
            <Route 
              path="/" 
              element={<CategoryList products={products} onSelectCategory={handleSelectCategory} onDeleteCategory={handleDeleteCategory} />} 
            />
            <Route 
              path="/categories" 
              element={<CategoryList products={products} onSelectCategory={handleSelectCategory} onDeleteCategory={handleDeleteCategory} />} 
            />
            <Route path="/add-category" element={<AddCategory />} />
            <Route path="/edit-category/:id" element={<EditCategory />} />
            <Route path="/products" element={<ProductList selectedCategory={selectedCategory} />} />
            <Route path="/add-product" element={<AddProduct />} />
            <Route path="/edit-product/:id" element={<EditProduct />} />
          </Routes>
        </Container>
      </div>
    </Router>
  );
};

export default App;
