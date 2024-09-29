import React, { useState } from 'react';
import { Container, TextField, Button, MenuItem, Select, InputLabel, FormControl, SelectChangeEvent, Grid, IconButton } from '@mui/material';
import AddIcon from '@mui/icons-material/Add';

interface Product {
  id:number;
  name: string;
  description: string;
  link: string;
  price: number;
  previousPrice: number;
  mainImage: string;
  additionalImages: string[];
  categories: string[];
  subcategory: string[];
  colors: string[];
  sizes: string[];
  gender: string[];
}

const categoriesList = ["Одежда и аксессуары"];
const subcategoriesList = ["свитшоты"];
const colorsList = ["#FFFFFF"];
const sizesList = ["m", "l"];
const genderList = ["мужской", "женский"];

const AddProduct: React.FC = () => {
  const [product, setProduct] = useState<Product>({
    id: 0,
    name: '',
    description: '',
    link: '',
    price: 0,
    previousPrice: 0,
    mainImage: '',
    additionalImages: [],
    categories: [],
    subcategory: [],
    colors: [],
    sizes: [],
    gender: []
  });
  const [additionalImageFiles, setAdditionalImageFiles] = useState<File[]>([]);

  const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = event.target;
    setProduct((prevProduct) => ({
      ...prevProduct,
      [name]: value,
    }));
  };

  const handleSelectChange = (event: SelectChangeEvent<string[]>) => {
    const { name, value } = event.target;
    setProduct((prevProduct) => ({
      ...prevProduct,
      [name as string]: value as string[],
    }));
  };

  const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const { name, files } = event.target;
    if (files) {
      const fileArray = Array.from(files);
      if (name === "mainImage") {
        setProduct((prevProduct) => ({
          ...prevProduct,
          mainImage: URL.createObjectURL(fileArray[0]),
        }));
      } else if (name.startsWith("additionalImage")) {
        const index = parseInt(name.split("_")[1], 10);
        const updatedAdditionalImages = [...additionalImageFiles];
        updatedAdditionalImages[index] = fileArray[0];
        setAdditionalImageFiles(updatedAdditionalImages);
        setProduct((prevProduct) => ({
          ...prevProduct,
          additionalImages: updatedAdditionalImages.map((file) => URL.createObjectURL(file)),
        }));
      }
    }
  };

  const handleAddAdditionalImage = () => {
    setAdditionalImageFiles((prev) => [...prev, new File([], "")]);
  };

  const handleSubmit = (event: React.FormEvent) => {
    event.preventDefault();
    // Logic to add product by ID can be added here
    console.log('Product added:', product);
  };

  return (
    <Container>
      <h1>Add Product</h1>
      <form onSubmit={handleSubmit}>
        <Grid container spacing={3}>
          <Grid item xs={12}>
            <TextField
              name="id"
              label="ID"
              fullWidth
              required
              value={product.id}
              onChange={handleInputChange}
            />
          </Grid>
          <Grid item xs={12}>
            <TextField
              name="name"
              label="Product Name"
              fullWidth
              required
              value={product.name}
              onChange={handleInputChange}
            />
          </Grid>
          <Grid item xs={6}>
            <TextField
              name="price"
              label="Price"
              type="number"
              fullWidth
              required
              value={product.price}
              onChange={handleInputChange}
            />
          </Grid>
          <Grid item xs={6}>
            <TextField
              name="previousPrice"
              label="Previous Price"
              type="number"
              fullWidth
              required
              value={product.previousPrice}
              onChange={handleInputChange}
            />
          </Grid>
          <Grid item xs={12}>
            <TextField
              name="description"
              label="Description"
              fullWidth
              multiline
              rows={4}
              required
              value={product.description}
              onChange={handleInputChange}
            />
          </Grid>
          <Grid item xs={12}>
            <TextField
              name="link"
              label="Product Link"
              fullWidth
              required
              value={product.link}
              onChange={handleInputChange}
            />
          </Grid>
          <Grid item xs={12}>
            <TextField
              name="mainImage"
              type="file"
              fullWidth
              required
              onChange={handleFileChange}
            />
            {product.mainImage && <img src={product.mainImage} alt="Main" style={{ marginTop: 16, maxHeight: 200 }} />}
          </Grid>
          {additionalImageFiles.map((_, index) => (
            <Grid item xs={12} key={index}>
              <TextField
                name={`additionalImage_${index}`}
                type="file"
                fullWidth
                onChange={handleFileChange}
              />
              {product.additionalImages[index] && <img src={product.additionalImages[index]} alt={`Additional ${index}`} style={{ marginTop: 16, maxHeight: 200 }} />}
            </Grid>
          ))}
          <Grid item xs={12}>
            <IconButton onClick={handleAddAdditionalImage} color="primary">
              <AddIcon />
            </IconButton>
          </Grid>
          <Grid item xs={12}>
            <FormControl fullWidth required>
              <InputLabel>Categories</InputLabel>
              <Select
                name="categories"
                multiple
                value={product.categories}
                onChange={handleSelectChange}
              >
                {categoriesList.map((category) => (
                  <MenuItem key={category} value={category}>
                    {category}
                  </MenuItem>
                ))}
              </Select>
            </FormControl>
          </Grid>
          <Grid item xs={12}>
            <FormControl fullWidth required>
              <InputLabel>Subcategory</InputLabel>
              <Select
                name="subcategory"
                value={product.subcategory}
                onChange={handleSelectChange}
              >
                {subcategoriesList.map((subcategory) => (
                  <MenuItem key={subcategory} value={subcategory}>
                    {subcategory}
                  </MenuItem>
                ))}
              </Select>
            </FormControl>
          </Grid>
          <Grid item xs={12}>
            <FormControl fullWidth required>
              <InputLabel>Colors</InputLabel>
              <Select
                name="colors"
                multiple
                value={product.colors}
                onChange={handleSelectChange}
              >
                {colorsList.map((color) => (
                  <MenuItem key={color} value={color}>
                    {color}
                  </MenuItem>
                ))}
              </Select>
            </FormControl>
          </Grid>
          <Grid item xs={12}>
            <FormControl fullWidth required>
              <InputLabel>Sizes</InputLabel>
              <Select
                name="sizes"
                multiple
                value={product.sizes}
                onChange={handleSelectChange}
              >
                {sizesList.map((size) => (
                  <MenuItem key={size} value={size}>
                    {size}
                  </MenuItem>
                ))}
              </Select>
            </FormControl>
          </Grid>
          <Grid item xs={12}>
            <FormControl fullWidth required>
              <InputLabel>Gender</InputLabel>
              <Select
                name="gender"
                multiple
                value={product.gender}
                onChange={handleSelectChange}
              >
                {genderList.map((gender) => (
                  <MenuItem key={gender} value={gender}>
                    {gender}
                  </MenuItem>
                ))}
              </Select>
            </FormControl>
          </Grid>
          <Grid item xs={12}>
            <Button type="submit" variant="contained" color="primary" fullWidth>
              Add Product
            </Button>
          </Grid>
        </Grid>
      </form>
    </Container>
  );
};

export default AddProduct;
