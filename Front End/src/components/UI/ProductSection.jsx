import React from 'react'
import ProductCard from './ProductCard';
import '../../styles/productSection.css';


const ProductSection = ({data}) => {

  return (
    <div className='general__card'>
          { data?.map((item, index) => (
            <div  className="general__box"><ProductCard item={item} key={index} /></div>
        ))}
    </div>
  )

}

export default ProductSection