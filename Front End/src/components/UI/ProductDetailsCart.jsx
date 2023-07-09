import React from 'react'

import { Col, Container, Row } from "reactstrap";
import { useParams, useNavigate } from "react-router-dom";
import "../../styles/product-details.css"
import { motion } from "framer-motion";
import { useDispatch, useSelector } from "react-redux";
import { cartActions } from '../../redux/slices/cartSlice';
import { toast } from "react-toastify";
import axiosClient from "../../axios-client";

import pimg from "../../assets/images/arm-chair-02.jpg"
import Carousel from 'react-multi-carousel';
import { getCurrencydata } from "../../redux/slices/settingSlice";

import { AiFillMinusCircle, AiFillPlusCircle, AiOutlineShoppingCart, AiOutlineShopping, AiFillFacebook, AiFillTwitterSquare, AiOutlineWhatsApp } from "react-icons/ai";
import { useState, useEffect } from 'react';


const ProductDetailsCart = (props) => {

    const dispatch = useDispatch("");
    const [id, setid] = useState(props.id);
    const url =window.location.href;
    const [offerId, setofferId] = useState(0);
    let [productDetals, setProductDetails] = useState([]);
    let [productDiscount, setProductDiscount] = useState(0);
    // let [relatedProducts, setRelatedProducts] = useState([]);
    let [productImg, setProductImages] = useState([]);
    let [productmainImg, setProductMainImages] = useState('');
    let [showImg, setshowImg] = useState('');
    let [color, setColor] = useState(false);
    let [size, setSize] = useState(false);

    let [choose_color, setchoose_color] = useState('');
    let [choose_size, setchoose_size] = useState('');
    const currencySymbol = useSelector(state => state.setting.currency);
    const basepath=useSelector((state) => state.setting.basepath);
    const navigate = useNavigate();


    const responsive = {
        superLargeDesktop: {
            // the naming can be any, depends on you.
            breakpoint: { max: 4000, min: 3000 },
            items: 10
        },
        desktop: {
            breakpoint: { max: 3000, min: 1024 },
            items: 4
        },
        tablet: {
            breakpoint: { max: 1024, min: 464 },
            items: 2
        },
        mobile: {
            breakpoint: { max: 464, min: 0 },
            items: 2
        }
    };

    const [qty, setQty] = useState(1);
   

    useEffect(() => {
        setColor(false)
        setSize(false)
        dispatch(getCurrencydata());
        axiosClient
            .get(`product/details?id=${props.id}`)
            .then(({ data }) => {
                console.log(data);
                data.color && setColor(data.color.split(","))
                data.size && setSize(data.size.split(","))
                setProductDetails(data);
                setProductMainImages(data.image_path);
                setshowImg(data.image_path)
                setProductImages(data.product_image);
                setProductDiscount(data.discount)
            });
    }, [url]);



    const qtyChange = (typ2) => {
        if (typ2 === "plus") {
            setQty(pre => pre + 1)
        }
        if (typ2 === "neg") {
            setQty(pre => pre <= 1 ? 1 : pre - 1)
        }
    };
    let totalDiscount = 0;
    var discountPrc = 0;

    var discountPercentageCal = 0;
    if (offerId > 0) {
        if (productDetals.offer_type == 0) {
            totalDiscount = Math.round(productDetals.offer_amount);
            discountPrc = Math.round(totalDiscount);
        }
        if (productDetals.offer_type == 1) {
            let totaldis = (productDetals.current_sale_price * productDetals.offer_amount) / 100;
            totalDiscount = Math.round(totaldis);
            discountPrc = Math.round(productDetals.offer_amount);
        }
    }
    else {
        if (productDetals.discount > 0) {
            if (productDetals.discount_type == 0) {
                totalDiscount = Math.round(productDetals.discount);
                discountPrc = Math.round(totalDiscount);
            }
            if (productDetals.discount_type == 1) {
                let totaldis = (productDetals.current_sale_price * productDetals.discount) / 100;
                totalDiscount = Math.round(totaldis);
                discountPrc = Math.round(totalDiscount);
            }
        }
    }
    const addToCart = (item, type) => {
        dispatch(
            cartActions.addItem({
                id: item.id,
                productName: item.name,
                price: item.current_sale_price - discountPrc,
                imgUrl: item.image_path,
                offerId: offerId,
                color: color,
                size: size,
            })
        );
        let data = { id: item.id, qty: qty };
        dispatch(cartActions.itemIncDic(data));

        type == 'buy' && navigate("/checkout");
        type != 'buy' && toast.success("product added successfully");
    };


    return <section className="mb-4 pt-4">
        <Container>
            <div className="bg-white shadow-sm p-4">
                <Row>
                    <Col lg="5" col md='12'>
                        <div className="mb-4 mb-lg-0 imgdiv">
                            <img className="product__img" src={`${basepath}/${showImg}`} alt="" />
                        </div>

                        <div>
                            <Carousel
                                responsive={responsive}
                                autoPlay={false}
                                infinite={true}
                                transitionDuration={300}
                                autoPlaySpeed={3000}
                                renderDotsOutside={true}
                            >
                                <div className="product_item_imgdiv"><img onClick={() => setshowImg(productmainImg)} className="productitem" src={`${basepath}/${productmainImg}`} alt="" /></div>
                                {
                                    productImg.map((imgData) => {
                                        return <div className="product_item_imgdiv"><img onClick={() => setshowImg(imgData.image)} className="productitem" src={`${basepath}/${imgData.image
                                            }`} alt="" /></div>
                                    })
                                }

                            </Carousel>
                        </div>
                    </Col>
                    <Col lg="7" md="12">
                        <div className="product__details">
                            <h1 className="mb-2 fs-20 fw-600"> {productDetals.name} </h1>
                            <div className="product__rating d-flex align-items-center gap-5 mb-3">
                                <div>
                                    <span>
                                        <i className="ri-star-s-fill"></i>
                                    </span>
                                    <span>
                                        <i className="ri-star-s-fill"></i>
                                    </span>
                                    <span>
                                        <i className="ri-star-s-fill"></i>
                                    </span>
                                    <span>
                                        <i className="ri-star-s-fill"></i>
                                    </span>
                                    <span>
                                        <i className="ri-star-s-fill"></i>
                                    </span>
                                </div>
                                <p>
                                    (<span>4.5</span> ratings)
                                </p>
                            </div>
                            <div className="d-flex align-items-center gap-5">
                                <span className="product__price">
                                    {currencySymbol} {productDetals.current_sale_price - productDiscount}
                                </span>
                                {productDiscount > 0 && <del>{currencySymbol} {Math.round(productDetals.current_sale_price)}</del>}
                            </div>


                            {color && <div className="sizecolor_div"><div className="nametxt"><p>Color:</p> </div>
                                {
                                    color.map(colordata => <span className={`color_item ${colordata == choose_color && 'activecolorst'}`} onClick={() => setchoose_color(colordata)} style={{ 'background': colordata }} ></span>)
                                }
                            </div>}
                            {
                                size && <div className="sizecolor_div"><div className="nametxt"><p>Size:</p>
                                </div>
                                    <div className="sizediv">

                                        {size.map(sizedata => <span className={`sizedata ${sizedata == choose_size && 'activecolorst'}`} onClick={() => setchoose_size(sizedata)}>{sizedata}</span>)}
                                    </div>
                                </div>

                            }


                            <div className="sizecolor_div"><div className="nametxt"><p>Quantity :</p></div>


                                <div className="input__button__div">
                                    <AiFillMinusCircle className="itemBtn__st" onClick={() => qtyChange('neg')} />
                                    <div><input readOnly type="number" value={qty} /></div>
                                    <AiFillPlusCircle className="itemBtn__st" onClick={() => qtyChange('plus')} />
                                </div>
                            </div>

                            <div className="sizecolor_div"><div className="nametxt"><p>Total Price :  </p></div> <div><span className="payabletxt">{currencySymbol} {(productDetals.current_sale_price - productDiscount) * qty}</span></div> </div>
                            <div className="sizecolor_div">
                                <motion.button
                                    whileTap={{ scale: 1.2 }}
                                    className="buy__btn btninner"
                                    onClick={() => addToCart(productDetals, 'cartadd')}
                                >

                                    < AiOutlineShopping />
                                    Add to Cart
                                </motion.button>

                                <motion.button
                                    whileTap={{ scale: 1.2 }}
                                    className="buy__btn buyNow btninner"
                                    onClick={() => addToCart(productDetals, 'buy')}
                                >
                                    <AiOutlineShoppingCart /> Buy Now
                                </motion.button>

                            </div>

                            {/* <div className="sizecolor_div"><div className="nametxt"><p>Share:</p> </div>
               <AiFillFacebook/> 
               <AiFillTwitterSquare/>
               <AiOutlineWhatsApp/>
               </div> */}
                        </div>

                    </Col>
                </Row>
            </div>

        </Container>
    </section>
}

export default ProductDetailsCart;
