import React from 'react'
import ProductCard from './ProductCard';
import '../../styles/general-product-list.css';


const GeneralProductList = ({data}) => {

  return (

      <div className='general__card '>
          {data&&data.map((item, index) => (
            <div className='general__box'> <ProductCard item={item} key={index} /></div>
          ))}
      </div>

    // <div className='general_product_list'>
    //   {data?.map((item, index) => (
    //         <div  className="cardwidth">
    //           <ProductCard item={item} key={index} />
    //         </div>
    //     ))}  
    // </div>
  )

}

export default GeneralProductList;