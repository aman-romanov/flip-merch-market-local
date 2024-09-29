import React, { useState } from 'react';
import CategoryList from './CategoryList';
import { products as initialProducts } from '../products'; // Adjust the import based on your file structure

const ParentComponent: React.FC = () => {
  const [products, setProducts] = useState(initialProducts);

  const handleDeleteCategory = (category: string) => {
    setProducts(prevProducts => {
      // Remove products with the deleted category
      const updatedProducts = prevProducts.filter(product => !product.categories.includes(category));
      return updatedProducts;
    });
  };

  const handleSelectCategory = (category: string) => {
    // Placeholder function for selecting a category
    console.log('Selected category:', category);
  };

  return (
    <div>
      <CategoryList 
        products={products} 
        onSelectCategory={handleSelectCategory} 
        onDeleteCategory={handleDeleteCategory} 
      />
    </div>
  );
};

export default ParentComponent;
