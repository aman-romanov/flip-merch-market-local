
export interface CategoryFilters {
    футболки: boolean;
    худи: boolean;
    свитшоты: boolean;
    штаны: boolean;
    бейсболки: boolean;
    перчатки: boolean;
    очки: boolean;
  }
  
  export interface GenderFilters {
    мужской: boolean;
    женский: boolean;
    унисекс: boolean;
  }
  
  export interface SizeFilters {
    без_размера: boolean;
    xs: boolean;
    s: boolean;
    m: boolean;
    l: boolean;
    xl: boolean;
    xxl: boolean;
  }
  
  export interface Filters {
    category: CategoryFilters;
    gender: GenderFilters;
    size: SizeFilters;
  }
  