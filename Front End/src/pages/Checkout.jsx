import React, { useEffect, useState } from "react";
import { Col, Container, Form, FormGroup, Row, Input } from "reactstrap";
import Helmet from "../components/Helmet/Helmet";
import CommonSection from "../components/UI/CommonSection";
import "../styles/checkout.css";
import { AiOutlineRight } from "react-icons/ai";
import { useSelector, useDispatch } from "react-redux";
import OrderShipping from "./Checkout/OrderShipping";
import { shippingCost, getCurrencydata } from '../redux/slices/settingSlice';
import OrderStepList from "../components/UI/OrdeStepList";
import { Link,useNavigate } from "react-router-dom";
import Cart from "./Cart";
// mui
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import Modal from "@mui/material/Modal";
import axiosClient from "../axios-client";
import OrderShippingAddress from "../components/UI/OrderShippingAddress";
import ProductsList from "../components/UI/ProductsList";

const style = {
  position: "absolute",
  top: "20%",
  left: "50%",
  transform: "translate(-50%, -50%)",
  width: 400,
  bgcolor: "background.paper",
  border: "2px solid #000",
  boxShadow: 24,
  p: 4,
};




const Checkout = () => {
  const dispatch = useDispatch();
  const totalQty = useSelector((state) => state.cart.totalQuantity);
  const subtotal = useSelector((state) => state.cart.totalAmount);
  const shippingCostget = useSelector((state) => state.setting.shippingCost);
  const shippingCostdata = subtotal > 0 ? shippingCostget : 0;
  const totalAmount = parseFloat(subtotal) + parseFloat(shippingCostdata);
  const cartItems = useSelector((state) => state.cart.cartItems);
  const currency = useSelector((state) => state.setting.currency);
  const [shippingInfo, setShippingInfo] = useState([]);
  const basepath=useSelector((state) => state.setting.basepath);
  let [relatedProducts, setRelatedProducts] = useState([]);






  const [activeItem, setActiveItem] = useState(0);
  const navigate=useNavigate();
  const shippingAddress = (address) => {
    setShippingInfo(address)
    setActiveItem(2);
  }

  useEffect(() => {
         window.scrollTo(0, 0);
        dispatch(getCurrencydata())
  }, [])

  useEffect(() => {
    dispatch(getCurrencydata());
    // axiosClient
    //   .get(`home/subcategory/product?subCategory_id=1`)
    //   .then(({ data }) => {
    //     setRelatedProducts(data.data)
    //   });

      var pid=[];
      cartItems.map(data=>{
           pid=[...pid,data.id];
      });

      axiosClient
      .get(`home/subcategory/product/related?productlist=${[pid]}`)
      .then(({ data }) => {
        setRelatedProducts(data)
       console.log('data6',data)
      });

  }, []);


  const orderStepAction=(data)=>{
    setActiveItem(data)
  }

  useEffect(()=>{

  },[activeItem])


  // modal

  return (
    <Helmet title="Checkout">
      <section className="mb-4 pt-2">
      <OrderStepList action={orderStepAction} activitem={activeItem} />
        <Container>
          <div className="bg-white shadow-sm p-4 checkout_mainCard">
            <Row>
              <Col lg="8" md="12" className="cutomerinfost checkoutcard-div-style">
                {
                 activeItem == 0 && <Cart action={orderStepAction}/> || activeItem == 1 && <OrderShippingAddress address={shippingAddress} /> || activeItem == 2 && <OrderShipping shippingInfo={shippingInfo} />
                }




              </Col>

              <Col lg="4" md="12" className="margincart">
                <div className="checkout__cart">
                  <div>
                    {cartItems.map((item, index) => {
                      return (
                        <div className="order_item">
                          <div style={{ flexBasis: "30%", position: "relative" }}>
                            <span className="itmqty_sp">{item.quantity}</span>
                            <img
                              className="item__img"
                              src={`${basepath}/${item.imgUrl}`}
                              alt=""
                            />
                          </div>
                          <div style={{ flexBasis: "60%" }}>
                            {item.productName}
                          </div>
                          <div style={{ flexBasis: "10%" }}>
                            {item.price * item.quantity}
                          </div>
                        </div>
                      );
                    })}
                  </div>
                  {/* <h6>
                        Total Qty: <span> {totalQty} items </span>
                      </h6> */}
                  <hr />

                  <h6>
                    Subtotal: <span> {currency} {subtotal} </span>
                  </h6>
                  <h6>
                    <span> Shipping:</span>
                    <span>{currency} {shippingCostdata}</span>
                  </h6>
                  {/* <h6>Free Shipping:</h6> */}
                  <h6>
                    Total Cost: <span> {currency} {parseFloat(totalAmount)}</span>
                  </h6>

                </div>

              </Col>
            </Row>

            <section className=" mb-4 pt-3">
        <Container>
          <div className="bg-white shadow-sm p-3">
            <Row>
              <Col lg="12" className="mt-5">
                <h2 className="related__title"> You might also like </h2>
              </Col>
              <ProductsList data={relatedProducts} />
            </Row>
          </div>
        </Container>
      </section>
          </div>
        </Container>
      </section>




    </Helmet>
  );
};

// const ProductLlist = ({ item }) => {
//   return (
//     <div className="item__div">
//       <div style={{ flexBasis: "30%", position: "relative" }}>
//         <span className="item__number">{item.quantity}</span>
//         <img
//           className="pitem__img"
//           src={`${basepath}/${item.imgUrl}`}
//           alt=""
//         />
//       </div>
//       <div style={{ flexBasis: "60%" }}>{item.productName}</div>
//       <div style={{ flexBasis: "10%" }}>{item.price}</div>
//     </div>
//   );
// };


export default Checkout;
