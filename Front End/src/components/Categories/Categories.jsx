import React, { useEffect, useState } from 'react';
import './categories.css';
import axiosClient from '../../axios-client';
import { Link } from 'react-router-dom';
import { useSelector } from 'react-redux';


const Categories = (props) => {
  const categoryList = props.category;

  useEffect(() => {
    // axiosClient
    // .get('product/category')
    // .then(({ data }) => {
    //   setCategoryList(data);
    // });

  }, [])

  let [showSubcategory, setSubcategory] = useState(false);
  let [subcategory, setSubcatListegory] = useState([]);
  const basepath = useSelector((state) => state.setting.basepath);

  let subcategoryset = (subcategoryList) => {
    setSubcatListegory(subcategoryList);
    if (subcategoryList.length > 0) {
      setSubcategory(true)
    }

  }


  return (
    <>
      <div className='categories__card category_card_position'>
        {categoryList&&categoryList.map((value, index) => {
          return (
            <div className='box d-flex' key={index} onMouseEnter={() => subcategoryset(value.subcategory
            )} onMouseLeave={() => setSubcategory(false)}>
              <div className='categoryitemstyle'>
                <img className='categoryimg' src={`${basepath}/${value.image}`} alt='' />
                <span>{value.name}</span>
              </div>
              <div>
                <svg style={{ marginTop: '14px', color: 'black' }} stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path></svg>
              </div>
            </div>
          )
        })}


        {
          showSubcategory &&
          <div className='categories__card subcategory_list' onMouseEnter={() => setSubcategory(true)} onMouseLeave={() => setSubcategory(false)} >
            {subcategory&&subcategory.map((value, index) => {
              return (
                // <Link to={`/product/list/${value.category_id}/${value.id}/none/0`} className='liststyle' key={index}>   <div className='box d-flex' key={index} >
                //   {/* <img src={value.cateImg} ffq alt='' /> */}
                //   <span>{value.name} </span>
                // </div> </Link>
                <Link to={`/products/list/${value.category_id}/${value.id}/0/0`} className='liststyle' key={index}>   <div className='box d-flex' key={index} >
                  {/* <img src={value.cateImg} ffq alt='' /> */}
                  <span>{value.name} </span>
                </div> </Link>
              )
            })}
          </div>
        }
         <div className="all_cate_product text-center">
            <Link to="/all/category" > View All Categories </Link>
          </div>
          </div>
     
    </>
  )
}

export default Categories;
