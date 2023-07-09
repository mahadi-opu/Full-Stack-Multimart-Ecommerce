import React, { useEffect, useState } from 'react';
import './subcategory.css';
import { IconName } from "react-icons/ai";

import cateImg01 from "../../assets/images/category/cat1.png";
import cateImg02 from "../../assets/images/category/cat2.png";
import cateImg03 from "../../assets/images/category/cat3.png";
import cateImg04 from "../../assets/images/category/cat4.png";
import cateImg05 from "../../assets/images/category/cat5.png";
import cateImg06 from "../../assets/images/category/cat6.png";
import cateImg07 from "../../assets/images/category/cat7.png";
import cateImg08 from "../../assets/images/category/cat8.png";
import cateImg09 from "../../assets/images/category/cat9.png";
import cateImg010 from "../../assets/images/category/cat10.png";
import cateImg011 from "../../assets/images/category/cat11.png";
import axiosClient from '../../axios-client';


const data = [
    {
      cateImg: cateImg01,
      cateName: "Fashion Bord",
    },
    {
      cateImg: cateImg02,
      cateName: "Electronic",
    },
    {
      cateImg: cateImg03,
      cateName: "Cars",
    },
    {
      cateImg: cateImg04,
      cateName: "Home & Garden",
    },
    {
      cateImg: cateImg05,
      cateName: "Gifts",
    },
    {
      cateImg: cateImg06,
      cateName: "Music",
    },
    {
      cateImg: cateImg07,
      cateName: "Health & Beauty",
    },
    {
      cateImg: cateImg08,
      cateName: "Pets",
    },
    {
      cateImg: cateImg09,
      cateName: "Baby Toys",
    },
    {
      cateImg: cateImg010,
      cateName: "Groceries",
    },
    {
      cateImg: cateImg011,
      cateName: "Books",
    }

  ]

const Subcategorys = (props) => {
  let [categoryList,setCategoryList]=useState([]);

  let subcategoryChange=(id)=>{
    props.changeSubcategory(id);
  }

  

  let [subCategoryList,setSubCategoryList]=useState([]);

  useEffect(()=>{

    if(props.type=='none'){
      axiosClient
      .get(`category/wise/subcategory?category_id=${props.categoryId}`)
      .then(({ data }) => {
        setSubCategoryList(data);
      });
    }
    if(props.type!='none'){
      axiosClient
      .get(`all/subcategory`)
      .then(({ data }) => {
        setSubCategoryList(data);
      });

    }
   

  },[])



  let [showSubcategory,setSubcategory]=useState(false);

  return (
    <>
      <div className='categories__card category_card_position'>
        {subCategoryList.map((value, index) => {
              const itemStyle = {
                background: value.id == props.subcategoryId ? '#c22026' : '',
                color: value.id == props.subcategoryId ? 'white' : 'black',
                margin:"2px"
              
              };
          return (
          <div className='box d-flex' key={index} onClick={()=>{subcategoryChange(value.id)}}   style={itemStyle} >

              <div className='categoryitemstyle'>
              {/* <img src={`http://127.0.0.1:8000/${value.image}`} alt='' /> */}
              <span>{value.name}</span>
              </div>
              <div>
              <svg style={{marginTop:'14px',color:'white'}} stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path></svg>
              </div>
              
            </div>
          )
        })}
      </div>
    </>
  )
}

export default Subcategorys;
