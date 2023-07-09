import React from "react";
import "../styles/cart.css";
import Helmet from "../components/Helmet/Helmet";
import CommonSection from "../components/UI/CommonSection";
import { Col, Container, Row } from "reactstrap";
import { motion } from "framer-motion";
import { cartActions } from "../redux/slices/cartSlice";
import { useSelector, useDispatch } from "react-redux";
import { Link, useNavigate } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProviders";
import { toast } from "react-toastify";

const Cart = (props) => {
  const cartItems = useSelector((state) => state.cart.cartItems);
  const totalAmount = useSelector((state) => state.cart.totalAmount);
  const { orderList } = useStateContext();
  const isLogin = useSelector((state) => state.user.isLogin)
  const navigate = useNavigate();

  function checkout() {
    if (isLogin) {
      props.action(1)

    } else {
      toast.error('Login First')
      navigate("/login")
    }
  }

  return (
    <Helmet>
      {/* <CommonSection title="Shopping Cart" /> */}
      <Container>
        <Row className="mt-1 mb-2">
          <Col lg="12" md="12">
            {cartItems.length === 0 ? (
              <h2 className="fs-4 text-center"> No item added to the cart </h2>
            ) : (
              <table className="table borderd checouttable">
                <thead>
                  <tr className="carthead__st">
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th style={{ textAlign: "center" }}>Qty</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  {cartItems.map((item, index) => (
                    <Tr item={item} key={index} />
                  ))}
                </tbody>
              </table>
            )}

            <div>
              {
                cartItems.length > 0 ? <button className="buy__btn w-100" onClick={checkout}>
                <Link to="/checkout"> Checkout</Link>
              </button> : 
                <Link to="/" className="w-100"> <button className="buy__btn w-100" > Shop  </button> </Link>
             
              }
              

              {/* <button className="buy__btn w-100 mt-3">
                <Link to="/shop"> Continue Shopping </Link>
              </button> */}
            </div>
          </Col>
          {/* <Col lg="3" md="6">
            <div>
              <h6 className="d-flex align-items-center justify-content-between">
                Subtotal
                <span className="fs-4 fw-bold">${totalAmount} </span>
              </h6>
            </div>
            <p className="fs-6 mt-2">
              Taxex and shipping will calculate in checkout
            </p>
            <div>
              <button className="buy__btn w-100" onClick={checkout}>
                <Link to="/checkout"> Checkout </Link>
              </button>

              <button className="buy__btn w-100 mt-3">
                <Link to="/shop"> Continue Shopping </Link>
              </button>
            </div>
          </Col> */}
        </Row>
      </Container>
    </Helmet>
  );
};

const Tr = ({ item }) => {
  const dispatch = useDispatch();

  const qtyChange = (qt, id, typ2) => {
    let qty = qt;
    if (typ2 === "plus") {
      qty = qt + 1;
    }
    if (typ2 === "neg") {
      qty = qt - 1;
    }
    let data = { id: id, qty: qty };
    dispatch(cartActions.itemIncDic(data));
  };

  const deleteProduct = () => {
    dispatch(cartActions.deleteItem(item.id));
  };

  return (
    <tr>
      <td>
        <img src={`http://127.0.0.1:8000/${item.imgUrl}`} alt="" />
      </td>
      <td>{item.productName}</td>
      <td>{item.price} </td>
      <td className="qitemst">
        <div className="itemabtr">
        <button
            className="qt_btn bsewd"
            onClick={() => {
              qtyChange(item.quantity, item.id, "neg");
            }}
          >
            -
          </button>
          <div><input type="number" value={item.quantity} className="qtyinput" /></div>

      
          <button
            className="qt_btn  bsewd"
            onClick={() => {
              qtyChange(item.quantity, item.id, "plus");
            }}
          >
            +
          </button>
         
        </div>
      </td>
      <td>
        <motion.i
          whileTap={{ scale: 1.2 }}
          onClick={deleteProduct}
          class="ri-delete-bin-line"
        ></motion.i>
      </td>
    </tr>
  );
};

export default Cart;
