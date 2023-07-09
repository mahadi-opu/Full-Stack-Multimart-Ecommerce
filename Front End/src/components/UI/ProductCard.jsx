import React from "react";
import { motion } from "framer-motion";
import "../../styles/product-card.css";
import { Col } from "reactstrap";
import { Link, useNavigate } from "react-router-dom";
import { toast } from "react-toastify";
import ReactStars from "react-rating-stars-component";
import { useDispatch, useSelector } from "react-redux";
import { cartActions } from "../../redux/slices/cartSlice";
import { Modal,Typography,Button,Box } from "@mui/material";

import prodcompareimg from "../../assets/images/header-img/prodcompare.svg";
import viewimg from "../../assets/images/header-img/view.svg";
import addcardimg from "../../assets/images/header-img/add-cart.svg";
import wishImage from "../../assets/images/header-img/wish.svg";
import { getCurrencydata, getWishcount } from "../../redux/slices/settingSlice";
import { useEffect } from "react";
import axiosClient from "../../axios-client";
import { Toast } from "bootstrap";
import ProductDetailsCart from "./ProductDetailsCart";
import { useState } from "react";

const ProductCard = ({ item, dgf, offerId }) => {
  // alert(offerId)
  const currency = useSelector((state) => state.setting.currency);
  const islogin = useSelector((state) => state.user.isLogin);
  const basepath=useSelector(state => state.setting.basepath);
  const navigate = useNavigate();
  const product_name= item.name&&item.name.length>40?item.name.slice(0,40)+'...':item.name;

  useEffect(()=>{
    // product_name=item.name.slice(3);
  },[])

  let totalDiscount = 0;
  var discountPrc = 0;
  var discountPercentageCal=0;
  if (offerId > 0) {
    if (item.offer_type == 0) {
      totalDiscount = Math.round(item.offer_amount);
      discountPrc = Math.round(totalDiscount);
    }
    if (item.offer_type == 1) {
      let totaldis = (item.current_sale_price * item.offer_amount) / 100;
      totalDiscount = Math.round(totaldis);
      discountPrc = Math.round(item.offer_amount);
    }
  }
  else {
    if (item.discount > 0) {
      if (item.discount_type == 0) {
        totalDiscount = Math.round(item.discount);
        discountPrc = Math.round(totalDiscount);
      }
      if (item.discount_type == 1) {
        let totaldis = (item.current_sale_price * item.discount) / 100;
        totalDiscount = Math.round(totaldis);
        discountPrc = Math.round(totalDiscount);
      }
    }
  }

  discountPercentageCal=Math.round((discountPrc*100)/item.current_sale_price) 

  const dispatch = useDispatch();

  const addToCart = (item) => {
    dispatch(
      cartActions.addItem({
        id: item.id,
        productName: item.name,
        price: item.current_sale_price - discountPrc,
        imgUrl: item.image_path,
        offerId: offerId,
      })
    );
    toast.success("product added successfully");
  };

  const addtoWishlist = (productId) => {
    if (islogin) {
      const data = {
        'product_id': productId
      }
      axiosClient
        .post('user/wish/list/add', data)
        .then(({ data }) => {
          dispatch(getWishcount());
          toast.success(data.msg);
        });
    } else {
      toast.error('Login First')
      navigate("/login")
    }
  }

  const style = {
    position: 'absolute',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    width: 900,
    bgcolor: 'background.paper',
    border: '2px solid #000',
    boxShadow: 24,
    p: 4,
  };

  const [open, setOpen] = React.useState(false);
  const handleOpen = () => setOpen(true);
  const handleClose = () => setOpen(false);

  const [showid,setShowid]=useState();
  

  const showPrductDetails=(id)=>{
    setShowid(id);
    handleOpen();

  }


  return (
    <div className="product-card card position-relative my-3">
      {
        discountPercentageCal>0 && <span className="badge-custom">OFF<span className="box">{discountPercentageCal}%</span> </span>
      }
      <div className="product-image">
        <Link to={`/shop/${item.id}`}>
          <motion.img
            // whileHover={{ scale: 0.9 }}
            img
            src={`${basepath}/${item.image_path}`}
            className="img-fluid"
            alt="product image"
          />
          <motion.img
            // whileHover={{ scale: 0.9 }}
            img
            src={`${basepath}/${item.image_path}`}
            className="img-fluid"
            alt="product image"
          />
        </Link>
      </div>
      <div className="product-details pt-4">
        {/* <div className="d-flex justify-content-between mb-2">
          <Link to={`/shop/${item.id}`}>
            <h6 className="brand">  {product_name}</h6>
          </Link>
          <p className="product-category"> {item.category} </p>
        </div> */}
        <h3 className="product-title mb-1">
          <Link to={`/shop/${item.id}`}> {product_name}</Link>{" "}
        </h3>
        {/* <ReactStars
            count={5}
            size={24}
            value="3"
            activeColor="#ffd700"
            edit={false}
          /> */}
      </div>
      <div className="product-cart d-flex align-items-center justify-content-between p-2">
        <span className="product-price">
          {currency}{item.current_sale_price - discountPrc}
        </span>
        {
          discountPrc>0&&
          <del className="product-price-del">
            {currency}{ Math.round(item.current_sale_price) }
          </del>
        }


        {/* <motion.span whileTap={{ scale: 1.2 }} onClick={() => addToCart(item)} className="action-cardlist-btn">
          <i class="ri-add-line"></i>
        </motion.span> */}

        <span whileTap={{ scale: 1.2 }} onClick={() => addToCart(item)} className="action-cardlist-btn">
          Add To Cart <i class="ri-add-line"></i>
        </span>


      </div>
      <div className="action-bar position-absolute">
        <div className=" d-flex flex-column gap-15">
          <Link to="" className="iitemActioncard">
            <img src={wishImage} alt="wishlist" onClick={() => addtoWishlist(item.id)} />
          </Link>
          {/* <Link to="" className="iitemActioncard">
            <img src={prodcompareimg} alt="addcart" />
          </Link> */}
          <Link className="iitemActioncard" to={`/shop/${item.id}`}>
            <img src={viewimg} alt="addcart" />
          </Link>
          {/* <Link to="" className="iitemActioncard" onClick={() => addToCart(item)}> */}
          <Link to="" className="iitemActioncard" onClick={() => showPrductDetails(item.id)}>
            <img src={addcardimg} alt="addcart" />
          </Link>
        </div>
      </div>

{/* product details */}
      <Modal
        open={open}
        onClose={handleClose}
        aria-labelledby="modal-modal-title"
        aria-describedby="modal-modal-description"
      >
        <Box sx={style}>
          {
            showid && <ProductDetailsCart id={showid}/>
          }
        
        </Box>
      </Modal>
    </div>
  );
};

export default ProductCard;
