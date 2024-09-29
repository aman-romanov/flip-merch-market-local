import React from 'react';
import './PaginationButton.css';

interface PaginationButtonsProps {
  totalPages: number;
  currentPage: number;
  onPageChange: (pageNumber: number) => void;
}

const PaginationButtons: React.FC<PaginationButtonsProps> = ({ totalPages, currentPage, onPageChange }) => {
  const renderPagination = () => {
    const pages = [];
    const maxPagesToShow = 3;

    // Calculate start and end of visible page numbers
    let startPage = Math.max(currentPage - Math.floor(maxPagesToShow / 2), 1);
    const endPage = Math.min(startPage + maxPagesToShow - 1, totalPages);

    // Adjust startPage and endPage to always show maxPagesToShow pages
    if (endPage - startPage + 1 < maxPagesToShow) {
      startPage = Math.max(endPage - maxPagesToShow + 1, 1);
    }

    // Handle ellipses and first page
    if (startPage > 1) {
      pages.push(1);
      if (startPage > 2) {
        pages.push('...');
      }
    }

    // Add visible page numbers
    for (let i = startPage; i <= endPage; i++) {
      pages.push(i);
    }

    // Handle ellipses and last page
    if (endPage < totalPages) {
      if (endPage < totalPages - 1) {
        pages.push('...');
      }
      pages.push(totalPages);
    }

    // Render each page number or ellipsis as a button or span
    return pages.map((page, index) =>
      typeof page === 'number' ? (
        <button
          key={index}
          onClick={() => onPageChange(page)}
          className={currentPage === page ? 'active' : ''}
        >
          {page}
        </button>
      ) : (
        <span key={index}>{page}</span>
      )
    );
  };

  return <div className="pagination-buttons">{renderPagination()}</div>;
};

export default PaginationButtons;
