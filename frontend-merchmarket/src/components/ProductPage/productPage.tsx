import React, { useState } from 'react';
import { useParams } from 'react-router-dom';
import { products } from '../products';
import ImageSlider from './ImageSlider';
import "./productPage.css";
import NumberLabel from './NumberLabel';

const ProductPage: React.FC = () => {
  const { id } = useParams<{ id: string | undefined }>();
  const productId = id ? Number(id) : undefined;
  const product = productId ? products.find(p => p.id === productId) : undefined;

  const [selectedImage, setSelectedImage] = useState(product?.mainImage);
  const [selectedSize, setSelectedSize] = useState<string | null>(null);

  if (!product) {
    return <div>Product not found</div>;
  }

  const formatPrice = (price: number) => {
    return new Intl.NumberFormat('ru-RU').format(price);
  };

  const images = [
    { label: product.name, imgPath: product.mainImage },
    ...product.additionalImages.map((img, index) => ({ label: `${product.name} - ${index + 1}`, imgPath: img })),
  ];

  return (
    <div className="product-page">
      <div className='product-image-left'>
        <ImageSlider images={images} />
      </div>
      <div className='product-overview-right'>
        <h1 className='product-overview-name'>{product.name}</h1>
        <h3 className='product-overview-category'>{product.categories}</h3>
        <div >
        <span className='overview-title'>Цена: </span> 
        <div className='overview-price-container'>
        <h3 className='product-overview-price'>¥ {formatPrice(product.price)}</h3>
   
        {product.previousPrice && (
          <span className='product-overview-old-price'>¥ {formatPrice(product.previousPrice)}</span>
        )}
             </div>
             </div>
             <div>  
        <span className='overview-title'>Цвет: </span> 
        <div className='color-selection'>
          {product.additionalImages.map((img, index) => (
            <button
              key={index}
              className={`color-box ${selectedImage === img ? 'selected' : ''}`}
              onClick={() => setSelectedImage(img)}
              style={{ backgroundImage: `url(${img})` }}
            >
              {selectedImage === img && <span className="checkmark">✔</span>}
            </button>
          ))}
        </div>
        </div>
      
        <span className='overview-title'>Размер:</span> 
        <div>
       <div className='size-selection'>
          {product.sizes.map((size, index) => (
            <button
              key={index}
              className={`size-box ${selectedSize === size ? 'selected' : ''}`}
              onClick={() => setSelectedSize(size)}
            >
              {size}
            </button>
          ))}
        </div>
        </div>
        <div className='overview-btn-container'>
        
        <h3 className='product-overview-number'><NumberLabel /></h3>
        <button className='btn-to-cart-overview'>Добавить в корзину</button>
        </div>
         <p className='product-overview-description'>{product.description}</p>
      </div>
    </div>
  );
};

export default ProductPage;
