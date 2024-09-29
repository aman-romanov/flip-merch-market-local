import React, { useState } from 'react';
import { Button, Box, Typography } from '@mui/material';
import { Add, Remove } from '@mui/icons-material';

const NumberLabel: React.FC = () => {
  const [number, setNumber] = useState(1);

  const increase = () => setNumber(prev => prev + 1);
  const decrease = () => setNumber(prev => (prev > 1 ? prev - 1 : 1));

  return (
    <Box 
      sx={{
        display: 'flex',
        flexDirection: 'row',
        alignItems:"center",
        justifyContent:"space-between",
        border: '1px solid rgb(238, 240, 247)',
        borderRadius: '4px',
        width:'300px',
        height:'36px',
        maxWidth: '324px',
        maxHeight: '36px',
        padding: '2px 8px',
        
      }}
    >
              <Box 
      sx={{
        display: 'flex',
        flexDirection: 'column',
      }}
    >
      <Typography 
        sx={{
          fontSize: '10px',
          fontWeight: 400,
          color: 'rgb(213, 213, 213)',
        paddingTop:'2px',
        }}
      >
        Кол-во
      </Typography>
        <Typography 
          sx={{
            fontSize: '18px',
            fontWeight: 500,
            color: 'rgb(30, 32, 34)',
            paddingBottom:'2px',
          }}
        >
          {number}
        </Typography>
        </Box>
        <Box 
          sx={{
            display: 'flex',
            gap: '8px',
          }}
        >
          <Button 
            onClick={decrease} 
            sx={{
              minWidth: '5.5px',
              minHeight: '5.5px',
              borderRadius: '50%',
              padding: '0',
              backgroundColor: 'rgb(238, 240, 247)',
              '&:hover': {
                backgroundColor: 'rgba(55, 125, 255, 0.1)',
              },
            }}
          >
            <Remove />
          </Button>
          <Button 
            onClick={increase} 
            sx={{
              minWidth: '5.5px',
              minHeight: '5.5px',
              borderRadius: '50%',
              padding: '0px',
              backgroundColor: 'rgb(238, 240, 247)',
              '&:hover': {
                backgroundColor: 'rgba(55, 125, 255, 0.1)',
              },
            }}
          >
            <Add />
          </Button>
        </Box>
      </Box>

  );
};

export default NumberLabel;
