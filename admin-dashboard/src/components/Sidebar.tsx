import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { List, ListItem, ListItemButton, ListItemIcon, ListItemText, Collapse } from '@mui/material';
import ExpandLess from '@mui/icons-material/ExpandLess';
import ExpandMore from '@mui/icons-material/ExpandMore';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import CategoryIcon from '@mui/icons-material/Category';
import ProductIcon from '@mui/icons-material/Store';
const Sidebar: React.FC = () => {
  const [openProducts, setOpenProducts] = useState(false);
  const [openCategories, setOpenCategories] = useState(false);

  const handleProductsClick = () => {
    setOpenProducts(!openProducts);
  };

  const handleCategoriesClick = () => {
    setOpenCategories(!openCategories);
  };

  return (
    <div>
      <List>
        <ListItemButton onClick={handleCategoriesClick}>
          <ListItemIcon>
            <CategoryIcon />
     
   
          </ListItemIcon>
          <ListItemText primary="Categories" />
          {openCategories ? <ExpandLess /> : <ExpandMore />}

        </ListItemButton>
        <Collapse in={openCategories} timeout="auto" unmountOnExit>
          <List component="div" disablePadding>
            <ListItem component={Link} to="/categories" sx={{ pl: 9 }}>
              <ListItemText primary="Category List" />
            </ListItem>
            <ListItem component={Link} to="/add-category" sx={{ pl: 9 }}>
              <ListItemText primary="Add Category" />
            </ListItem>
          </List>
        </Collapse>
        <ListItemButton onClick={handleProductsClick}>
          <ListItemIcon>
            <ProductIcon />
          </ListItemIcon>
          <ListItemText primary="Products" />
          {openProducts ? <ExpandLess /> : <ExpandMore />}
        </ListItemButton>
        <Collapse in={openProducts} timeout="auto" unmountOnExit>
          <List component="div" disablePadding>
            <ListItem component={Link} to="/products" sx={{ pl: 9 }}>
              <ListItemText primary="Product List" />
            </ListItem>
            <ListItem component={Link} to="/add-product" sx={{ pl: 9 }}>
              <ListItemText primary="Add Product" />
            </ListItem>
          </List>
        </Collapse>
        <ListItemButton>
          <ListItemIcon>
            <ShoppingCartIcon />
          </ListItemIcon>
          <ListItemText primary="Orders" />
        </ListItemButton>
      </List>
    </div>
  );
};

export default Sidebar;
