import React from 'react';
import { Product } from '../../../types';
import './ProductCategoryItem.css';

interface ProductItemProps {
  product: Product;
  title: string;
}

const ProductCategoryItem: React.FC<ProductItemProps> = ({ product, title }) => {
   // Function to format the price
   const formatPrice = (price: number) => {
    return new Intl.NumberFormat('ru-RU').format(price);
  };
  return (
    <div className="product-category-item">
      <div className="product-category-images">
        <div className="product-main-image-container">
          <img src={product.mainImage} alt={product.name} className="product-main-image" />
        </div>
        <div className="product-add-images-container">
          <div className="product-add-image">
            <img src={product.additionalImages[0]} alt={product.name} />
          </div>
          <div className="product-add-image">
            <img src={product.additionalImages[1]} alt={product.name} />
          </div>
        </div>
      </div>
      <h4 className='category-name'>{title}</h4>
      <p className='category-price'>от ¥ {formatPrice(product.price)}</p>
      <button className="btn-category">Все товары раздела</button>
    </div>
  );
};

export default ProductCategoryItem;
