import React from 'react'
import ProductCard from './ProductCard';
import Carousel from 'react-multi-carousel';
import 'react-multi-carousel/lib/styles.css';

const ProductsList = ({data}) => {

  const responsive = {
    superLargeDesktop: {
      // the naming can be any, depends on you.
      breakpoint: { max: 4000, min: 3000 },
      items: 6
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 6
    },
    tablet: {
      breakpoint: { max: 1024, min: 464 },
      items: 3
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 2
    }
  };


  return (
    <>

    <Carousel 
      responsive={responsive}
      autoPlay={false}
      infinite={true}
      transitionDuration={300}
      autoPlaySpeed={3000}
      renderDotsOutside={true}
    >  
      {
        data&&data.map((item, index) => (
          <ProductCard item={item} key={index} />
        ))
        // .slice(0,4)
      }
    </Carousel>
    </>
  )
}

export default ProductsList;