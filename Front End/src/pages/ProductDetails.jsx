import React, { useState, useRef, useEffect } from "react";
import Helmet from "../components/Helmet/Helmet";
import CommonSection from "../components/UI/CommonSection";
import { Col, Container, Row } from "reactstrap";
import { useParams,useNavigate} from "react-router-dom";
import products from "../assets/data/products";
import "../styles/product-details.css";
import { motion } from "framer-motion";
import ProductList from "../components/UI/ProductsList";
import { useDispatch, useSelector } from "react-redux";
import { cartActions } from "../redux/slices/cartSlice";
import { toast } from "react-toastify";
import axiosClient from "../axios-client";

import pimg from "../assets/images/arm-chair-02.jpg"
import Carousel from 'react-multi-carousel';
import { getCurrencydata } from "../redux/slices/settingSlice";

import { AiFillMinusCircle, AiFillPlusCircle,AiOutlineShoppingCart,AiOutlineShopping,AiFillFacebook,AiFillTwitterSquare,AiOutlineWhatsApp} from "react-icons/ai";

import ProductDetailsCart from "../components/UI/ProductDetailsCart";


const ProductDetails = () => {
  const [tab, setTab] = useState("desc");
  const reviewUser = useRef("");
  const reviewMsg = useRef("");
  const dispatch = useDispatch("");
  const [rating, setRating] = useState(null);
  const { id } = useParams();
  const [productId,setProductId]=useState(id)
  // setProductId(id)
  let [productDetals, setProductDetails] = useState([]);
  let [productDiscount, setProductDiscount] = useState(0);
  let [relatedProducts, setRelatedProducts] = useState([]);
  let [productImg, setProductImages] = useState([]);
  let [productmainImg, setProductMainImages] = useState('');
  let [showImg, setshowImg] = useState('');
  let [color, setColor] = useState(false);
  let [size, setSize] = useState(false);

  let [choose_color, setchoose_color] = useState('');
  let [choose_size, setchoose_size] = useState('');
  const currencySymbol = useSelector(state => state.setting.currency);
  const navigate=useNavigate();

  const submitHandler = (e) => {
    e.preventDefault();
    const reviewUserName = reviewUser.current.value;
    const reviewUserMsg = reviewMsg.current.value;
    const reviwObj = {
      userName: reviewUserName,
      text: reviewUserMsg,
      rating,
    };
    console.log(reviwObj);
    toast.success("Send Your Reviews");
  };
 
  useEffect(() => {
    setProductId(id)
    changedata(id)
    window.scrollTo(0, 0);
    setColor(false)
    setSize(false)
    dispatch(getCurrencydata());
  },[id]);


  function changedata(id){
    setProductId(id)
  }

  useEffect(() => {
    dispatch(getCurrencydata());
    axiosClient
      .get(`home/subcategory/product?subCategory_id=1`)
      .then(({ data }) => {
        setRelatedProducts(data.data)
      });
  }, []);


  return (
    <Helmet title={productDetals.name}>

      <ProductDetailsCart id={id}/>

      <section className=" mb-4 pt-3">
        <Container>
          <div className="bg-white shadow-sm p-3">
            <Row>
              <Col lg="12" md="12">
                <div className="tab__wrapper d-flex align-items-center gap-5">
                  <h6
                    className={`${tab === "desc" ? "active__tab" : ""}`}
                    onClick={() => setTab("desc")}
                  >
                    Description
                  </h6>
                  <h6
                    className={`${tab === "rev" ? "active__tab" : ""}`}
                    onClick={() => setTab("rev")}
                  >
                    Reviews (3)
                  </h6>
                </div>
                {tab === "desc" ? (
                  <div className="tab__content mt-5">
                    <p>{productDetals.description}</p>
                  </div>
                ) : (
                  <div className="product_reviw mt-5">
                    <div className="review__wrapper">
                      <ul>

                        <li key={1} className="mb-4">
                          <h6>Syed Mahadi Hasan Opu </h6>
                          <span>5 (rating) </span>
                          <p> ert edrtert</p>
                        </li>

                      </ul>
                      <div className="reviw__form">
                        <h4> Leave Your Exprience </h4>
                        <form action="" onSubmit={submitHandler}>
                          <div className="from__group">
                            <input
                              type="text"
                              placeholder="Enter name"
                              ref={reviewUser}
                              required
                            />
                          </div>

                          <div className="from__group rating__group d-flex align-align-items-center gap-5">
                            <motion.span
                              whileTap={{ scale: 1.2 }}
                              onClick={() => setRating(1)}
                            >
                              1 <i class="ri-star-s-fill"></i>
                            </motion.span>
                            <motion.span
                              whileTap={{ scale: 1.2 }}
                              onClick={() => setRating(2)}
                            >
                              2 <i class="ri-star-s-fill"></i>
                            </motion.span>
                            <motion.span
                              whileTap={{ scale: 1.2 }}
                              onClick={() => setRating(3)}
                            >
                              3<i class="ri-star-s-fill"></i>
                            </motion.span>
                            <motion.span
                              whileTap={{ scale: 1.2 }}
                              onClick={() => setRating(4)}
                            >
                              4 <i class="ri-star-s-fill"></i>
                            </motion.span>
                            <motion.span
                              whileTap={{ scale: 1.2 }}
                              onClick={() => setRating(5)}
                            >
                              5 <i class="ri-star-s-fill"></i>
                            </motion.span>
                          </div>

                          <div className="from__group">
                            <textarea
                              ref={reviewMsg}
                              rows={4}
                              type="text"
                              placeholder="Reviw Massage......"
                              required
                            />
                          </div>
                          <motion.button
                            whileTap={{ scale: 1.2 }}
                            className="buy__btn"
                          >
                            Submit
                          </motion.button>
                        </form>
                      </div>
                    </div>
                  </div>
                )}
              </Col>
            </Row>
          </div>
        </Container>
      </section>

      <section className=" mb-4 pt-3">
        <Container>
          <div className="bg-white shadow-sm p-3">
            <Row>
              <Col lg="12" className="mt-5">
                <h2 className="related__title"> You might also like </h2>
              </Col>
              <ProductList data={relatedProducts} />
            </Row>
          </div>
        </Container>
      </section>

    </Helmet>
  );
};

export default ProductDetails;
