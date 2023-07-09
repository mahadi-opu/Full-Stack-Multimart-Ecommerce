import React, { useState } from "react";
import "../../styles/bottom_navigate.css";
import { Link, useNavigate } from "react-router-dom";

import { AiOutlineHome,AiOutlineShoppingCart } from "react-icons/ai";
import { BsSuitHeart,BsPersonCircle } from "react-icons/bs";

const MobileBottomNavbar=()=>{
    const [value, setValue] =useState('recents');

    const navigate=useNavigate();

    const navigateToCart = () => {

        navigate("/checkout");
      };

    const handleChange = (event, newValue) => {
      setValue(newValue);
    };

   
    return (
      <div class="navbar">
      <Link to={"/"}>Home</Link>
      <Link  to={"/product/wishlist"}><BsSuitHeart/> Wish List</Link>
      <a href="javascript:void(0)" onClick={navigateToCart}><AiOutlineShoppingCart/> Cart</a>
      <Link to={"/user/deshboard/1"}><BsPersonCircle/> Account</Link>

      {/* <a href="#contact"><BsPersonCircle/> Account</a> */}
    </div>
      );

}

export default MobileBottomNavbar;