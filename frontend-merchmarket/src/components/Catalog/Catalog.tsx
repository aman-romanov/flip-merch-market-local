import React, { useState, useEffect } from 'react';
import { Product } from '../../types';
import { products as staticProducts } from '../products';
import ProductItem from '../ProductItem';
import Filter from './Filter';
import { Filters } from './CatalogTypes';
import PaginationButtons from './PaginationButtons'; 
import "./Catalog.css";

const initialFilters: Filters = {
  category: {
    футболки: false,
    худи: false,
    свитшоты: false,
    штаны: false,
    бейсболки: false,
    перчатки: false,
    очки: false,
  },
  gender: {
    мужской: false,
    женский: false,
    унисекс: false,
  },
  size: {
    без_размера: false,
    xs: false,
    s: false,
    m: false,
    l: false,
    xl: false,
    xxl: false,
  },
};

function morph(int: number, array?: string[]) {
  return (array = array || ['товар', 'товара', 'товаров']) &&
    array[(int % 100 > 4 && int % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][(int % 10 < 5) ? int % 10 : 5]];
}

function Catalog() {
  const [filters, setFilters] = useState<Filters>(initialFilters);
  const [filteredProducts, setFilteredProducts] = useState<Product[]>(staticProducts);
  const [currentPage, setCurrentPage] = useState<number>(1);
  const [sortOrder, setSortOrder] = useState<string>('asc');

  const productsPerPage = 12;

  useEffect(() => {
    let filtered = staticProducts;

    if (Object.values(filters.category).some(Boolean)) {
      filtered = filtered.filter(product =>
        product.subcategory.some(category =>
          filters.category[category as keyof typeof filters.category]
        )
      );
    }

    if (Object.values(filters.gender).some(Boolean)) {
      filtered = filtered.filter(product =>
        product.gender.some(gender =>
          filters.gender[gender as keyof typeof filters.gender]
        )
      );
    }

    if (Object.values(filters.size).some(Boolean)) {
      filtered = filtered.filter(product =>
        product.sizes.some(size =>
          filters.size[size as keyof typeof filters.size]
        )
      );
    }

    if (sortOrder === 'asc') {
      filtered = filtered.sort((a, b) => a.price - b.price);
    } else if (sortOrder === 'desc') {
      filtered = filtered.sort((a, b) => b.price - a.price);
    } 

    setFilteredProducts(filtered);
    setCurrentPage(1);
  }, [filters, sortOrder]);

  const handleFilterChange = (newFilters: Filters) => {
    setFilters(newFilters);
  };

  const handlePageChange = (pageNumber: number) => {
    setCurrentPage(pageNumber);
  };

  const handleSortChange = (event: React.ChangeEvent<HTMLSelectElement>) => {
    setSortOrder(event.target.value);
  };

  const startIndex = (currentPage - 1) * productsPerPage;
  const currentProducts = filteredProducts.slice(startIndex, startIndex + productsPerPage);
  const totalPages = Math.ceil(filteredProducts.length / productsPerPage);

  return (
    <div className='catalog-page'>
      <section className="chosen-category-container">
        <p className="chosen-category-title-left">
          Одежда и аксессуары
        </p>
        <p className="chosen-category-title-right">
          <span className='text-top-catalog'>Каталог </span>|
          <span> Одежда и аксессуары</span>
        </p>
      </section>
      <div className='catalog-content'>
        <section className="filter">
          <Filter onFilterChange={handleFilterChange} />
        </section>
        <div className='catalog-results'>
          <section className='filter-detail'>
            <p className='product-number'>
              {filteredProducts.length} {morph(filteredProducts.length)}
            </p>
            <select className="sort-select" onChange={handleSortChange}>
              <option value="asc">По возрастанию</option>
              <option value="desc">По убыванию</option>
              <option value="popular">По популярности</option>
            </select>
          </section>
          <section className="filtered-products">
            {currentProducts.map(product => (
              <ProductItem key={product.id} product={product} />
            ))}
          </section>
          <section className="pagination">
            <PaginationButtons
              totalPages={totalPages}
              currentPage={currentPage}
              onPageChange={handlePageChange}
            />
          </section>
        </div>
      </div>
    </div>
  );
}

export default Catalog;
