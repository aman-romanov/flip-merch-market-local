export interface Product {
    id: number;
    name: string;
    description: string;
    link: string;
    price: number;
    mainImage: string,
    additionalImages: string[],
    categories: string[];
    subcategory: string[],
    colors: string[];
    sizes: string[];
    gender: string[];
    previousPrice:number;
  }
  