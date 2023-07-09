import React from "react";
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import './slider.css';
import { useEffect } from "react";
import axiosClient from "../../../axios-client";
import { useState } from "react";
import { Link } from "react-router-dom";
import {useSelector } from "react-redux";


const HeroSlider = (props) => {
  
  
  const settings = {
    dots: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    appendDots: (dots) => {
      return <ul style={{ margin: "0px" }}>{dots}</ul>
    },
  }
  const basepath=useSelector((state) => state.setting.basepath);



  
  return (
    <section className="hero__slider">
      <Slider {...settings}>
        {props.offerBanner&&props.offerBanner.map((value, index) => {
          let backgroundImage=`${basepath}/${value.banner_image}`
          return (
              <div className='box d-flex justify-content-between' key={index}>
                <img src={backgroundImage} alt='Images' />

                <div className='hero_slider_content'>
                  <h1>{value.offer_name}</h1>
                  <p>{value.note}</p>
         
                  
                </div>
                
                <Link className="offerbtn" to={`/product/list/none/none/bestSell/${value.id}`}><button className='buy__btn'>Visit Collections</button></Link>
                {/* <div className='hero_slider_img'>
                  <img src={backgroundImage} alt='Images' />
                </div> */}
              </div>
            )
        })}
      </Slider>
    </section>
  )
}

export default HeroSlider
