import React from 'react';
import { Product } from '../../types';
import './ProductCategory.css';
import ProductCategoryItem from './ProductCategoryItem';

interface ProductCategoryProps {
  title: string;
  products: Product[];
}

const ProductCategory: React.FC<ProductCategoryProps> = ({ title, products }) => {
  return (

    <section className='category-container'>
        {products.map(product => (     
          <ProductCategoryItem key={product.id} product={product} title={title}/>
        ))}  
    </section>

  );
};

export default ProductCategory;
