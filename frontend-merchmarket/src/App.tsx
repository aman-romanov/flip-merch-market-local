import { BrowserRouter as Router, Route, Routes, useLocation } from 'react-router-dom';
import { useState } from 'react';
import ProductCategory from './components/ProductCategory';
import ProductItem from './components/ProductItem';
import { Product } from './types';
import Points from './components/Header/component/points';
import Header from './components/Header';
import './App.css';
import Dubai from './components/Dubai';
import { products as staticProducts } from './components/products'
import Footer from './components/Footer';
import Catalog from './components/Catalog';
import ProductPage from './components/ProductPage';

function App() {
  return (
    <Router>
      <Main />
    </Router>
  );
}

function Main() {
  const [products] = useState<Product[]>(staticProducts); 
  const location = useLocation();
  const isRootPath = location.pathname === '/';

  const categories = products.reduce((acc: Record<string, Product[]>, product) => {
    product.categories.forEach(category => {
      if (!acc[category]) acc[category] = [];
      acc[category].push(product);
    });
    return acc;
  }, {});

  return (
    <>
      <Header />
      <Routes>
        <Route path="/catalog" element={<Catalog />} />
        <Route path="/points" element={<Points />} />
        <Route path="/productPage/:id" element={<ProductPage />} />
      </Routes>
      {isRootPath && (
        <>
          <Dubai />
          <section className='category-title'>
            <h2 className='title-name'>Категории товаров</h2>
            <div className="categories-container">
              {Object.keys(categories).map(category => (
                <ProductCategory 
                  key={category} 
                  title={category} 
                  products={categories[category].slice(0, 1)}
                />
              ))}
            </div>
            <span className='category-bottom-text'>
              Все цены на товары указаны во внутренней валюте flip
            </span>
          </section>
          <section className='popular-title'>
            <h2 className='title-name'>Популярно среди вашего отдела</h2>
            <div className="popular-container">
              {products.slice(0, 8).map(product => ( 
                <ProductItem key={product.id} product={product} />
              ))}
            </div>
            <button className='btn-popular'>
              Все товары
            </button>
          </section>
        </>
      )}
      <Footer />
    </>
  );
}

export default App;