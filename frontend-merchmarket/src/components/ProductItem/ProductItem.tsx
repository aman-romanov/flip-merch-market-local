import React from 'react';
import { useNavigate } from 'react-router-dom';
import { Product } from '../../types';
import './ProductItem.css';

interface ProductItemProps {
  product: Product;
}

const ProductItem: React.FC<ProductItemProps> = ({ product }) => {
  const navigate = useNavigate(); 
  const formatPrice = (price: number) => {
    return new Intl.NumberFormat('ru-RU').format(price);
  };

  const handleClick = () => {
    navigate(`/productPage/${product.id}`); 
  };

  return (
    <div className="product-item" onClick={handleClick}>
      <img src={product.mainImage} alt={product.name} className="product-image" />
      <h4 className='product-name'>{product.name}</h4>
      <span className='price-container'>
        <h3 className='product-price'>¥ {formatPrice(product.price)}</h3>
        <span className='product-old-price'>¥ {formatPrice(product.previousPrice)}</span>
      </span>
      <button className="btn-to-cart">В корзину</button>
    </div>
  );
};

export default ProductItem;
