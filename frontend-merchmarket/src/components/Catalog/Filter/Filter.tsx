import React, { useState } from 'react';
import './Filter.css';
import { Filters, CategoryFilters, GenderFilters, SizeFilters } from '../CatalogTypes';

interface FilterProps {
  onFilterChange: (filters: Filters) => void;
}

const Filter: React.FC<FilterProps> = ({ onFilterChange }) => {
  const [filters, setFilters] = useState<Filters>({
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
  });

  const handleCheckboxChange = (filterCategory: keyof Filters, filterName: string) => {
    setFilters(prevFilters => {
      const categoryFilters = prevFilters[filterCategory];
      const updatedCategoryFilters = {
        ...categoryFilters,
        [filterName as keyof typeof categoryFilters]: !categoryFilters[filterName as keyof typeof categoryFilters],
      };
      const newFilters = {
        ...prevFilters,
        [filterCategory]: updatedCategoryFilters,
      };
      onFilterChange(newFilters);
      return newFilters;
    });
  };

  return (
    <div className="filter-container">
      <div className="filter-section">
        <h3 className='filter-category-name'>Категория</h3>
        {Object.keys(filters.category).map(key => (
          <div className='filter-options' key={key}>
            <input
              type="checkbox"
              id={key}
              checked={filters.category[key as keyof CategoryFilters]}
              onChange={() => handleCheckboxChange('category', key)}
            />
            <label className= "filter-category-label" htmlFor={key}>{key}</label>
          </div>
        ))}
      </div>
      <div className="filter-section">
        <h3 className='filter-category-name'>Пол</h3>
        {Object.keys(filters.gender).map(key => (
          <div className='filter-options' key={key}>
            <input
              type="checkbox"
              id={key}
              checked={filters.gender[key as keyof GenderFilters]}
              onChange={() => handleCheckboxChange('gender', key)}
            />
            <label className= "filter-gender-label" htmlFor={key}>{key}</label>
          </div>
        ))}
      </div>
      <div className="filter-section">
        <h3 className='filter-category-name'>Размер</h3>
        {Object.keys(filters.size).map(key => (
          <div className='filter-options' key={key}>
            <input
              type="checkbox"
              id={key}
              checked={filters.size[key as keyof SizeFilters]}
              onChange={() => handleCheckboxChange('size', key)}
            />
            <label className="filter-size" htmlFor={key}>
                {key === 'без_размера' ? (
                    <span className="custom-label">Без размера</span>
                ) : (
                    <span>{key.toUpperCase()}</span>
                )}
            </label>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Filter;
