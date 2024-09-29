
import './searchBar.css';

const SearchBar = () => {
  return (
        <div className="search-bar">
        <input type="search" id="search-input" className = "search-input" placeholder="Поиск" />
        <button id="search-button" className = "search-button">Найти</button>
        </div>
  );
};




export default SearchBar;
