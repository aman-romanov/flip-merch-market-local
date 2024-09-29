import React from 'react';
import Slider from 'react-slick';
import "slick-carousel/slick/slick.css"; 
import "slick-carousel/slick/slick-theme.css";

interface ImageSliderProps {
  images: { label: string; imgPath: string }[];
}

const PrevArrow: React.FC<any> = ({ onClick }) => (
  <button onClick={onClick} style={{ ...arrowStyle, left: '10px' }}>
    {'<'}
  </button>
);

const NextArrow: React.FC<any> = ({ onClick }) => (
  <button onClick={onClick} style={{ ...arrowStyle, right: '10px' }}>
    {'>'}
  </button>
);

const arrowStyle = {
  position: 'absolute' as 'absolute',
  top: '50%',
  transform: 'translateY(-50%)',
  backgroundColor:'transparent', 
   border: 'none',
  borderRadius: '50%',
  width: '30px',
  height: '30px',
  display: 'flex',
  alignItems: 'center',
  justifyContent: 'center',
  cursor: 'pointer',
  zIndex: 1,
};

const ImageSlider: React.FC<ImageSliderProps> = ({ images }) => {
  const settings = {
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    customPaging: (i: number) => (
      <div style={{ padding: '0px 5px'}}> 
        <img
          src={images[i].imgPath}
          alt={images[i].label}
          style={{ width: '60px', height: '60px', objectFit: 'cover'}} />
      </div>
    ),
    appendDots: (dots: React.ReactNode) => (
      <div style={{ padding: '0px 1px', display: 'flex', justifyContent: 'center' }}>
        <ul style={{ display: 'flex', margin: '0', padding: '0', gap: '39px'}}> {/* Фон списка индикаторов */}
          {dots}
        </ul>
      </div>
    ),
    prevArrow: <PrevArrow />,
    nextArrow: <NextArrow />,
  };

  return (
    <div > {/* Фон всего компонента */}
      <Slider {...settings}>
        {images.map((image, index) => (
          <div key={index}>
            <img src={image.imgPath} alt={image.label} style={{ width: '100%', height: 'auto' }} />
          </div>
        ))}
      </Slider>
    </div>
  );
};

export default ImageSlider;
